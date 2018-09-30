<template>
  <b-container class="text-center mb-5">
    <b-row class="mt-5">
      <b-col>
        <b-btn variant="outline-success" size="lg" :to="$i18n.path('invitation/create?type=buyer')">
          {{ $t("invitation.buyer") }}
        </b-btn>
      </b-col>
    </b-row>
    <b-row class="mt-5">
      <b-col>
          <b-btn variant="outline-success" size="lg" :to="$i18n.path('invitation/create?type=supplier')">
            {{ $t("invitation.supplier") }}
          </b-btn>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  head() {
    return {
      title: this.$t("invitation.title")
    };
  }
  // layout: "none"
};
</script>
