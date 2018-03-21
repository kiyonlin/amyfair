<template>
  <div>
    <b-container class="my-2">
      <b-row>
        <b-col md="2">
          <b-btn-group>
            <b-btn><fa icon="plus"/></b-btn>
            <b-btn><fa icon="sync"/></b-btn>
          </b-btn-group>
        </b-col>
        <b-col md="6" class="ml-auto text-right">
          <b-btn-group>
            <b-form-input></b-form-input>
            <b-btn><fa icon="search"/></b-btn>
          </b-btn-group>
        </b-col>
      </b-row>
    </b-container>
    <b-table ref="table" show-empty empty-text="暂无数据" :items="itemsProvider" :currentPage="currentPage" :per-page="perPage" :fields="fields">
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

    <!-- Info modal -->
    <b-modal ref="detailModal" ok-title="确定"
             centered @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.detail }}</pre>
    </b-modal>
  </div>
</template>

<script>
import swal from "sweetalert2";
export default {
  layout: "admin",
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
      let params = "?page=" + ctx.currentPage + "&perPage=" + ctx.perPage;
      let { data, meta } = await this.$axios.$get("admin/invitations" + params);
      this.total = meta.total;
      this.items = data;
      return data;
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