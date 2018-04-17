<template>
  <b-modal ok-title="确定" cancel-title="取消" v-model="visiable" @ok.prevent="store" size="lg" centered lazy @hide="reset" :title="title">
    <b-form>
      <b-form-group id="nameGroup" label="名称" label-for="name">
        <b-form-input id="name" name="name" v-model="form.name" v-validate.initial="'required'" :state="!errors.has('name')" placeholder="名称">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('name') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="nameEnGroup" label="名称(英文)" label-for="name_en">
        <b-form-input id="nameEn" name="name_en" v-model="form.name_en" v-validate.initial="'required'" :state="!errors.has('name_en')" placeholder="名称(英文)">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('name_en') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="addressGroup" label="地址" label-for="address">
        <b-form-input id="address" name="address" v-model="form.address" v-validate.initial="'required'" :state="!errors.has('address')" placeholder="地址">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('address') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="addressEnGroup" label="地址(英文)" label-for="address_en">
        <b-form-input id="addressEn" name="address_en" v-model="form.address_en" v-validate.initial="'required'" :state="!errors.has('address_en')" placeholder="地址(英文)">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('address_en') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="mainProductsGroup" label="主要产品" label-for="main_products">
        <b-form-input id="mainProducts" name="main_products" v-model="form.main_products" v-validate.initial="'required'" :state="!errors.has('main_products')" placeholder="主要产品">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('main_products') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="mainProductsEnGroup" label="主要产品(英文)" label-for="main_products_en">
        <b-form-input id="mainProductsEn" name="main_products_en" v-model="form.main_products_en" v-validate.initial="'required'" :state="!errors.has('main_products_en')" placeholder="主要产品(英文)">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('main_products_en') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="startAtGroup" label="开始时间" label-for="start_at">
        <b-form-input id="start_at" type="date" name="start_at" v-model="form.start_at" v-validate.initial="'required'" :state="!errors.has('start_at')" placeholder="开始时间">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('start_at') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="endAtGroup" label="结束时间" label-for="end_at">
        <b-form-input id="end_at" type="date" name="end_at" v-model="form.end_at" v-validate.initial="'required'" :state="!errors.has('end_at')" placeholder="结束时间">
        </b-form-input>
        <b-form-invalid-feedback>{{ errors.first('end_at') }}</b-form-invalid-feedback>
      </b-form-group>
    </b-form>
  </b-modal>
</template>

<script>
import item from "~/mixins/item";
export default {
  mixins: [item],
  data() {
    return {
      form: {}
    };
  }
};
</script>
