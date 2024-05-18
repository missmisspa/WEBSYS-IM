<?php
session_start();

include("../connection.php");
include("../function.php");

$user_data = check_login($con);

// SQL queries to fetch data
$total_population_query = "SELECT COUNT(*) AS total FROM resident_info";
$senior_citizen_query = "SELECT COUNT(*) AS total FROM resident_info WHERE resi_age >= 60";
$adult_query = "SELECT COUNT(*) AS total FROM resident_info WHERE resi_age BETWEEN 18 AND 59";
$youth_query = "SELECT COUNT(*) AS total FROM resident_info WHERE resi_age BETWEEN 13 AND 17";
$children_query = "SELECT COUNT(*) AS total FROM resident_info WHERE resi_age < 13";
$male_query = "SELECT COUNT(*) AS total FROM resident_info WHERE resi_sex = 'Male'";
$female_query = "SELECT COUNT(*) AS total FROM resident_info WHERE resi_sex = 'Female'";

// Fetch data from database
$total_population_result = mysqli_query($con, $total_population_query);
$senior_citizen_result = mysqli_query($con, $senior_citizen_query);
$adult_result = mysqli_query($con, $adult_query);
$youth_result = mysqli_query($con, $youth_query);
$children_result = mysqli_query($con, $children_query);
$male_result = mysqli_query($con, $male_query);
$female_result = mysqli_query($con, $female_query);

// Fetch associative arrays
$total_population = mysqli_fetch_assoc($total_population_result)['total'];
$senior_citizen = mysqli_fetch_assoc($senior_citizen_result)['total'];
$adult = mysqli_fetch_assoc($adult_result)['total'];
$youth = mysqli_fetch_assoc($youth_result)['total'];
$children = mysqli_fetch_assoc($children_result)['total'];
$male = mysqli_fetch_assoc($male_result)['total'];
$female = mysqli_fetch_assoc($female_result)['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="adminBrgyDBOverview.css">
</head>
<body>
<div id="sidebar">
    <div class="text-center mb-4">
        <img src="Legazpi-LOGO.png" alt="Logo 1" class="img-fluid mb-2">
        <img src="BRGY LOGO.png" alt="Logo 2" class="img-fluid mb-2">
        <h4 class="text">Barangay Monitoring System</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="adminDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminProfile.php"><i class="fas fa-user"></i> Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="adminBrgyDBOverview.php"><i class="fas fa-database"></i> Barangay Database</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminBrgyComplaintsOverview.html"><i class="fas fa-exclamation-circle"></i> Barangay Complaints</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminFullDisclosureBoard.html"><i class="fas fa-clipboard-list"></i> Full Disclosure Board</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminOrgFlowchart.html"><i class="fas fa-sitemap"></i> Organizational Flowchart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminAbout.html"><i class="fas fa-info-circle"></i> About</a>
        </li>
        <li class="nav-item">
            <button type="submit" name="logout" class="nav-link logout" onclick="confirmLogout()" 
            style="border: none;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            background-color: #748C70;
                            color: #FFFFFF;
                            border-radius:10px; 
                            border:none;
                            transition: all 0.3s ease;
                            padding-left:30px;
                            padding-right:30px;
                            margin-left: 25px;"   
                            onmouseover="this.style.backgroundColor='#5F775B'; this.style.transform='scale(1.1)';" 
                            onmouseout="this.style.backgroundColor='#748C70'; this.style.transform='scale(1)';"
                            ><i class="fas fa-sign-out-alt"></i> Logout</button>
        </li>
    </ul>
</div>

<div id="content">
    <h2>Barangay Database</h2>
    <div id="container">
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <button class="custom-btn btn-color1"><span class="btn-text">Total Population</span>
                        <p class="text-center mt-2"><?php echo $total_population; ?></p>
                    </button>
                </div>
                <div class="col">
                    <button class="custom-btn btn-color2"><span class="btn-text">Senior Citizen</span>
                        <p class="text-center mt-2"><?php echo $senior_citizen; ?></p>
                    </button>
                </div>
                <div class="col">
                    <button class="custom-btn btn-color3"><span class="btn-text">Adult</span>
                        <p class="text-center mt-2"><?php echo $adult; ?></p>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <button class="custom-btn btn-color4"><span class="btn-text">Youth</span>
                        <p class="text-center mt-2"><?php echo $youth; ?></p>
                    </button>
                </div>
                <div class="col">
                    <button class="custom-btn btn-color5"><span class="btn-text">Children</span>
                        <p class="text-center mt-2"><?php echo $children; ?></p>
                    </button>
                </div>
                <div class="col">
                    <button class="custom-btn btn-color6"><span class="btn-text">Male</span>
                        <p class="text-center mt-2"><?php echo $male; ?></p>
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <button class="custom-btn btn-color7"><span class="btn-text">Female</span>
                        <p class="text-center mt-2"><?php echo $female; ?></p>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="button-container">
        <a href="./adminBrgyDBSearch.html" class="btn-custom" id="search-btn">Search Database</a>
    </div>
</div>

<div class="popup" id="popup">
    <div class="popup-content">
        <p>Are you sure you want to logout?</p>
        <button id="cancelButton" onclick="hidePopup()">Cancel</button>
        <a href="../logout.php"><button id="logoutBtn" onclick="logout()">Logout</button></a>
    </div>
</div>

<script>
    function showPopup() {
        document.getElementById('popup').classList.add('active');
    }

    function hidePopup() {
        document.getElementById('popup').classList.remove('active');
    }

    function confirmLogout() {
        showPopup();
    }
</script>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>