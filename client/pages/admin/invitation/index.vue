<template>
  <div>
    <b-table show-empty :items="itemsProvider" :currentPage="currentPage" :per-page="perPage"></b-table>
      <b-pagination align="center" variant="secondary" :total-rows="total" :per-page="perPage" v-model="currentPage" class="my-0" />
      <b-form-input v-model="perPage" type="text" class="w-25"></b-form-input>
    <b-table 
      show-empty responsive striped hover 
      :items="items" :fields="fields">
      <!-- A virtual column -->
      <template slot="index" slot-scope="data">
        {{data.index + 1}}
      </template>
      <!-- A custom formatted column -->
      <template slot="type" slot-scope="data">
        {{data.value}}
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  layout: "admin",
  async asyncData({ $axios }) {
    let { data } = await $axios.$get("admin/invitations");
    return {
      items: data
    };
  },
  data() {
    return {
      fields: [
        { key: "index", label: "排序" },
        { key: "type", label: "类型", sortable: true, formatter: "typeText" },
        { key: "email", label: "邮箱" },
        { key: "mobile", label: "手机" },
        { key: "fullName", label: "姓名", sortable: true },
        { key: "country", label: "国家", sortable: true },
        { key: "industry", label: "行业", sortable: true },
        { key: "created_at", label: "申请时间", sortable: true }
      ],
      currentPage: 1,
      perPage: 3,
      total: null
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
      return data;
    }
  }
};
</script>