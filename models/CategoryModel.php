<?php

// Incloure la classe Database si no està sent carregada automàticament
require_once __DIR__ . '/../database.php';

class CategoryModel {
    public function getCategories() {
        $db = Database::getConnection();
        $result = $db->query("SELECT * FROM category");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
