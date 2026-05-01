<?php
require 'db.php';
require 'TaxiOrder.php';
$order = new TaxiOrder($pdo);

$name = htmlspecialchars($_POST['user_name'] ?? '');
$passengers = intval($_POST['pass_count'] ?? 1);
$tariff = $_POST['type'] ?? 'Эконом';
$baggage = isset($_POST['bag']) ? 1 : 0;
$car_type = $_POST['car'] ?? 'Седан';

if (!empty($name)) {
    $order->add($name, $passengers, $tariff, $baggage, $car_type);
}

header("Location: index.php");
exit();
