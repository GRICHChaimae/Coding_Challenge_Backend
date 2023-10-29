<template>
  <div class="add-product-form">
    <h2>Add Product</h2>
    <form @submit.prevent="addProduct" class="product-form">
      <div class="form-group">
        <label for="name">Name:</label>
        <input
          type="text"
          id="name"
          v-model="product.name"
          class="form-control"
          required
        />
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea
          id="description"
          v-model="product.description"
          class="form-control"
          required
        ></textarea>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input
          type="number"
          id="price"
          v-model="product.price"
          class="form-control"
          required
        />
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select
          id="category"
          v-model="selectedCategoryId"
          class="form-control"
          required
        >
          <option value="">Select a category</option>
          <option
            v-for="category in Categories"
            :key="category.id"
            :value="category.id"
          >
            {{ category.name }}, {{ category.parent_category.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input
          type="file"
          id="image"
          ref="file"
          @change="handleImageUpload"
          class="form-control-file"
        />
      </div>
      <button type="submit" class="submit-button">Add Product</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

      const product = ref({
        name: '',
        description: '',
        price: '',
        image: null,
      })
      const Categories = ref([])
      const selectedCategoryId = ref('')

      const router = useRouter()

      onMounted(() => {
        getAllCategories()
      })

    function getAllCategories() {
      axios.get('http://127.0.0.1:8000/api/get-all-categories').then(({ data }) => {
        Categories.value = data.Categories;
      });
    }

    function handleImageUpload(event) {
      product.value.image = event.target.files[0];
    }

    function addProduct() {
      const formData = new FormData();
      formData.append('name', product.value.name);
      formData.append('description', product.value.description);
      formData.append('price', product.value.price);
      formData.append('category_id', selectedCategoryId.value);
      formData.append('image', product.value.image);

      axios.post('http://127.0.0.1:8000/api/add-product', formData).then((response) => {
        console.log(response.data)
        if(response.data.status === "success") {
          router.push({ path:'/' })
        }
      });
    }
  
</script>

<style scoped>
.add-product-form {
  text-align: center;
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: 0 auto;
}

.product-form .form-group {
  margin-bottom: 20px;
}

.product-form label {
  display: block;
  font-weight: bold;
}

.product-form input[type='text'],
.product-form input[type='number'],
.product-form textarea,
.product-form select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.submit-button {
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 3px;
  padding: 10px 20px;
  cursor: pointer;
  font-weight: bold;
}

.submit-button:hover {
  background-color: #0056b3;
}
</style>
