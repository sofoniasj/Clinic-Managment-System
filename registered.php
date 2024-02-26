<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Insert Patient</title>
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
                <a href="insert.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>CMS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        
                  </div>   
                  
                </div>
                <div class="navbar-nav w-100">
                    <a href="insert.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Insert</a>
                    <a href="registered.php" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Registered</a>
                    <a href="queue.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Queue</a>
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
                    <input class="form-control border-0" type="search" name="search" placeholder="Search">
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
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if the Queue button was clicked
if (isset($_POST['queue'])) {
    // Get the patient data from the form
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $p_id = $_POST['id'];

    // Insert the patient data into the queue table
    $stmt = $conn->prepare("INSERT INTO queue (name, sex, email, phone_number, p_id) VALUES (:name, :sex, :email, :phone_number, :p_id)");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":sex", $sex);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone_number", $phone_number);
    $stmt->bindParam(":p_id", $p_id);
    $stmt->execute();

    // Redirect to the registered.php page
    echo "<script>window.location.href = 'registered.php';</script>";
   // header('Location: registered.php');
    exit();
}

// Retrieve data from database
if (isset($_GET['search'])) {
  $search = '%'.$_GET['search'].'%';
  $stmt = $conn->prepare("SELECT * FROM reg_patients WHERE name LIKE :search");
  $stmt->bindParam(":search", $search);
} else {
  $stmt = $conn->prepare("SELECT * FROM reg_patients");
}
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display data in table form with button to queue each row
echo "<form method='get' action=''>";

echo "</form>";
echo "<table class='table table-striped'>";
echo "<tr><th>Name</th><th>Sex</th><th>Email</th><th>Phone Number</th><th>Queue</th></tr>";
foreach ($results as $row) {
    echo "<tr><td>".$row['name']."</td><td>".$row['sex']."</td><td>".$row['email']."</td><td>".$row['phone_number']."</td><td>
    <form method='post' action=''>
        <input type='hidden' name='name' value='".$row['name']."'>
        <input type='hidden' name='sex' value='".$row['sex']."'>
        <input type='hidden' name='email' value='".$row['email']."'>
        <input type='hidden' name='phone_number' value='".$row['phone_number']."'>
        <input type='hidden' name='id' value='".$row['id']."'> <!-- Add hidden input field for the id -->
        <button type='submit' name='queue'>Queue</button>
    </form>
    </td></tr>";
}
echo "</table>";

// Close the database connection
$conn = null;
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