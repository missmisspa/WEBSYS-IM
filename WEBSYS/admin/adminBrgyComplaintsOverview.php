<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Complaints</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="adminBrgyComplaintsOverview.css">
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
            <a class="nav-link active" href="adminBrgyComplaintsOverview.php"><i class="fas fa-exclamation-circle"></i> Barangay Complaints</a>
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
<div id="content" style="margin-top: 20%;">
    <h2> Barangay Complaints</h2>
    <div class="button-container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-5">
                <a href="./adminBrgyComplaintsForm.php" class="custom-btn btn-block" id="submit-btn">Submit A Complaint</a>
            </div>
            <div class="col-md-5">
                <a href="./adminBrgyComplaintsSearch.php" class="custom-btn btn-block" id="search-btn">Search Barangay Complaints</a>
            </div>
        </div>
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
