<template>
    <div>
        <b-container class="my-2">
            <b-row>
                <b-col md="6" class="ml-auto text-right">
                    <b-pagination align="right" :total-rows="total" :per-page="innerPerPage" v-model="innerCurrentPage" />
                </b-col>
                <b-col md="1" class="text-right">
                    <b-form-select style="min-width:50px" v-model="innerPerPage" :options="perPageOptions"></b-form-select>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
  props: {
    total: Number,
    currentPage: Number,
    perPage: Number,
    perPageOptions: {
      type: Array,
      default: () => [10, 15, 20, 50]
    }
  },

  data() {
    return {
      innerPerPage: this.perPage,
      innerCurrentPage: this.currentPage
    };
  },

  watch: {
    innerPerPage(fresh) {
      this.$emit("update:perPage", fresh);
      this.$emit("update:currentPage", 1);
    },
    innerCurrentPage(fresh) {
      this.$emit("update:currentPage", fresh);
    }
  }
};
</script>