<?php
include("../connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $complainant = mysqli_real_escape_string($con, $_POST['complainant']);
    $respondent = mysqli_real_escape_string($con, $_POST['respondent']);
    $hearing = mysqli_real_escape_string($con, $_POST['hearing']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $sql = "INSERT INTO complaint_table (complainant_name, respondent_name, complaint_sched, complaint_date) VALUES ('$complainant', '$respondent', '$hearing', '$date')";

    if (mysqli_query($con, $sql)) {

        header("Location: ../generate_pdf/generate_complaint.php");
        exit();
    } else {
        echo "<script>alert('Error: Could not submit the complaint');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Monitoring System - Complaints</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="adminBrgyComplaintsForm.css">
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
                <a class="nav-link" href="adminBrgyDBOverview.php"><i class="fas fa-database"></i> Barangay Database</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="adminBrgyComplaintsOverview.html"><i class="fas fa-exclamation-circle"></i> Barangay Complaints</a>
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
                <button type="submit" name="logout" class="nav-link logout" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </li>
        </ul>
    </div>
    
<div id="content">
    <div id="container">
        <h2>Barangay Complaints</h2>
        <form id="registrationForm" method="post" action="#" target="_blank">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="complainant">Complainant:</label>
                        <input type="text" class="form-control" id="complainant" name="complainant" placeholder="Enter the name of the Complainant" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="respondent">Respondent:</label>
                        <input type="text" class="form-control" id="respondent" name="respondent" placeholder="Enter the name of the respondent" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hearing">Schedule of Hearing:</label>
                        <input type="datetime-local" class="form-control" id="hearing" name="hearing" required>
                        <small class="error-message" id="hearing-error"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">Issued Date:</label>
                        <input type="date" class="form-control" id="date" name="date" readonly required>
                    </div>
                </div>
            </div>   
            <div class="button-container">
                <a href="adminBrgyComplaintsOverview.php" class="btn-custom" id="back-btn">Back</a>
                <button class="custom-btn" id="next-btn" type="submit">Submit</button>
            </div>            

        </form>
            
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
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();
    var form = this;
    

    form.submit();

    setTimeout(function() {
        form.reset(); 
        window.location.href = "adminBrgyComplaintsOverview.php";
    }, 1000);
});
document.addEventListener("DOMContentLoaded", function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById('date').value = today;
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

    
