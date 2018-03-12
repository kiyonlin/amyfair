<template>
    <b-container class="mt-5">
        <b-row align-h="center">
            <b-button variant="outline-success" @click="create('supplier')">我是供应商 I AM A SUPPLIER</b-button>
        </b-row>
        <b-row align-h="center" class="mt-5">
            <b-button variant="outline-success" @click="create('buyer')">我是采购商 I AM A PROFESSIONAL BUYER</b-button>
        </b-row>
    </b-container>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    create(type) {
      axios.get(`invitation/create?type=${type}`);
    }
  }
};
</script>
