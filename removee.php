<?php
// Start output buffering
ob_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data from the database
$sql = "SELECT user_id, username, email FROM users";
$result = mysqli_query($conn, $sql);

// Display user data in a table
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Remove</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["user_id"] . "</td>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td><form method='POST'><input type='hidden' name='user_id' value='" . $row["user_id"] . "'><input type='submit' name='remove' value='Remove'></form></td>";
    echo "</tr>";
}

echo "</table>";

// Handle the form submission for removing a row
if (isset($_POST["remove"])) {
    $user_id = $_POST["user_id"];
    $sql = "DELETE FROM users WHERE user_id='$user_id'";
    mysqli_query($conn, $sql);
    
    // Redirect to the current page to refresh the table
    header("Location: remove.php");
    exit();
}

// Close the database connection
mysqli_close($conn);

// Get the buffered output and send it to the browser
$output = ob_get_clean();
echo $output;
?>