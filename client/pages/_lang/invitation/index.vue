<template>
    <b-container>
      <b-row align-h="center" align-v="center">
        <b-col offset-md="2" md="4" sm="12" class="my-1" align-self="center">
          <b-btn variant="outline-success" size="lg" 
            :to="$i18n.path('invitation/register?type=supplier')">
            {{ $t("invitation.supplier") }}
          </b-btn>
        </b-col>
        <b-col offset-md="2" md="4" sm="12" class="my-1" align-self="center">
          <b-btn variant="outline-success" size="lg" 
            :to="$i18n.path('invitation/register?type=buyer')">
            {{ $t("invitation.buyer") }}
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