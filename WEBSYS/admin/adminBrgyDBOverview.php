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
            <a class="nav-link logout" href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
                                <p class="text-center mt-2">521</p>
                            </button>
                            
                        </div>
                        <div class="col">
                            <button class="custom-btn btn-color2"><span class="btn-text">Senior Citizen</span>
                                <p class="text-center mt-2">56</p>
                            </button>
                        </div>
                        <div class="col">
                            <button class="custom-btn btn-color3"><span class="btn-text">Adult</span>
                                <p class="text-center mt-2">124</p>
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button class="custom-btn btn-color4"><span class="btn-text">Youth</span>
                                <p class="text-center mt-2">245</p>
                            </button>
                        </div>
                        <div class="col">
                            <button class="custom-btn btn-color5"><span class="btn-text">Children</span>
                                <p class="text-center mt-2">145</p>
                            </button>
                        </div>
                        <div class="col">
                            <button class="custom-btn btn-color6"><span class="btn-text">Male</span>
                                <p class="text-center mt-2">245</p>
                            </button>
                        </div>
                        </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button class="custom-btn btn-color7"><span class="btn-text">Female</span>
                                <p class="text-center mt-2">325</p>
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
        <button id="logoutBtn" onclick="logout()">Logout</button>
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

    function logout() {
        hidePopup();
        window.location.href = '../login1.html'; 
    }
</script>  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>