<?php

if(isset($_POST['client_name'])){
    $client_name = $_POST['client_name'];
    $car_number = $_POST['car_number'];
    $service_id = $_POST['service_id'];
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];

    $full_date = $date . ' ' . $hour;


    $errors = [];

    $sql = "SELECT * FROM services WHERE id = '$service_id'";
    $result = mysqli_query($database, $sql);

    if(!mysqli_num_rows($result)) {
        $errors['service_id'][] = 'Choose a service!';
    }

    $sql = "SELECT * FROM employees WHERE id = '$employee_id'";
    $result = mysqli_query($database, $sql);

    if(!mysqli_num_rows($result)) {
        $errors['employee_id'][] = 'Choose an employee!';
    }

    $sql = "SELECT * FROM reservations WHERE employee_id = '$employee_id' and date = '$full_date'";
    $result = mysqli_query($database, $sql);

    if(mysqli_num_rows($result)) {
        $errors['date_time'][] = 'Choose another date and time!';
    }



    if (empty($errors)) {
        $sql = "INSERT INTO reservations (client_name, car_number, service_id, employee_id, date) VALUES ('$client_name', '$car_number', '$service_id', '$employee_id', '$full_date')";
        $result = mysqli_query($database, $sql);
        header('Location: index.php?action=reservation');
    }
}

?>

<form action="index.php?action=reservation" method="post">
    <input type="text" name="client_name" placeholder="Client name" required="required"/> <br/>
    <input type="text" name="car_number" placeholder="Car number" required="required"/> <br/>
    <?php

    $sql = "SELECT * FROM services";
    $action = mysqli_query($database ,$sql);
    echo '<label><b>Choose service</b></label>';
    echo '<br>';
    echo "<select name='service_id'>";
    echo "<option value='-1'>–</option>";
    while ($row = mysqli_fetch_array($action)) {
        echo "<option value='" . $row['id'] . "'>" . $row['title'] . ' ' . $row['price'] . ' €' . "</option>";
    }
    echo "</select>";

    if (isset($errors['service_id'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['service_id']);?></span>
    <?php
    }


    echo "<br>";

    $sql = "SELECT * FROM employees";
    $action = mysqli_query($database ,$sql);
    echo '<label><b>Choose employee</b></label>';
    echo '<br>';
    echo "<select name='employee_id'>";
    echo "<option value='-1'>–</option>";
    while ($row = mysqli_fetch_array($action)) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    echo "</select>";
    if (isset($errors['employee_id'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['employee_id']);?></span>
        <?php
    }
    ?>
    <br>
    <input type="date" name="date" value="<?php echo date("Y-m-d");?>">

    <select name="hour">
        <?php
        for ($i = 8; $i < 18; $i++) { ?> <option value="<?php echo $i;?>"><?php echo $i;?>:00</option>
        <?php } ?>
    </select>


   <?php if (isset($errors['date_time'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['date_time']);?></span>
    <?php

    }
    ?>


    <input type="submit" value="Save">
</form>


