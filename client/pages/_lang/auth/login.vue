<template>
  <b-container>
    <b-row>
      <b-col offset-md="2" md="8" sm="12">
        <b-list-group>
          <b-list-group-item>{{this.$t("links.login")}}</b-list-group-item>
          <b-list-group-item>
            <b-form>
              <b-form-group id="usernameGroup" label="Email address:" label-for="username">
                <b-form-input id="username" v-model="form.username" required placeholder="email/mobile">
                </b-form-input>
              </b-form-group>
              <b-form-group id="passwordGroup" label="Your Name:" label-for="password">
                <b-form-input id="password" type="password" v-model="form.password" required placeholder="password">
                </b-form-input>
              </b-form-group>
              <b-form-group>
                <b-form-checkbox-group>
                  <b-form-checkbox id="remember" v-model="remember" value="true" unchecked-value="false">
                    Remember Me
                  </b-form-checkbox>
                </b-form-checkbox-group>
              </b-form-group>
              <b-button @click="login" variant="primary">Submit</b-button>
              <b-button @click="info" variant="primary">Info</b-button>
            </b-form>
          </b-list-group-item>
        </b-list-group>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import swal from "sweetalert2";

export default {
  head() {
    return {
      title: this.$t("links.login")
    };
  },
  data: () => ({
    form: {
      username: "",
      password: ""
    },
    remember: false
  }),
  methods: {
    async login() {
      // Submit the form to get access token.
      const { access_token } = await this.$axios.$post("/login", this.form);
      console.log("get token?", !!access_token);
      if (access_token) {
        // Save the token.
        this.$store.dispatch("auth/saveToken", {
          token: access_token,
          remember: this.remember
        });

        swal({
          title: "登录",
          text: "欢迎您！",
          type: "success",
          timer: 1500
        }).then(() => {
          this.$store.dispatch("auth/fetchUser");

          // Redirect home.
          // this.$router.push({ path: this.$i18n.path("") });
        });
      }
    },
    async info() {
      let info = await this.$axios.$get("user");
      console.log(info);
    }
  }
};
</script>