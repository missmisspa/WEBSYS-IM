<?php
    include("../connection.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barangay Monitoring System - Complaints</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="adminBrgyComplaintsSearch.css">
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
                <button type="submit" name="logout" class="nav-link logout" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </li>
        </ul>
    </div>
    
<div id="content">
    <div id="content-top" class="row">
        <div class="col-md-2">
            <a href="./adminBrgyComplaintsOverview.php" class="custom-btn" id="back-btn">Back</a>
        </div>
        <div class="col-md-10">
            <h2>Barangay Complaints</h2>
        </div>
    </div>
    <div id="search-filter" class="row">
        <div class="col-6">
            <div id="search-box">
                <input type="text" class="form-control" placeholder="Search" id="search-input" onkeyup="search()">
                <span id="search-icon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row table-container">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Complainant</th>
                        <th>Respondent</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="DatabaseTableBody">
                    <?php
                    include("../connection.php");

                    
                    $sql = "SELECT * FROM complaint_table";
                    $result = mysqli_query($con, $sql);

                    
                    if (mysqli_num_rows($result) > 0) {
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['complaint_id'] . "</td>";
                            echo "<td>" . $row['complainant_name'] . "</td>";
                            echo "<td>" . $row['respondent_name'] . "</td>";
                            echo "<td>" . $row['complaint_date'] . "</td>";
                            echo "<td><a href='../generate_pdf/generate_complaintsSearch.php?complaint_id=" . $row['complaint_id'] . "' target='_blank'>View Details</a></td>"; 
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No complaints found</td></tr>";
                    }

                    mysqli_close($con); // Close the database connection
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
function search() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("DatabaseTableBody");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            cell = tr[i].getElementsByTagName("td")[j];
            if (cell) {
                txtValue = cell.textContent || cell.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}
</script>  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
