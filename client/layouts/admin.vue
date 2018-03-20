<template>
  <div>
    <navbar/>
    <b-container>
      <b-row class="mt-3">
        <b-col lg="2" md="3">
          <sidebar/>
        </b-col>
        <b-col lg="10" md="9">
          <nuxt/>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Navbar from "~/components/admin/Navbar.vue";
import Sidebar from "~/components/admin/Sidebar.vue";
export default {
  middleware: "admin-auth",
  head() {
    return {
      title: "管理后台"
    };
  },
  components: {
    Navbar,
    Sidebar
  }
};
</script>

<style>

</style>