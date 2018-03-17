<template>
    <b-container>
        <b-row>
            <b-col offset-md="2" md="8" sm="12">
                <b-list-group>
                    <b-list-group-item>{{this.$t("links.login")}}</b-list-group-item>
                    <b-list-group-item>
                        
                    </b-list-group-item>
                </b-list-group>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
  head() {
    return {
      title: this.$t("links.login")
    };
  },
  data: () => ({
    form: {
      email: "",
      password: ""
    },
    remember: false
  }),
  methods: {
    async login() {
      // Submit the form.
      const { data } = await this.form.post("/login");
      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember
      });
      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");
      // Redirect home.
      this.$router.push({
        name: "home"
      });
    }
  }
};
</script>