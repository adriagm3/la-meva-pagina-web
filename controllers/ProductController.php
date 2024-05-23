<?php
require_once 'models/ProductModel.php';

class ProductController {
    public function listProducts() {
        $productModel = new ProductModel();
        $products = $productModel->getProducts(); // Obtenim productes de la BD
        include 'views/product-list.php'; // Mostrem la vista amb els productes
    }
}
