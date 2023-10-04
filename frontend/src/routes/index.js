import { createRouter, createWebHistory } from 'vue-router';
import Products from '../views/Products.vue';
import AddProduct from '../views/AddProduct.vue';

const routes = [
	{
		path: '/',
		name: 'Products',
		component: Products
	},
	{
		path: '/add-product',
		name: 'AddProducts',
		component: AddProduct
	}
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router