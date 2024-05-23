<?php

// Potser necessitaràs incloure el model de categories aquí
require_once 'models/CategoryModel.php';

class CategoryController {
    private $model;

    public function __construct() {
        // Creem l'instància del model de categories
        $this->model = new CategoryModel();
    }

    public function index() {
        // Demanem al model que ens proporcione les categories
        $categories = $this->model->getCategories();

        // Ara passarem aquestes categories a la vista corresponent
        // Asumim que tens una vista que es diu 'category-list.php'
        include __DIR__ . '/../VIEWS/category-list.html';
    }
}
