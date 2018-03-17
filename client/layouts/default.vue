<template>
  <div>
    <navbar/>

    <b-container class="mt-3 pt-5 mx-lg-5 px-lg-5">
      <nuxt/>
    </b-container>
  </div>
</template>

<script>
import Navbar from "~/components/Navbar";
export default {
  components: { Navbar }
};
</script>

<style>

</style>