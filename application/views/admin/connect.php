<?php


$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "coba_db";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}