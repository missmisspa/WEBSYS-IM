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
            <a class="nav-link" href="adminBrgyComplaintsOverview.php"><i class="fas fa-exclamation-circle"></i> Barangay Complaints</a>
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
                <input type="text" class="form-control" placeholder="Search" id="search-input" onkeyup="filterTable()">
                <span id="search-icon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        <div class="col-6">
            <select class="form-control" id="filter-dropdown" onchange="filterTable()">
                <option value="">Filter By</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Children">Children</option>
                <option value="Youth">Youth</option>
                <option value="Adult">Adult</option>
                <option value="Senior Citizen">Senior Citizen</option>
                <option value="Purok 1">Purok 1</option>
                <option value="Purok 2">Purok 2</option>
                <option value="Purok 3">Purok 3</option>
                <option value="Purok 4">Purok 4</option>
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
                        <th>Birthdate</th>
                        <th>Sex</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Purok</th>
                    </tr>
                </thead>
                <tbody id="DatabaseTableBody">
                <?php
                    include("../connection.php");

                    $sql = "SELECT * FROM resident_info";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['resident_id'] . "</td>";
                            echo "<td>" . $row['resi_fname'] . " " . $row['resi_mname'] . " " . $row['resi_lname'] ." ". $row['resi_suffix'] ."</td>";
                            echo "<td>" . $row['resi_bdate'] . "</td>";
                            echo "<td>" . $row['resi_sex'] . "</td>";
                            echo "<td>" . $row['resi_contact'] . "</td>";
                            echo "<td>" . $row['resi_email'] . "</td>";
                            echo "<td>" . $row['resi_zone'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No residents found</td></tr>";
                    }

                    mysqli_close($con);
                ?>
                </tbody>
            </table>
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

    function calculateAge(birthdate) {
        var birthDate = new Date(birthdate);
        var today = new Date();
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    function filterTable() {
        var input, filter, table, tr, i, j, txtValue, selectedFilter;
        input = document.getElementById("search-input").value.toUpperCase();
        selectedFilter = document.getElementById("filter-dropdown").value.toUpperCase();
        table = document.getElementById("DatabaseTableBody");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var showRow = false;
            var td = tr[i].getElementsByTagName("td");

            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(input) > -1) {
                        showRow = true;
                        break;
                    }
                }
            }

            if (selectedFilter) {
                var sexCell = td[3].textContent.toUpperCase();
                var age = calculateAge(td[2].textContent.trim());
                var purokCell = td[6].textContent.toUpperCase();
                
                if (selectedFilter === "MALE" && sexCell !== "MALE") {
                    showRow = false;
                } else if (selectedFilter === "FEMALE" && sexCell !== "FEMALE") {
                    showRow = false;
                } else if (selectedFilter === "CHILDREN" && age >= 13) {
                    showRow = false;
                } else if (selectedFilter === "YOUTH" && (age < 13 || age > 17)) {
                    showRow = false;
                } else if (selectedFilter === "ADULT" && (age < 18 || age > 59)) {
                    showRow = false;
                } else if (selectedFilter === "SENIOR CITIZEN" && age < 60) {
                    showRow = false;
                } else if (selectedFilter === "PUROK 1" && purokCell !== "PUROK 1") {
                    showRow = false;
                } else if (selectedFilter === "PUROK 2" && purokCell !== "PUROK 2") {
                    showRow = false;
                } else if (selectedFilter === "PUROK 3" && purokCell !== "PUROK 3") {
                    showRow = false;
                } else if (selectedFilter === "PUROK 4" && purokCell !== "PUROK 4") {
                    showRow = false;
                }
            }

            tr[i].style.display = showRow ? "" : "none";
        }
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
