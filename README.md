# Junior Software Engineer - Backend (PHP) Coding Challenge
This project evaluates junior software engineers' skills in PHP, Laravel, and Vue.js by creating a Product and Category Management System. It features a command-line interface (CLI) and web application for efficient product and category management.

# How to work
1.clone the project
2.go to the backend directory and run this command "composer install" to install laravel packages (run all commands in the terminal)
3.in the backend  directory run this command to start the back-end server "php artisan serve" 
3.go to the frontend directory and run this command "npm install" to install vue.js packges
4.in the frontend director run these two commands too "npm i vue-router@4" and "npm install axios" to install additional dependencies
5.finally to run the frontend server run this command "npm run dev"

# How to use CLI to create a category
in the backend directory run this command "php artisan category:create category_name parent_category" for example: "php artisan category:create shoes clothes"

# How to use CLI to delete a category
in the backend directory run this command "php artisan category:delete category_id" for example: "php artisan category:create 3"

# How to use CLI to create a product
in the backend directory run this command "php artisan product:create", follow the prompts to enter the category id, product name, product description, product price and product image path (note: the image should be inside the projects folder, for example the images folder in the public folder of the backend)

# How to use CLI to delete a product
in the backend directory run this command "php artisan product:delete product_id" for example: "php artisan product:create 1"

# API Endpoints

You will need to interact with the following API endpoints:

1-Product Creation: http://127.0.0.1:8000/api/add-product
2-Get All Products: http://127.0.0.1:8000/api/get-all-products
3-Get All Categories: http://127.0.0.1:8000/api/get-all-categories
4-Sort Products By Name Or Price: http://127.0.0.1:8000/api/sort-products
5-Filter Products By Category: http://127.0.0.1:8000/api/filter-products