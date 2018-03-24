<template>
  <div>
    <b-container fluid class="pl-0 pr-0">
      <b-navbar toggleable="sm" type="light" variant="light" class="px-md-2 px-lg-5 px-xl-5">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand :to="$i18n.path('')" exact class="ml-md-5 pl-md-5">首页</b-navbar-brand>
        <b-collapse is-nav id="nav_collapse" class="mr-lg-5">
          <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right no-caret>
              <template slot="button-content">
                <fa icon="bell"/>
                <b-badge v-if="notificationCount" 
                  variant="danger" pill>
                  {{ notificationCount }}
                </b-badge>
              </template>
              <b-dropdown-item 
                v-for="notification in notifications" 
                :key="notification.id"
                :href="notification.path">
                {{ notification.text}}
              </b-dropdown-item>
            </b-nav-item-dropdown>
            <b-nav-item-dropdown right v-if="user">
              <template slot="button-content">
                <fa icon="user"/>
                {{ user.email }}
              </template>
              <b-dropdown-item to="/admin/setting">
                <fa icon="cog"/>
                {{ $t('links.setting') }}
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
  data() {
    return {
      notifications: [
        { id: "1", text: "notification1", path: "/admin/dashboard" },
        { id: "2", text: "notification2", path: "/admin/dashboard" }
      ]
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/user"
    }),
    notificationCount() {
      return this.notifications.length;
    }
  },

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
