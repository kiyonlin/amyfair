<template>
  <div>
    <navbar/>
    
    <div class="mt-3 pt-5 mx-lg-5 px-lg-5">
      <nuxt/>
    </div>

    <footbar/>
  </div>
</template>

<script>
import Navbar from "~/components/Navbar";
import Footbar from "~/components/Footbar";
export default {
  components: {
    Navbar,
    Footbar
  }
};
</script>

<style>

</style>