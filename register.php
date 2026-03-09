<?php
$host = "localhost";
$dbname = "ceylontales";
$username = "root";
$password = "";  // XAMPP default has no password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed"]));
}

$full_name   = $_POST['full_name'];
$email       = $_POST['email'];
$nationality = $_POST['nationality'];
$password    = $_POST['password'];

$stmt = $conn->prepare("INSERT INTO user (Full_name, Email, Nationality, Password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $email, $nationality, $password);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Email already exists"]);
}

$stmt->close();
$conn->close();
?>