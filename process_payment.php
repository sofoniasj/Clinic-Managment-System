<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["p_id"])) {
        $p_id = intval($_POST["p_id"]);

        $query = "SELECT * FROM lab_test WHERE p_id = $p_id";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = intval($row["id"]);
            $instruction = $row["instruction"];
            $result = $row["result"];

            $insertQuery = "INSERT INTO payed_lab_test (id, p_id, instruction, result)
                            VALUES ($id, $p_id, '$instruction', '$result')";

            if ($conn->query($insertQuery) === TRUE) {
                $deleteQuery = "DELETE FROM lab_test WHERE id = $id";

                if ($conn->query($deleteQuery) === TRUE) {
                    echo "Payment processed successfully!";
                } else {
                    echo "Error: " . $deleteQuery . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }
}
?>