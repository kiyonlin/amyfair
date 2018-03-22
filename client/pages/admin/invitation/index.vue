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
        <b-col md="6" class="ml-auto text-right">
          <b-btn-group>
            <b-form-input v-model="query.mobile"></b-form-input>
            <b-btn @click="search"><fa icon="search"/></b-btn>
            <b-btn @click="reset">重置</b-btn>
          </b-btn-group>
        </b-col>
      </b-row>
    </b-container>
    <b-table ref="table" show-empty empty-text="暂无数据"
      :items="itemsProvider" :fields="fields"
      :currentPage="currentPage" :per-page="perPage">
      <template slot="HEAD_select" slot-scope="data">
        <b-form-checkbox type="checkbox" @click.native.stop="toggleSelectAll" v-model="allSelected"/>
      </template>
      <template slot="select" slot-scope="row">
        <b-form-checkbox type="checkbox" name="checked" :key="row.index" @click.stop :value="row.item" v-model="checkedItems"/>
      </template>
      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click.stop="info(row.item, row.index, $event.target)" class="mt-1">
          详情
        </b-button>
        <b-button size="sm" variant="danger" @click.stop="remove(row.item, row.index)" class="mt-1">
          删除
        </b-button>
      </template>
    </b-table>
    <b-pagination align="center" :total-rows="total" :per-page="perPage" v-model="currentPage" />

    <!-- <form-dialog></form-dialog> -->
    <!-- Info modal -->
    <b-modal ref="detailModal" ok-title="确定"
             centered @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.detail }}</pre>
    </b-modal>
  </div>
</template>

<script>
import swal from "sweetalert2";
import qs from "qs";
// import formDialog from "./form";
export default {
  layout: "admin",
  // components: { formDialog },
  data() {
    return {
      items: [],
      fields: [
        { key: "select", label: "select all" },
        { key: "type", label: "类型", sortable: true, formatter: "typeText" },
        { key: "email", label: "邮箱" },
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
      perPage: 2,
      total: 0,
      allSelected: false,
      checkedItems: [],
      modalInfo: { title: "", detail: null }
    };
  },
  methods: {
    typeText(value) {
      return value == "supplier" ? "供应" : "采购";
    },
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
    async info(item, index, button) {
      this.modalInfo.title = "查看详情";
      let { data } = await this.$axios.get(`admin/invitations/${item.id}`);
      this.modalInfo.detail = data.data;
      this.$refs.detailModal.show();
    },
    resetModal() {
      this.modalInfo.title = "";
      this.modalInfo.detail = null;
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
    async remove(item, index) {
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
        this.$axios.$delete(`admin/invitations/${item.id}`).then(() => {
          swal({
            title: "删除成功!",
            text: "数据已删除",
            type: "success",
            timer: 1500
          });
          this.$refs.table.refresh();
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