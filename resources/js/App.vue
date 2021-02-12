<template>
  <v-app>
    <v-alert type="info" :value="true">
  Product Managament
    </v-alert>
    <products-component></products-component>
  </v-app>
</template>

<script>
import ProductsComponent from './components/ProductComponents/ProductsComponent.vue';

export default {
  components:{
    ProductsComponent,
  },
  name: "App"
};
</script> 