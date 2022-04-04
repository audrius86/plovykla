<?php
if(isset($_POST['employee_id']) and $_POST['employee_id'] != -1) {
    $employee_id = $_POST['employee_id'];

    $sql = "select r.date, r.car_number, r.client_name, s.title from reservations r join employees e on r.employee_id = e.id join services s on r.service_id = s.id where e.id = '$employee_id' order by r.date ASC";
    $result = mysqli_query($database, $sql);
}
?>

<form action="index.php?action=reservations_list" method="post">
    <?php
    $sql = "SELECT * FROM employees";
    $action = mysqli_query($database, $sql);
    echo '<label><b>Choose an employee</b></label>';
    echo '<br>';
    echo "<select name='employee_id'>";
    echo "<option value='-1'>–</option>";
    while ($row = mysqli_fetch_array($action)) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    echo "</select>";
    ?>
    <input type="submit" value="Show reservations">
</form>

<table class="reservations_list">
    <?php if(isset($result)) {
        $counter = 0;
        ?>
    <tr>
        <th>Order No.</th>
        <th>Date and Time</th>
        <th>Service</th>
        <th>Client name</th>
        <th>Car Number</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        $counter++;
        ?>
    <tr>
        <td>
            <?php
                echo $counter;
            ?>
        </td>
        <td>
            <?php
                echo $row['date'];
            ?>
        </td>
        <td>
            <?php
                echo $row['title'];
            ?>
        </td>
        <td>
            <?php
                echo $row['client_name'];
            ?>
        </td>
        <td>
            <?php
                echo $row['car_number'];
            ?>
        </td>
    </tr>
    <?php } }
    ?>
</table>

