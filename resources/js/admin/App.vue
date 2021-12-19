<template>
  <v-app>
    <SideBar></SideBar>

    <v-content id="main">
      <keep-alive>
        <transition name="fade" mode="out-in">
          <router-view></router-view>
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
  data: () => ({
    //
  })
}
</script>

<style lang="scss"></style>
