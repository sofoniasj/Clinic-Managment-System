<?php
session_start();
include 'db.php'; // assumes you have a file named "db.php" with database connection code

// Check if the user is logged in as a doctor
if (!isset($_SESSION['user_id']) || !isset($_SESSION['account_type']) || $_SESSION['account_type'] != 'doctor') {
    header('Location: login.php');
    exit();
}

// Query the database to get the list of assigned patients
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM assigned WHERE d_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>Patient ID</th><th>Name</th><th>Action</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $p_id = $row['p_id'];
        $sql = "SELECT * FROM reg_patients WHERE id='$p_id'";
        $result2 = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_assoc($result2);
        $name = $row2['name'];
        echo '<tr><td>'.$p_id.'</td><td>'.$name.'</td><td><a href="treat.php?p_id='.$p_id.'">Treat</a></td></tr>';
    }
    echo '</table>';
} else {
    echo 'You are not assigned to any patients.';
}
?>