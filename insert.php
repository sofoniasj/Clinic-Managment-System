<?php
// define database credentials
define('DB_HOST', 'localhost'); // replace with your database host
define('DB_NAME', 'clinic'); // replace with your database name
define('DB_USER', 'root'); // replace with your database username
define('DB_PASS', ''); // replace with your database password

// connect to the database
try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
// check if the form is submitted
// check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get the form data
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // validate the form data
    if(empty($name) || empty($sex) || empty($email) || empty($phone)) {
        echo 'All fields are required.';
        exit;
    }

    // insert the patient record into the database
    $stmt = $conn->prepare("INSERT INTO patients (name, sex, email, phone_number) VALUES (:name, :sex, :email, :phone)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':sex', $sex);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    if($stmt->execute()) {
        echo header('location: insert.html');;
    } else {
        echo 'Unable to register patient at this time.';
    }

}

?>