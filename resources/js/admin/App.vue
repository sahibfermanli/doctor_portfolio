<template>
  <v-app>
    <SideBar></SideBar>

    <v-content id="main">
      <keep-alive>
        <transition name="fade" mode="out-in">
          <router-view :key="$route.fullPath" :country="country"></router-view>
        </transition>
      </keep-alive>
    </v-content>
  </v-app>
</template>

<script>
import SideBar from './components/sideBar'

export default {
  name: 'App',
  components: {
    SideBar
  },
  props: {
    country: {
      type: Array
    }
  },
  data: () => ({
    //
  })
}
</script>

<style lang="scss"></style>
