<?php
require 'db.php';
require 'TaxiOrder.php';

$taxi = new TaxiOrder($pdo);

if (isset($_GET['filter']) && $_GET['filter'] == 'big') {
    $stmt = $pdo->prepare("SELECT * FROM taxi_orders WHERE passengers > 2 ORDER BY created_at DESC");
    $stmt->execute();
    $orders = $stmt->fetchAll();
} else {
    $orders = $taxi->getAll();
}

$total = $taxi->getCount();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Такси </title>
    <style>
        body { background: #1a1a1a; color: white; font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; background: #222; }
        th, td { border: 1px solid #ffcc00; padding: 10px; text-align: left; }
        th { background: #ffcc00; color: black; }
        .stats { color: #ffcc00; font-weight: bold; margin-bottom: 20px; }
        .filter-links { margin: 15px 0; }
        a { color: #ffcc00; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1> Управление заказами такси</h1>
    
    <div class="stats">
        Всего заказов в системе: <?= $total ?>
    </div>

    <div class="filter-links">
        Показать: 
        <a href="index.php">Все заказы</a> | 
        <a href="index.php?filter=big">Больше двух человек</a>
    </div>
    
    <table>
        <tr>
            <th>Дата и время</th>
            <th>Имя клиента</th>
            <th>Пассажиры</th>
            <th>Тариф</th>
            <th>Багаж</th>
            <th>Тип авто</th>
        </tr>
        <?php if (empty($orders)): ?>
        <tr>
            <td colspan="6" style="text-align:center;">Заказов пока нет</td>
        </tr>
        <?php else: ?>
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
        <?php endif; ?>
    </table>

    <br><br>
    <a href="form.html"> Оформить новый заказ</a>
</body>
</html>
