<?php
include 'config.php';
include 'zoho_api.php';

$data = json_decode(file_get_contents('php://input'), true);
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = hash('sha256', $_POST['password']);

// Save to JSON file
$users = json_decode(file_get_contents('users.json'), true);
$users[] = ["name" => $name, "email" => $email, "mobile" => $mobile, "password" => $password];
file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

// Save to Zoho CRM
add_to_zoho_leads($name, $email, $mobile, $password);

echo "Registration successful";
?>
