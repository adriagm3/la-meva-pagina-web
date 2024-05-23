<?php
require_once 'Database.php';

class ProductModel {
    public function getProducts() {
        $db = Database::getConnection();
        $result = $db->query("SELECT * FROM product");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
