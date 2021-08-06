<template>
  <div>
    <Navbar class="mb-6" />

    <div class="container mx-auto">
      <List />
    </div>
  </div>
</template>

<script>
import List from '../../components/admin/List.vue';
import Navbar from "../../components/admin/Navbar.vue";
export default {
  name: "Dashboard",
  components: { Navbar, List },
};
</script>

<style>
</style>