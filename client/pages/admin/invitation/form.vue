<template>
  <b-modal ok-title="确定" cancel-title="取消" v-model="visiable" size="lg" centered lazy @hide="reset" :title="title">
    <b-form>
      <b-form-group :label="$t('invitation.typeLabel')">
        <b-form-radio-group v-model="form.type" :options="'typesText' | text('invitation')" name="type">
        </b-form-radio-group>
      </b-form-group>
      <b-form-group id="emailGroup" :label="$t('invitation.emailLabel')" label-for="email">
        <b-form-input id="email" type="email" v-model="form.email" required :placeholder="$t('invitation.emailPlaceholder')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="mobileGroup" :label="$t('invitation.mobileLabel')" label-for="mobile">
        <b-form-input id="mobile" v-model="form.mobile" required :placeholder="$t('invitation.mobilePlaceholder')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="fullNameGroup" :label="$t('invitation.fullNameLabel')" label-for="fullName">
        <b-form-input id="fullName" v-model="form.fullName" required :placeholder="$t('invitation.fullNamePlaceholder')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="countryGroup" :label="$t('invitation.countryLabel')" label-for="country">
        <b-form-input id="country" v-model="form.country" required :placeholder="$t('invitation.countryPlaceholder')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="industryGroup" :label="$t('invitation.industryLabel')" label-for="industry">
        <b-form-input id="industry" v-model="form.industry" required :placeholder="$t('invitation.industryPlaceholder')">
        </b-form-input>
      </b-form-group>
      <b-form-group :label="$t('invitation.genderLabel')">
        <b-form-radio-group v-model="form.gender" :options="'gendersText' | text('invitation')" name="gender">
        </b-form-radio-group>
      </b-form-group>
      <b-form-group id="phoneGroup" :label="$t('invitation.phoneLabel')" label-for="phone">
        <b-form-input id="phone" v-model="form.phone" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <div class="p-2">
        {{$t('invitation.imList')}}
      </div>
      <b-form-group id="qqGroup" :label="$t('invitation.qqLabel')" label-for="qq">
        <b-form-input id="qq" v-model="form.qq" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="wechatGroup" :label="$t('invitation.wechatLabel')" label-for="wechat">
        <b-form-input id="wechat" v-model="form.wechat" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="whatsappGroup" :label="$t('invitation.whatsappLabel')" label-for="whatsapp">
        <b-form-input id="whatsapp" v-model="form.whatsapp" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="skypeGroup" :label="$t('invitation.skypeLabel')" label-for="skype">
        <b-form-input id="skype" v-model="form.skype" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="facebookGroup" :label="$t('invitation.facebookLabel')" label-for="facebook">
        <b-form-input id="facebook" v-model="form.facebook" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="corpNameGroup" :label="$t('invitation.corpNameLabel')" label-for="corpName">
        <b-form-input id="corpName" v-model="form.corpName" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="corpAddrGroup" :label="$t('invitation.corpAddrLabel')" label-for="corpAddr">
        <b-form-input id="corpAddr" v-model="form.corpAddr" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="websiteGroup" :label="$t('invitation.websiteLabel')" label-for="website">
        <b-form-input id="website" v-model="form.website" :placeholder="$t('invitation.optional')">
        </b-form-input>
      </b-form-group>
      <b-form-group id="sourceGroup" :label="$t('invitation.sourceLabel')" label-for="source">
        <b-form-select id="source" v-model="form.source" :options="'sourcesText' | text('invitation')">
          <option :value="null">{{ $t("invitation.selectDefaultOptionOptional") }}</option>
        </b-form-select>
      </b-form-group>
      <b-form-group id="intentGroup" :label="$t('invitation.intentLabel')" label-for="intent">
        <b-form-select id="intent" v-model="form.intent" :options="'intentsText' | text('invitation')">
          <option :value="null">{{ $t("invitation.selectDefaultOptionOptional") }}</option>
        </b-form-select>
      </b-form-group>
      <b-form-group id="tradingIntroGroup" :label="$t('invitation.tradingIntroLabel')" label-for="tradingIntro">
        <b-form-textarea id="tradingIntro" v-model="form.tradingIntro" :rows="5" :max-rows="5" :placeholder="$t('invitation.optional')">
        </b-form-textarea>
      </b-form-group>
    </b-form>
  </b-modal>
</template>

<script>
// import commonDialog from '../../mixins/commonDialog';
export default {
  // mixins: [commonDialog],
  props: {
    show: Boolean,
    itemId: Number,
    isEdit: Boolean
  },
  data() {
    return {
      visiable: false,
      form: {}
    };
  },
  watch: {
    show() {
      this.visiable = this.show;
      if (this.visiable) this.init();
    }
  },
  computed: {
    title() {
      return this.isEdit ? "查看" : "添加";
    }
  },
  methods: {
    async init() {
      if (this.isEdit && this.itemId) {
        let { data } = await this.$axios.get(
          `admin/invitations/${this.itemId}`
        );
        this.form = data.data;
      }
    },
    /**
     * 同步sync数据，根据Vue2.3以后的版本，因为是props属性，需要使用事件触发
     * 详见：https://cn.vuejs.org/v2/guide/components.html#sync-修饰符
     * 当关闭对话框时，更新父组件信息
     */
    reset() {
      this.visiable = false;
      this.form = {};
      this.$emit("update:show", false);
      this.$emit("update:itemId", null);
    }
  }
};
</script>
