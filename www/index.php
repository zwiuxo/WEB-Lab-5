<?php
require 'db.php';
require 'TaxiOrder.php';

$taxi = new TaxiOrder($pdo);
$orders = $taxi->getAll();
$total = $taxi->getCount();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Такси</title>
    <style>
        body { background: #1a1a1a; color: white; font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ffcc00; padding: 10px; text-align: left; }
        th { background: #ffcc00; color: black; }
        .stats { color: #ffcc00; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Управление заказами такси</h1>
    <p class="stats">Всего заказов в базе: <?= $total ?></p>
    
    <table>
        <tr>
            <th>Дата</th>
            <th>Имя</th>
            <th>Пассажиры</th>
            <th>Тариф</th>
            <th>Багаж</th>
            <th>Тип авто</th>
        </tr>
        <?php foreach($orders as $row): ?>
        <tr>
            <td><?= $row['created_at'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['passengers'] ?></td>
            <td><?= $row['tariff'] ?></td>
            <td><?= $row['baggage'] ? 'Да' : 'Нет' ?></td>
            <td><?= $row['car_type'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="form.html" style="color: #ffcc00;">Сделать новый заказ</a>
</body>
</html>
