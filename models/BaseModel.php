<?php
// /models/BaseModel.php
abstract class BaseModel {
    protected $pdo;
    protected $table; // Název tabulky, který si definují potomci

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Obecná metoda, kterou automaticky zdědí všechny modely
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}