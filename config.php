<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$action = $_REQUEST['action'] ?? null;

$ip = 'localhost';
$username = 'root';
$password = '';
$data_base = 'carwash';

$database = mysqli_connect($ip, $username, $password, $data_base);

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}
