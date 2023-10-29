<template>
  <div>
    <div class="actions">
      <div class="acItem">
        <button @click="addProduct">Add Product</button>
      </div>
      <div class="acItem">
        <input
          type="text"
          v-model="namePrice"
          placeholder="search by name or price"
        />
        <button @click="searchByNameOrPrice">Search</button>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select
          id="category"
          v-model="selectedCategoryId"
          class="form-control"
          @change="filterByCategory"
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
    </div>
    <div class="productCard">
      <div v-for="product in paginatedProducts" :key="product.id" class="item">
        <product-card :product="product"></product-card>
      </div>
    </div>
    <div class="pagesNav">
      <button @click="prevPage">prev</button>
      <p class="pageNum">{{ page }}</p>
      <button @click="nextPage">next</button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import ProductCard from '../components/ProductComponent.vue'
import axios from 'axios'

const products = ref([])
const itemsPerPage = ref(9)
const currentPage = ref(1)
const page = ref(1)
const searchMode = ref(false)
const namePrice = ref('')
const Categories = ref([])
const selectedCategoryId = ref('')
const filterMode = ref(false)

const router = useRouter()

const paginatedProducts = computed(() => {
  const startIndex = (currentPage.value - 1) * itemsPerPage.value
  return products.value.slice(startIndex, startIndex + itemsPerPage.value)
})

onMounted(() => {
  getProducts()
  getAllCategories()
})

function addProduct() {
  router.push({ path: '/add-product' })
}

function nextPage() {
  page.value++
  if (searchMode.value) {
    searchByNameOrPrice()
  } else if (filterMode.value){
    filterByCategory()
  } else {
    getProducts()
  }
}

function prevPage() {
  page.value--
  if (searchMode.value) {
    searchByNameOrPrice()
  } else if (filterMode.value){
    filterByCategory()
  } else {
    getProducts()
  }
}

function getProducts() {
  searchMode.value = false
  filterMode.value = false
  axios
    .get(`http://127.0.0.1:8000/api/get-all-products?page=${page.value}`)
    .then(({ data }) => {
      console.log(data.Products.data)
      if (data.status === 'success') {
        products.value = data.Products.data
      }
    })
    .catch((error) => {
      console.error('error: ', error)
    })
}

function searchByNameOrPrice() {
  searchMode.value = true
  filterMode.value = false
  axios
    .post(`http://127.0.0.1:8000/api/sort-products?page=${page.value}`, {
      sort: namePrice.value,
    })
    .then(({ data }) => {
      const { Products } = data
      products.value = Products.data
      console.log(Products)
    })
    .catch((error) => {
      console.error('error: ', error)
    })
}

function getAllCategories() {
  axios.get('http://127.0.0.1:8000/api/get-all-categories').then(({ data }) => {
    Categories.value = data.Categories
    console.log(Categories.value)
  })
}

function filterByCategory() {
  filterMode.value = true
  searchMode.value = false
  axios
    .post(`http://127.0.0.1:8000/api/filter-products?page=${page.value}`, {
      category_id: selectedCategoryId.value,
    })
    .then(({ data }) => {
      const { Products } = data
      products.value = Products.data
      console.log(data)
    })
    .catch((error) => {
      console.error('error: ', error)
    })
}
</script>

<style scoped>
.pagesNav {
  display: flex;
}
.pageNum {
  /* color: blue; */
  margin-left: 10px;
  margin-right: 10px;
}

button {
  background-color: rgb(56, 59, 203);
  color: white;
  border: 1px solid black;
  border-radius: 0;
  margin-top: 10px;
}

.productCard {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
}

.item {
  background-color: rgb(56, 59, 203);
  flex: 0 0 calc(33.33% - 20px);
  margin: 10px;
  border: 1px solid #ddd;
  text-align: center;
  padding: 10px;
  box-sizing: border-box;
}

.actions {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  justify-content: space-around;
}
.acItem {
  flex: 0 0 calc(33.33% - 20px);
}
</style>