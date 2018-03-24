<template>
  <b-container>
    <b-row>
      <b-col>
        <b-alert show>更新账户信息</b-alert>
        <b-form>
          <b-form-group id="nameGroup" label="用户名" label-for="name">
            <b-form-input id="name" name="name" v-model="form.name" v-validate.initial="'required'" :state="!errors.has('name')">
            </b-form-input>
            <b-form-invalid-feedback>{{ errors.first('name') }}</b-form-invalid-feedback>
          </b-form-group>
          <b-form-group id="mobileGroup" label="手机" label-for="mobile">
            <b-form-input id="mobile" name="mobile" v-model="form.mobile" v-validate.initial="'required'" :state="!errors.has('mobile')">
            </b-form-input>
            <b-form-invalid-feedback>{{ errors.first('mobile') }}</b-form-invalid-feedback>
          </b-form-group>
          <b-form-group id="emailGroup" label="邮箱" label-for="email">
            <b-form-input id="email" name="email" v-model="form.email" v-validate.initial="'required'" :state="!errors.has('email')">
            </b-form-input>
            <b-form-invalid-feedback>{{ errors.first('email') }}</b-form-invalid-feedback>
          </b-form-group>
          <b-form-group id="passwordGroup" label="密码" label-for="password">
            <b-form-input id="password" name="密码" type="password" v-model="form.password" v-validate="'confirmed:确认密码'" :state="!errors.has('密码')">
            </b-form-input>
            <b-form-invalid-feedback>{{ errors.first('密码') }}</b-form-invalid-feedback>
          </b-form-group>
          <b-form-group id="passwordConfirmationGroup" label="确认密码" label-for="passwordConfirmation">
            <b-form-input id="passwordConfirmation" name="确认密码" type="password" v-model="form.password_confirmation">
            </b-form-input>
          </b-form-group>
          <b-button @click="update" variant="outline-info">{{ $t('btn.submit') }}</b-button>
        </b-form>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from "vuex";
import { pick } from "lodash";
import swal from "sweetalert2";

export default {
  layout: "admin",
  head() {
    return {
      titleTemplate: `%s - 设置`
    };
  },
  created() {
    this.form = Object.assign({}, pick(this.user, ["name", "mobile", "email"]));
  },
  computed: {
    ...mapGetters({
      user: "auth/user"
    })
  },
  data() {
    return {
      form: {}
    };
  },
  methods: {
    async update() {
      let { data: user } = await this.$axios.$put(
        `admin/users/${this.user.id}`,
        this.form
      );
      swal({
        text: "更新信息成功",
        type: "success",
        timer: 1500
      }).then(() => {
        this.$store.dispatch("auth/updateUser", user);
      });
    }
  }
};
</script>