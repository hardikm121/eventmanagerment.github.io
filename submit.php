<?php
$servername = "localhost:3306";
$username = "root";
$password = "263216";
$dbname = "jk";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;
$branch = $_POST['branch'] ?? '';
$gender = $_POST['gender'] ?? '';

// Validate form data
if (empty($name) || empty($email) || empty($phone) || empty($branch) || empty($gender)) {
    die("Error: All fields are required");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format");
}

if (!preg_match('/^\d{10}$/', $phone)) {
    die("Error: Invalid phone number format");
}

if ($age < 18 || $age > 60) {
    die("Error: Age must be between 18 and 60");
}

// Insert data into table
$sql = "INSERT INTO Registration (name, email, phone, age, branch, gender) VALUES ('$name', '$email', '$phone', '$age', '$branch', '$gender')";

if (mysqli_query($conn, $sql)) {
    echo "Record added successfully";
} else {
    echo "Error adding record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>