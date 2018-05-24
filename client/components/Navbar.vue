<template>
  <div>
    <b-container fluid class="pl-0 pr-0">
      <b-navbar toggleable="sm" type="dark" variant="info" class="px-md-2 px-lg-5 px-xl-5" fixed="top">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand :to="$i18n.path('')" exact class="ml-lg-5">
          <b-img src="./band_200.png" width="27" height="27"></b-img>
          {{appName}}
        </b-navbar-brand>
        <b-collapse is-nav id="nav_collapse" class="mr-lg-5">
          <b-navbar-nav class="ml-auto">
            <b-nav-item :to="$i18n.path('')" exact>{{ $t('links.home') }}</b-nav-item>
            <b-nav-item :to="$i18n.path('about')" exact>{{ $t('links.about') }}</b-nav-item>
            <b-nav-item :to="$i18n.path('invitation')" exact>{{ $t('links.invitation') }}</b-nav-item>
          </b-navbar-nav>
          <!-- Right aligned nav items -->
          <b-navbar-nav class="ml-auto">
            <b-nav-form>
              <b-form-input size="sm" class="mr-sm-2" type="text" :placeholder="$t('links.search')" />
              <b-button size="sm" class="my-2 my-sm-0" type="submit">{{ $t('links.search') }}</b-button>
            </b-nav-form>
            <b-nav-item-dropdown :text="$t('links.lang')" right>
              <b-dropdown-item :to="$i18n.locale === 'en' ? $route.fullPath : $route.fullPath.replace(/^\/[^\/]+/, '')" exact>
                {{ $t('links.english') }}
              </b-dropdown-item>
              <b-dropdown-item :to="$i18n.locale === 'zh_CN' ? $route.fullPath : `/zh_CN` + $route.fullPath" exact>
                {{ $t('links.chinese') }}
              </b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
          <b-navbar-nav>
            <!-- Authenticated -->
            <b-nav-item-dropdown right v-if="user && !user.admin">
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
            <!-- Guest -->
            <template v-if="!user || user.admin">
              <b-nav-item :to="$i18n.path('auth/login')" exact>{{ $t('links.login') }}</b-nav-item>
              <b-btn :to="$i18n.path('auth/register')" variant="light">{{ $t('links.register') }}</b-btn>
            </template>
          </b-navbar-nav>          
        </b-collapse>
      </b-navbar>
    </b-container>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters({
      user: "auth/user",
      lang: "lang/locale"
    }),
    appName() {
      return this.lang == "en" ? process.env.appNameEn : process.env.appName;
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
