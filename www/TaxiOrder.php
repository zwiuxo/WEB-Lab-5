<?php
class TaxiOrder {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($name, $passengers, $tariff, $baggage, $car_type) {
        $sql = "INSERT INTO taxi_orders (name, passengers, tariff, baggage, car_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $passengers, $tariff, $baggage, $car_type]);
    }

    // сорт по дате
    public function getAll() {
        return $this->pdo->query("SELECT * FROM taxi_orders ORDER BY created_at DESC")->fetchAll();
    }

    // статистика
    public function getCount() {
        return $this->pdo->query("SELECT COUNT(*) FROM taxi_orders")->fetchColumn();
    }
}
