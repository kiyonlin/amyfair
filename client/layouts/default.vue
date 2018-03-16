<template>
  <div>
    <b-container fluid class="pl-0 pr-0">
      <b-navbar toggleable="sm" type="light" variant="light" class="px-2" fixed="top">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand :to="$i18n.path('')" exact>Amy Fair</b-navbar-brand>
        <b-collapse is-nav id="nav_collapse">
          <b-navbar-nav>
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
              <b-dropdown-item :to="$i18n.locale === 'en' ? $route.fullPath : `/en` + $route.fullPath" exact>
                {{ $t('links.english') }}
              </b-dropdown-item>
              <b-dropdown-item :to="$i18n.locale === 'zh_cn' ? $route.fullPath : $route.fullPath.replace(/^\/[^\/]+/, '')" exact>
                {{ $t('links.chinese') }}
              </b-dropdown-item>
            </b-nav-item-dropdown>
            <b-nav-item-dropdown right>
              <!-- Using button-content slot -->
              <template slot="button-content">
                <em>{{ $t('links.memberCenter') }}</em>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item href="#">Signout</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </b-container>
    <b-container class="mt-3 pt-5">
      <nuxt/>
    </b-container>
  </div>
</template>

<script>
export default {};
</script>

<style>

</style>