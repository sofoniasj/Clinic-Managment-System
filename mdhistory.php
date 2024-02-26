<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Medical History</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="login.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>CMS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        
                  </div>   
                  
                </div>
                <div class="navbar-nav w-100">
                    <a href="login.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Assigned Patients</a>
                    <a href="diagnosis.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Lab Result</a>
                    
                    <a href="mdhistory.php" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Medical History</a>
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="insert.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>


                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>



                <div class="navbar-nav align-items-center ms-auto">
                    
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Account</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            
                            <a href="signin.html" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                
                    


<?php
	// Connect to database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "clinic";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	// Query to get patient names and their diagnosis IDs
	$sql = "SELECT reg_patients.id as p_id, reg_patients.name, diagnosis.diagnosis FROM reg_patients INNER JOIN diagnosis ON reg_patients.id = diagnosis.p_id ORDER BY reg_patients.name";

	$result = mysqli_query($conn, $sql);

	// Create an array to store the patient names and IDs
	$patient_names = array();

	// Display the results
	if (mysqli_num_rows($result) > 0) {
    	echo "<table class='table table-striped'>";
    	echo "<tr>";
    	echo "<th>Name</th>";
    	//echo "<th>Diagnosis</th>";
    	echo "<th>Show</th>";
    	echo "</tr>";
    	while($row = mysqli_fetch_assoc($result)) {
    		$p_id = $row["p_id"];
    		$name = $row["name"];
    	//	$diagnosis = $row["diagnosis"];

    		// Show patient name only once
    		if (!isset($patient_names[$p_id])) {
    			$patient_names[$p_id] = $name;
    			echo "<tr>";
    			echo "<td>" . $name . "</td>";
    			//echo "<td>" . $diagnosis . "</td>";
    			echo "<td>";
    			// Check for duplicates
    			$duplicate_sql = "SELECT COUNT(*) as count FROM diagnosis WHERE p_id = $p_id";
    			$duplicate_result = mysqli_query($conn, $duplicate_sql);
    			$row = mysqli_fetch_assoc($duplicate_result);
$duplicate_count = $row["count"];
    			if ($duplicate_count > 1) {
    				for ($i = 1; $i <= $duplicate_count; $i++) {
    					echo "<form action='show_diagnosis.php' method='post'>";
    					echo "<input type='hidden' name='p_id' value='" . $p_id . "'>";
    					echo "<input type='hidden' name='duplicate_number' value='" . $i . "'>";
    					echo "<button type='submit' class='btn btn-primary' name='show'>Show Diagnosis " . $i . "</button>";
    					echo "</form>";
    				}
    			} else {
    				echo "<form action='show_diag.php' method='post'>";
    				echo "<input type='hidden' name='p_id' value='" . $p_id . "'>";
    				echo "<button type='submit' class='btn btn-primary' name='show'>Show Diagnosis</button>";
    				echo "</form>";
    			}
    			echo "</td>";
    			echo "</tr>";
    		}
    	}
    	echo "</table>";
	} else {
    	echo "0 results";
	}

	mysqli_close($conn);
?>



   
   


    




            <!-- Blank End -->

            
           


           
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>