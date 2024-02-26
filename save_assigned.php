<?php
	$servername = "localhost"; // Replace with your MySQL server name
	$username = "root"; // Replace with your MySQL username
	$password = ""; // Replace withyour MySQL password
	$dbname = "clinic"; // Replace with the name of your MySQL database

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Get the values from the form and insert them into the assigned table
	$p_id = $_POST['p_id'];
	$doctor = $_POST['doctor'];
	$text = $_POST['text'];
	$sql = "INSERT INTO assigned (p_id, d_id, doctor, text) VALUES ('$p_id', '$doctor', (SELECT username FROM users WHERE user_id='$doctor'), '$text')";

	if (mysqli_query($conn, $sql)) {
	    // If the insert was successful, delete the patient from the queue table
	    $sql = "DELETE FROM queue WHERE p_id='$p_id'";
	    mysqli_query($conn, $sql);
	    echo header("Location: index.php");;
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	// Close the MySQL connection
	mysqli_close($conn);
?>