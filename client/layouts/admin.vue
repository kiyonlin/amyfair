<template>
  <div>
    <navbar/>
    <b-row class="mt-3">
      <b-col offset-lg="2" md="2">
        <sidebar/>
      </b-col>
      <b-col md="auto">
        <nuxt/>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Navbar from "~/components/admin/Navbar.vue";
import Sidebar from "~/components/admin/Sidebar.vue";
export default {
  middleware: "admin-auth",
  components: {
    Navbar,
    Sidebar
  }
};
</script>

<style>

</style>