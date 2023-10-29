<template>
  <div class="product-card">
    <p>Product Name: {{ product.name }}</p>
    <p>Product Description: {{ product.description }}</p>
    <p>Product Price: {{ product.price }}</p>
    <p>Category Name: {{ product.categories.name }}</p>
    <p>Parent Category: {{ product.categories.parent_category.name }}</p>
    <img
      :src="`http://127.0.0.1:8000/storage/Products_images/${product.image}`"
      alt=""
    />
  </div>
</template>

<script setup>
  defineProps({
    product: Object,
  })
</script>

<style scoped>
.product-card {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}
img {
  width: 300px;
  height: 200px;
}
</style>