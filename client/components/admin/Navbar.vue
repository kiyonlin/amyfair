<template>
  <div>
    <b-container fluid class="pl-0 pr-0">
      <b-navbar toggleable="sm" type="light" variant="light" class="px-md-2 px-lg-5 px-xl-5">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-collapse is-nav id="nav_collapse" class="mr-lg-5">
          <b-navbar-nav class="ml-auto">
            <!-- Authenticated -->
            <b-nav-item-dropdown right>
              <template slot="button-content">
                <fa icon="user"/>
                {{ user.email }}
              </template>
              <b-dropdown-item :to="$i18n.path('setting/profile')">
                <fa icon="cog"/>
                {{ $t('links.profile') }}
              </b-dropdown-item>
              <b-dropdown-item @click.prevent="logout">
                <fa icon="sign-out-alt"/>
                {{ $t('links.logout') }}
              </b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>          
        </b-collapse>
      </b-navbar>
    </b-container>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  computed: mapGetters({
    user: "auth/user"
  }),

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");
      // Redirect to index.
      this.$router.push({ path: this.$i18n.path("") });
    }
  }
};
</script>
<style>

</style>
