<?php

if(isset($_POST['service_name'])){
    $title = $_POST['service_name'];
    $price = $_POST['service_price'];


    $errors = [];

    $sql = "SELECT * FROM services WHERE title = '$title'";
    $result = mysqli_query($database, $sql);
    if(mysqli_num_rows($result)) {
        $errors['service_title'][] = 'This service already created!';
    }

if (empty($errors)) {
    $sql = "INSERT INTO services (title, price) VALUES ('$title', '$price')";
    $result = mysqli_query($database, $sql);
    header('Location: index.php?action=services');
}
}

?>

<form action="index.php?action=services" method="post">
    <input type="text" name="service_name" placeholder="Service title" required="required"/> <?php
    if (isset($errors['service_title'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['service_title']);?></span>
    <?php
    }
    ?> <br/>
    <input type="number" step="0.01" name="service_price" placeholder="Price" required="required"/> <br/>
    <input type="submit" value="Save">
</form>

<h1>List of services</h1>
<table>
    <tr>
        <th>
            Title
        </th>
        <th>
            Price
        </th>
    </tr>
    <?php
    $sql = "SELECT * FROM services";
    $action = mysqli_query($database ,$sql);

    while ($row = mysqli_fetch_array($action)) {
        echo "<tr>";
        echo "<td>". $row['title'] ."</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "</tr>";
    }
    ?>

</table>