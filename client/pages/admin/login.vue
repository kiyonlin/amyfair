<template>
  <b-container>
    <b-row>
      <b-col offset-md="2" md="8" sm="12">
        <b-list-group>
          <b-list-group-item class="text-center">员工登录</b-list-group-item>
          <b-list-group-item>
            <b-form>
              <b-form-group id="usernameGroup" :label="$t('login.usernameLabel')" label-for="username">
                <b-form-input id="username" v-model="form.username" required :placeholder="$t('login.usernamePlaceholder')">
                </b-form-input>
              </b-form-group>
              <b-form-group id="passwordGroup" :label="$t('login.passwordLabel')" label-for="password">
                <b-form-input id="password" type="password" v-model="form.password" required :placeholder="$t('login.passwordPlaceholder')">
                </b-form-input>
              </b-form-group>
              <b-form-group>
                <b-form-checkbox-group>
                  <b-form-checkbox id="remember" v-model="remember" value="true" unchecked-value="false">
                    {{ $t('login.remember') }}
                  </b-form-checkbox>
                </b-form-checkbox-group>
              </b-form-group>
              <b-button @click="login" variant="info">{{ $t('btn.submit') }}</b-button>
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
  layout: "none",
  middleware: "admin-guest",
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
      if (access_token) {
        // Save the token.
        this.$store.dispatch("auth/saveToken", {
          token: access_token,
          remember: this.remember
        });
        swal({
          title: this.$i18n.t("login.title"),
          text: this.$i18n.t("login.welcome"),
          type: "success",
          timer: 1500
        }).then(() => {
          this.$store.dispatch("auth/fetchUser");
          // Redirect home.
          this.$router.push({ path: "/admin/dashboard" });
        });
      }
    }
  }
};
</script>