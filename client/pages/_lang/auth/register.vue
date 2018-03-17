<template>
    <div class="row">
        {{$t("links.register")}}
    </div>
</template>

<script>
// import Form from "vform";
export default {
  head() {
    return {
      title: this.$t("links.register")
    };
  },
  data: () => ({
    form: {
      name: "",
      email: "",
      password: "",
      password_confirmation: ""
    }
  }),
  methods: {
    async register() {
      // Register the user.
      const { data } = await this.form.post("/register");
      // Log in the user.
      const { data: { token } } = await this.form.post("/login");
      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token
      });
      // Update the user.
      await this.$store.dispatch("auth/updateUser", {
        user: data
      });
      // Redirect home.
      this.$router.push({
        name: "home"
      });
    }
  }
};
</script>