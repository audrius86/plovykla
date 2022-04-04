<style>
    <?php
    include 'css/index.css';
    ?>
</style>
<?php

include_once 'config.php';
/**
 * Plovyklos valdymo sistema
 * 1. Sukurti plovykos paslaugu sarasa (id,title,price)
 * 2. Sukurti plovyklos darbuotoju sarasa (id,name)
 * 3. Sukurti plovyklos rezervacijas (id,client_name,car_number,service_id,employee_id,date(Y-m-d H)
 * 4. Visos paslaugos trunka viena valanda. Patiktini ar darbuotojas laisvas pasirinkta valanda.
 * 5. Atvaizduoti 3 dienu rezervacijas
 */

?>

<html>
<head>
    <title>Car Wash</title>
</head>
<body>
<header>
    <a href="index.php?action=services">Add new service</a>
    <a href="index.php?action=employee">Hire an employee</a>
    <a href="index.php?action=reservation">Make a reservation</a>
    <a href="index.php?action=reservations_list">Reservations list</a>
</header>
<main class="main">
    <?php
    if ($action === 'services') {
        include 'pages/services.php';
    } elseif ($action === 'employee') {
        include 'pages/employee.php';
    } elseif ($action === 'reservation') {
        include 'pages/reservation.php';
    } elseif ($action === 'reservations_list') {
        include 'pages/reservations_list.php';
    }
    ?>
</main>
<footer>

</footer>

</body>
</html>