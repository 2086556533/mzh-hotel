<template>
  <div id="app">
    <router-view></router-view>

  </div>
</template>

<script>
import Loading from "./components/loading/Loading";
export default {
  name: 'App',
  Loading,
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

}
</style>
