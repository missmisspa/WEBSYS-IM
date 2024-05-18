<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="userEditProfile.css">
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
            <a class="nav-link" href="userDashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="userProfile.html"><i class="fas fa-user"></i> Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userComplaintsOverview.html"><i class="fas fa-exclamation-circle"></i> Complaints</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userFullDisclosureBoard.html"><i class="fas fa-clipboard-list"></i> Full Disclosure Board</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userOrgFlowchart.html"><i class="fas fa-sitemap"></i> Organizational Flowchart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userAbout.html"><i class="fas fa-info-circle"></i> About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link logout" href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</div>

<div id="content">
    <h2>Edit Profile</h2>
    <div id="container">
        <!-- link php here -->
        <div class="profile-image">
            <img src="placeholder.jpg" alt="Profile Image">
        </div>
        <form id="profileForm" method="post" action="#">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" class="form-control" id="suffix_name" name="suffix_name" placeholder="Enter Suffix">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="purok">Purok</label>
                        <select class="form-control" id="purok" name="purok" placeholder="Select your purok">
                        <option value="" disabled selected>Select your purok</option>
                        <option value="Single">Purok 1</option>
                        <option value="Married">Purok 2</option>
                        <option value="Divorced">Purok 3</option>
                        <option value="Widowed">Purok 4</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="barangay">Barangay</label>
                        <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter Barangay">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province" placeholder="Enter Province">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" id="status" name="status" placeholder="Select Civil Status">
                            <option value="" disabled selected>Select your civil status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                            <option value="Annulled">Annulled</option>
                            <option value="LiveIn">Live-in</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="citizenship">Citizenship</label>
                        <input type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Enter Citizenship">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <div class="row">
                            <div class="col">
                                <div id="radioBtn" class="radioBtn">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="education">Educational Attainment</label>
                        <select class="form-control" id="status" name="status" placeholder="Select your educational attainment">
                            <option value="" disabled selected>Select your educational attainment</option>
                            <option value="NoEducation">No Formal education</option>
                            <option value="PrimaryLevel">Primary Level</option>
                            <option value="PrimaryEducation">Primary Education</option>
                            <option value="SecondaryEducation">Secondary Education</option>
                            <option value="VocationalLevel">Vocational Level</option>
                            <option value="VocationalEducation">Vocational Education</option>
                            <option value="CollegeLevel">College Level</option>
                            <option value="CollegeEducation">College Education</option>
                            <option value="MasterLevel">Master Level</option>
                            <option value="MasterEducation">Master Education</option>
                            <option value="DoctorateLevel">Doctorate Level</option>
                            <option value="DoctorateEducation">Doctorate Education</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number">
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address">
                </div>                                
            </div>
            </div>
            <div class="button-container">
                <a href="userProfile.php" class="btn-custom" id="editProfile-btn">Cancel</a>
                <a href="userProfile.phpp" class="custom-btn" id="editProfile-btn">Save Changes</a>
            </div>
        </form>
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
        window.location.href = '../loginResponsive.html';
    }
</script>  
        

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    
