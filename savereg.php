<?php
// Connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the save button is clicked, insert the data into the reg_patients table and delete it from the patients table after 5 seconds delay
$stmt = $conn->prepare("INSERT INTO reg_patients (name, sex, email, phone_number) VALUES (:name, :sex, :email, :phone_number)");
$stmt->bindParam(":name", $_POST["name"]);
$stmt->bindParam(":sex", $_POST["sex"]);
$stmt->bindParam(":email", $_POST["email"]);
$stmt->bindParam(":phone_number", $_POST["phone_number"]);
$stmt->execute();

echo "Patient saved successfully!";
     
        // Wait for 5 seconds
        sleep(5);
        
        $name = $_POST['name'];
        $sql_delete = "DELETE FROM patients WHERE name=$name";
        
        
    


// Close the database connection

?>