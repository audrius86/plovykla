<?php

if(isset($_POST['employee_name'])){
    $name = $_POST['employee_name'];

$errors = [];

$sql = "SELECT * FROM employees WHERE name = '$name'";
$result = mysqli_query($database, $sql);
if(mysqli_num_rows($result)) {
    $errors['employee_name'][] = 'This name is taken! Choose another or add random number';
}

if (empty($errors)) {

    $sql = "INSERT INTO employees (name) VALUES ('$name')";
    $result = mysqli_query($database, $sql);
    header('Location: index.php?action=employee');
}
}

?>

<form action="index.php?action=employee" method="post">
    <input type="text" name="employee_name" placeholder="Employee name" required="required"/><br> <?php
    if (isset($errors['employee_name'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['employee_name']);?></span>
        <?php
    }
    ?><br/>
    <input type="submit" value="Save">
</form>

<h1>List of employees</h1>
<table>
    <tr>
        <th>
            Name
        </th>
    </tr>
    <?php
    $sql = "SELECT * FROM employees";
    $action = mysqli_query($database ,$sql);

    while ($row = mysqli_fetch_array($action)) {
        echo "<tr>";
        echo "<td>". $row['name'] ."</td>";
        echo "</tr>";
    }
    ?>

</table>