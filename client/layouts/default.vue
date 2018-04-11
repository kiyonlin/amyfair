<template>
  <div>
    <navbar/>
    <div class="mt-3 pt-5 mx-lg-5 px-lg-5">
      <nuxt/>
    </div>
    <footbar id="footer" />
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
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
#footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}
</style>