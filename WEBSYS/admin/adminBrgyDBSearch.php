<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Database</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="adminBrgyDBSearch.css">
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
    <div id="content-top" class="row">
        <div class="col-md-2">
            <a href="./adminBrgyDBOverview.php" class="custom-btn" id="back-btn">Back</a>
        </div>
        <div class="col-md-10">
            <h2>Barangay Database</h2>
        </div>
    </div>
    <div id="search-filter" class="row">
        <div class="col-6">
            <div id="search-box">
                <input type="text" class="form-control" placeholder="Search" id="search-input">
                <span id="search-icon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        <div class="col-6">
            <select class="form-control" id="filter-dropdown">
                <option value="">Filter By</option>
                <option value="Resident">Resident</option>
                <option value="Purok">Purok</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Senior-citizen">Senior Citizen</option>
                <option value="Adult">Adult</option>
                <option value="Youth">Youth</option>
                <option value="Children">Children</option>
            </select>
        </div>
    </div>
    <div class="row table-container">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Sex</th>
                        <th>Status</th>
                        <th>Voter Type</th>
                        <th>Resident Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="DatabaseTableBody">
                    <!-- brgy data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="button-container">
        <a href="./adminBrgyDBSearch.php" class="btn-custom" id="search-btn">Search Database</a>
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