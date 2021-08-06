<template>
  <div>
    <Navbar @change="getEvent" class="mb-6" />

    <div class="container mx-auto">
      <List v-if="products || categories" :type="type" :data="setProps()" />
    </div>
  </div>
</template>

<script>
import List from '../../components/admin/List.vue';
import Navbar from "../../components/admin/Navbar.vue";
export default {
  name: "Dashboard",
  components: { Navbar, List },
  data() {
    return {
      type: 'products',
      products: null,
      categories: null
    }
  },
  methods: {
    getData() {
      if (this.type === 'products') {
        this.$axios.get('api/products-all').then(response => {
          this.products = response.data.products
        });
      }
      this.$axios.get('api/categories').then(response => {
        this.categories = {data: response.data.categories}
      })
    },
    setProps() {
      if (this.type === 'products') {
        return this.products
      }
      return this.categories
    },
    getEvent(payload) {
      this.type = payload.page
    }
  },
  mounted() {
    this.getData();  
  }
};
</script>

<style>
</style>