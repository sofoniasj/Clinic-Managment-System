<?php
$host = "localhost"; //your database server
$user = "root"; //database administrator
$pw = "";//since we didn't assigned password to the database
$dbname = "clinic"; // in your case you database name, your first database

$conn = mysqli_connect($host, $user, $pw,$dbname); //now configure by executing mysqli_connect, used to connect with
//mysqli_select_db($conn, $dbname); // select our active database

/*
if(!$conn)
  die("Connection Failed ".mysql.error());
else
echo "Connection Succeeded!";
*/
?>