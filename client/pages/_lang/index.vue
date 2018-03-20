<template>
    <div class="Content">
        <div class="container">
            <h1 class="Content__Title"><fa icon="user-circle"/>{{ $t('home.title') }}</h1>
            <p>{{ $t('home.introduction') }}</p>
        <b-btn @click="test">axios</b-btn>
        </div>
    </div>
</template>

<script>
export default {
  head() {
    return {
      title: this.$t("home.title")
    };
  },
  methods: {
    test() {
      this.$axios
        .$post("logout", { username: "13675822217", password: "111111" })
        .then(resp => console.log(resp))
        .catch(resp => console.log(resp));
    }
  }
};
</script>