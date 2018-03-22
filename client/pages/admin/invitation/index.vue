<template>
  <div>
    <b-container class="my-2">
      <b-row>
        <b-col md="2">
          <b-btn-group>
            <b-btn @click="add"><fa icon="plus"/></b-btn>
            <b-btn @click="refresh"><fa icon="sync"/></b-btn>
            <b-btn @click="batchRemove"><fa icon="trash"/></b-btn>
          </b-btn-group>
        </b-col>
        <b-col md="1" class="ml-auto text-right">
          <b-btn v-b-toggle.collapseSearch>筛选</b-btn>
        </b-col>
      </b-row>
    </b-container>
    <b-collapse id="collapseSearch" class="my-2">
      <b-card>
        <b-row>
          <b-col>
            <b-form-group :label="$t('invitation.typeLabel')">
              <b-form-radio-group v-model="query.type" :options="'typesText' | text('invitation')" name="type">
              </b-form-radio-group>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row class="mt-2">
          <b-col>
            <b-form-group :label="$t('invitation.mobileLabel')" label-for="mobile">
              <b-form-input id="mobile" v-model="query.mobile"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group :label="$t('invitation.fullNameLabel')" label-for="fullName">
              <b-form-input id="fullName" v-model="query.fullName"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group :label="$t('invitation.countryLabel')" label-for="country">
              <b-form-input id="country" v-model="query.country"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group :label="$t('invitation.industryLabel')" label-for="industry">
              <b-form-input id="industry" v-model="query.industry"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row class="mt-2">
          <b-col cols="2" class="ml-auto text-right">
              <b-btn @click="search" class="mr-1"><fa icon="search"/></b-btn>
              <b-btn @click="reset">{{ $t('btn.reset') }}</b-btn>
          </b-col>
        </b-row>
      </b-card>
    </b-collapse>
    <b-table width="100%" ref="table" show-empty empty-text="暂无数据" responsive
      :items="itemsProvider" :fields="fields"
      :currentPage="currentPage" :per-page="perPage">
      <template slot="HEAD_select" slot-scope="data">
        <b-form-checkbox type="checkbox" @click.native.stop="toggleSelectAll" v-model="allSelected"/>
      </template>
      <template slot="select" slot-scope="row">
        <b-form-checkbox type="checkbox" name="checked" :key="row.index" @click.stop :value="row.item" v-model="checkedItems"/>
      </template>
      <template slot="type" slot-scope="row">
        {{ row.value | text('invitation.typesText') }}
      </template>
      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click.stop="showDetail(row.item, row.index, $event.target)" class="mt-1">
          详情
        </b-button>
        <b-button size="sm" variant="danger" @click.stop="remove(row.item, row.index)" class="mt-1">
          删除
        </b-button>
      </template>
    </b-table>
    <b-container class="my-2">
      <b-row>
        <b-col md="6" class="ml-auto text-right">
          <b-pagination align="right" :total-rows="total" :per-page="perPage" v-model="currentPage" />
        </b-col>
        <b-col md="1" class="text-right">
          <b-form-select v-model="perPage" :options="perPageOptions"></b-form-select>
        </b-col>
      </b-row>
    </b-container>

    <form-dialog :item-id.sync="currentItemId" :show.sync="showModal" :is-edit="isEdit"></form-dialog>
  </div>
</template>

<script>
import swal from "sweetalert2";
import qs from "qs";
import formDialog from "./form";
export default {
  layout: "admin",
  components: { formDialog },
  data() {
    return {
      items: [],
      fields: [
        { key: "select", label: "select all" },
        { key: "type", label: "类型", sortable: true },
        { key: "mobile", label: "手机" },
        { key: "fullName", label: "姓名", sortable: true },
        { key: "country", label: "国家", sortable: true },
        { key: "industry", label: "行业", sortable: true },
        { key: "created_at", label: "申请时间", sortable: true },
        { key: "actions", label: "操作" }
      ],
      query: {},
      searched: false,
      currentPage: 1,
      perPage: 10,
      perPageOptions: [10, 15, 20, 50],
      total: 0,
      allSelected: false,
      checkedItems: [],
      showModal: false,
      currentItemId: null,
      isEdit: false
    };
  },
  methods: {
    async itemsProvider(ctx) {
      let { url, query } = this.getUrl(ctx);
      let { data, meta } = await this.$axios.$get(url);
      this.total = meta.total;
      this.items = data;
      this.$router.push({ query });
      return data;
    },
    getUrl(ctx) {
      delete ctx.apiUrl;
      delete ctx.filter;
      let url = "admin/invitations";
      let query = Object.assign({}, ctx);
      if (this.searched) {
        query = Object.assign(query, this.query);
      }
      let querystring = qs.stringify(query);
      if (querystring) {
        url += `?${querystring}`;
      }
      return { url, query };
    },
    toggleSelectAll() {
      this.checkedItems = this.allSelected ? [] : this.items;
    },
    clearSelected() {
      this.allSelected = false;
      this.checkedItems = [];
    },
    showDetail(item, index, button) {
      this.isEdit = true;
      this.showModal = true;
      this.currentItemId = item.id;
    },
    add() {
      this.isEdit = false;
      this.showModal = true;
    },
    refresh() {
      this.$refs.table.refresh();
    },
    search() {
      this.searched = true;
      this.refresh();
    },
    reset() {
      this.searched = false;
      this.query = {};
      this.refresh();
    },
    async remove(item, index, ids = []) {
      let result = await swal({
        title: "确定删除吗?",
        text: "数据删除后将无法恢复!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确定删除!",
        cancelButtonText: "取消",
        reverseButtons: true
      });

      if (result.value) {
        let id = ids[0] || item.id;
        this.$axios.$delete(`admin/invitations/${id}`, { ids }).then(() => {
          swal({
            title: "删除成功!",
            text: "数据已删除",
            type: "success",
            timer: 1500
          });
          this.$refs.table.refresh();
          // 批量删除时清除选择的项
          if (ids) this.clearSelected();
        });
      } else if (result.dismiss === swal.DismissReason.cancel) {
        swal({ title: "取消", text: "删除已取消", type: "error", timer: 1000 });
      }
    },
    batchRemove() {
      if (!this.checkedItems.length) {
        swal({
          text: "未选择项目",
          type: "warning",
          timer: 1000
        });
        return;
      }
      let ids = this.checkedItems.map(item => item.id);

      this.remove(null, null, ids);
    }
  },
  watch: {
    checkedItems(a, b) {
      this.allSelected = this.items.length === a.length ? true : false;
    },
    perPage(a, b) {
      if (a !== b) {
        this.clearSelected();
      }
    },
    currentPage(a, b) {
      if (a !== b) {
        this.clearSelected();
      }
    },
    filter(a, b) {
      if (a !== b) {
        this.clearSelected();
      }
    },
    async(a, b) {
      if (a !== b) {
        this.clearSelected();
      }
    }
  }
};
</script>