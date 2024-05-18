<?php
session_start();

include("connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $suffix = $_POST['suffix'];
    $purok = $_POST['purok'];
    $brgy = $_POST['barangay'];
    $city = $_POST['city'];
    $prov = $_POST['province'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bdate = $_POST['birthday'];
    $contact = $_POST['contact_number'];
    $fruit = $_POST['fruit'];
    $cstatus = $_POST['cstatus'];
    $animal = $_POST['animal'];
    $citizen = $_POST['citizenship'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $userType = $_POST['userType'];
    $position = isset($_POST['position']) ? $_POST['position'] : '';

    if(!empty($email) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($purok) && !empty($brgy) &&
        !empty($city) && !empty($prov) && !empty($bdate) && !empty($sex) && !empty($password) && !empty($username) &&
        !empty($contact) && !empty($fruit) && !empty($cstatus) && !empty($animal) && !empty($citizen) && !empty($age)){

        // Check if username already exists
        $query_username = "SELECT * FROM brgy_info WHERE staff_username = '$username' UNION SELECT * FROM resident_info WHERE resi_username = '$username'";
        $result_username = mysqli_query($con, $query_username);
        if (mysqli_num_rows($result_username) > 0) {
            $_SESSION['notification'] = "Username is already taken.";
        }

        // Check if email already exists
        $query_email = "SELECT * FROM brgy_info WHERE staff_email = '$email' UNION SELECT * FROM resident_info WHERE resi_email = '$email'";
        $result_email = mysqli_query($con, $query_email);
        if (mysqli_num_rows($result_email) > 0) {
            $_SESSION['notification'] = "Email is already taken.";
            header("Location: your_form_page.php");
        }

        if($userType == 'barangay-council') {
            // Check if position is selected
            if(empty($position)) {
                $_SESSION['notification'] = "Please select a position.";
                header("Location: your_form_page.php");
            }

            // Check the current number of users for each position
            $sql_count = "SELECT COUNT(*) as count FROM brgy_info WHERE position = '$position'";
            $result = mysqli_query($con, $sql_count);
            $row = mysqli_fetch_assoc($result);
            $current_count = $row['count'];

            // Determine the maximum number of users allowed for each position
            $max_count = 7; // For Kagawad
            if ($position == "BrgyChairman" || $position == "BrgySecretary" || $position == "BrgyTreasurer") {
                $max_count = 1; // For Chairman, Secretary, and Treasurer
            }

            if($current_count < $max_count) {
                // Insert into brgy_info table for barangay officials
                $query = "INSERT INTO brgy_info (f_name, m_name, l_name, suffix, bdate, gender, email, password, position, staff_zone, staff_brgy, staff_city, staff_province, staff_contact, staff_fruit, staff_cstatus, staff_animal, staff_citizenship, staff_age, staff_username) 
                          VALUES ('$fname', '$mname', '$lname', '$suffix', '$bdate', '$sex', '$email', '$password', '$position', '$purok', '$brgy', '$city', '$prov', '$contact', '$fruit', '$cstatus', '$animal', '$citizen', '$age', '$username')";

                if(mysqli_query($con, $query)){
                    header("Location: login.php");
                    die();
                } else {
                    $_SESSION['notification'] = "Error: " . $query . "<br>" . mysqli_error($con);
                }
            } else {
                $_SESSION['notification'] = "Maximum limit for $position reached. Please try again later.";
            }
        } else {
            // Insert into resident_info table for residents
            $query = "INSERT INTO resident_info (resi_fname, resi_mname, resi_lname, resi_suffix, resi_zone, resi_brgy, resi_city, resi_province, resi_age, resi_bdate, resi_ctatus, resi_citizenship, resi_sex, resi_educ, resi_contact, resi_email, resi_username, resi_password, resi_fruit, resi_animal) 
                      VALUES ('$fname', '$mname', '$lname', '$suffix', '$purok', '$brgy', '$city', '$prov', '$age', '$bdate', '$cstatus', '$citizen', '$sex', '$educ', '$contact', '$email', '$username', '$password', '$fruit', '$animal')";
            
            if(mysqli_query($con, $query)){
                header("Location: loginResponsive.php");
                die();
            } else {
                $_SESSION['notification'] = "Error: " . $query . "<br>" . mysqli_error($con);
                header("register.php");
                exit();
            }
        }
    } else {
        $_SESSION['notification'] = "Please input all required fields.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="register.css">

    <style>
        .notification {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            z-index: 9999;
        }
        .is-invalid input[type="radio"] {
            outline: 2px solid red;
        }
        .is-invalid input[type="radio"] + .form-check-label {
            color: red;
        }

        .is-invalid input[type="radio"]:checked + .form-check-label {
            color: red;
        }

        #userTypeRadioBtn {
            display: flex;
            align-items: center;
        }

        #userTypeRadioBtn .form-group {
            margin-bottom: 0; /* Remove bottom margin for proper alignment */
        }
        #position-container {
            display: none;
        }
        #position-container {
            position: absolute;
            top: 100%;
            left: 13%;
        }

        #position-container.hidden {
            display: none;
        }

        .userTypeRadioBtn {
            display: flex;
            align-items: center;
        }

        .userTypeRadioBtn .form-group {
            margin-bottom: 0;
        }

    </style>
</head>

<body>
    <section class="regForm" id="regForm">
        <div id="content">
            <h2>Register</h2>
            <div id="container">
                <form id="regiForm" method="POST" class="forms" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="fname" placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="mname" placeholder="Enter Middle Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="lname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" id="suffix_name" name="suffix" placeholder="Enter Suffix">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="purok">Purok</label>
                                <select class="form-control" id="purok" name="purok" placeholder="Select your purok" required>
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
                                <input type="text" class="form-control" id="barangay" name="barangay" value="Tamaoyan" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="Legazpi City" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province" value="Albay" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                                <p id="birthday-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select class="form-control" id="cstatus" name="cstatus" placeholder="Select Civil Status" required>
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
                                <input type="text" class="form-control" id="citizenship" name="citizenship" value="Filipino" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <div class="row">
                                    <div class="col">
                                        <div id="radioBtn" class="radioBtn">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sex" id="male" value="male" required>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sex" id="female" value="female" required>
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
                                <select class="form-control" id="status" name="educ" placeholder="Select your educational attainment" required>
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
                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
                            </div>
                        </div>
                        <div class="container-userType">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <div class="col">
                                                <div id="userTypeRadioBtn" class="userTypeRadioBtn">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="userType" id="barangayCouncil" value="barangay-council" required>
                                                        <label class="form-check-label" for="barangay-council">Barangay Council</label>
                                                    </div>
                                                    <div class="form-group ml-3" id="position-container">
                                                        <select class="form-control" id="position" name="position" required>
                                                            <option value="" disabled selected>Select your position</option>
                                                            <option value="BrgyChairman">Brgy Chairman</option>
                                                            <option value="BrgySecretary">Brgy Secretary</option>
                                                            <option value="BrgyTreasurer">Brgy Treasurer</option>
                                                            <option value="BrgyKagawad">Brgy Kagawad</option>
                                                            <option value="SKChairman">SK Chairman</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="userType" id="resident" value="resident" required>
                                                    <label class="form-check-label" for="resident">Resident</label>
                                                </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="button-container" style="margin-top: 30px; margin-bottom: 30px">
                    <a href="./login1.html" class="btn-custom" id="cancel-btn" style="width: 100px;">Cancel</a>
                    <button class="custom-btn" id="next-btn" onclick="scrollToRegAcc()" style="width: 100px">Next</button>
                </div>
            </div>
        </div>
    </section>

    <section class="registerAcc" id="registerAcc" style="display: none;">
        <div class="contentRegAcc">
            <div class="containerTitle-Logo">
                <div class="logo-container">
                    <img src="icons/Legazpi-LOGO.png" alt="legazpi logo" class="img-fluid mb-2">
                    <img src="icons/BRGY LOGO.png" alt="tamaoyan logo" class="img-fluid mb-2">
                </div>
                <div class="titleText">
                    <p>Barangay<br>Monitoring<br>System</p>
                </div>
            </div>
            <div class="registerAccContent">
                <h2>Register</h2>
                <div class="registerAccContainer">
                    <form id="regAccForm" method="POST" action="#">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                                    <span class="text-danger" id="username-error" style="position: absolute; font-size: 13px;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                    <span class="text-danger" id="password-error" style="position: absolute; font-size: 13px;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Reenter Password" required>
                                    <p id="confirm-password-error" class="text-danger" style="position: absolute; font-size: 13px;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="securityPrompt">
                                    <p>In case you forgot your password, here are your security questions to regain access to your account.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fruit">What is your favorite fruit?</label>
                                    <input type="text" class="form-control" id="fruit" name="fruit" placeholder="Enter your favorite fruit" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fruit">What is your favorite animal?</label>
                                    <input type="text" class="form-control" id="animal" name="animal" placeholder="Enter your favorite animal" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex align-items-center justify-content-center">
                                <div class="terms-conditions">
                                    <input type="checkbox" class="form-control" id="termsAndconditions" name="termsAndconditions">
                                    <label for="termsAndconditions">By creating an account, you agree to the Terms and Conditions and Privacy Policy of our website.</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="button-container">
                        <button class="btn-custom" id="back-btn" onclick="scrollToRegForm()">Back</button>
                        <button type="submit" class="custom-btn" id="register-btn" onclick="validateForm()">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="notification" class="notification" style="display: none; background-color: #4CAF50; color: white; text-align: center; padding: 10px;">
        <p>Registration successful!</p>
    </div>

    <script>
    // Function to update position dropdown based on selected user type
    function updatePositionDropdown() {
        var positionContainer = document.getElementById('position-container');
        var positionDropdown = document.getElementById('position');

        if (document.getElementById('barangayCouncil').checked) {
            positionContainer.style.display = 'block';
            positionDropdown.required = true; // Make the dropdown required
        } else {
            positionContainer.style.display = 'none';
            positionDropdown.selectedIndex = 0; // Reset dropdown selection
            positionDropdown.required = false; // Make the dropdown not required
        }
    }

    // Add event listener to the radio buttons
    var radios = document.querySelectorAll('input[name="userType"]');
    radios.forEach(function(radio) {
        radio.addEventListener('change', updatePositionDropdown);
    });

    // Function to validate registration form
    function validateForm() {
        var requiredFields = document.querySelectorAll('input[required], select[required]');
        var errorMessages = document.querySelectorAll('.text-danger');
        var hasErrors = false;
        var isFirstSectionEmpty = false;

        // Remove existing error highlighting and messages
        requiredFields.forEach(function(field) {
            field.classList.remove('is-invalid');
        });
        errorMessages.forEach(function(message) {
            message.textContent = "";
        });

        // Validate username
        var usernameInput = document.getElementById('username');
        var usernameError = document.getElementById('username-error');
        if (usernameInput.value.length < 8 || usernameInput.value.length > 20) {
            hasErrors = true;
            usernameInput.classList.add('is-invalid');
            usernameError.textContent = "Username must be between 8 and 20 characters long.";
        }

        // Validate password
        var passwordInput = document.getElementById('password');
        var passwordError = document.getElementById('password-error');
        if (passwordInput.value.length < 8 || passwordInput.value.length > 20) {
            hasErrors = true;
            passwordInput.classList.add('is-invalid');
            passwordError.textContent = "Password must be between 8 and 20 characters long.";
        }

        // Validate confirm password
        var confirmPasswordInput = document.getElementById('confirm-password');
        var confirmPasswordError = document.getElementById('confirm-password-error');
        if (confirmPasswordInput.value !== passwordInput.value) {
            hasErrors = true;
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordError.textContent = "Passwords do not match.";
        }

        // Validate required fields
        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                hasErrors = true;
                field.classList.add('is-invalid'); // Highlight empty fields
                if (field.closest('#regForm')) {
                    isFirstSectionEmpty = true;
                }
            }
        });

        // Validate date field
        var birthdayInput = document.getElementById('birthday');
        var birthdayValue = new Date(birthdayInput.value);
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0 for comparison
        if (isNaN(birthdayValue) || birthdayValue > currentDate) {
            hasErrors = true;
            birthdayInput.classList.add('is-invalid');
            var errorMessage = document.getElementById('birthday-error');
            if (errorMessage) {
                errorMessage.textContent = "Please select a valid date";
            }
            if (birthdayInput.closest('#regForm')) {
                isFirstSectionEmpty = true;
            }
        } else {
            birthdayInput.classList.remove('is-invalid');
            var errorMessage = document.getElementById('birthday-error');
            if (errorMessage) {
                errorMessage.textContent = "";
            }
        }

        // Validate radio buttons
        var radioGroups = document.querySelectorAll('input[type="radio"][name="userType"][required]');
        radioGroups.forEach(function(group) {
            var checked = document.querySelector('input[name="userType"]:checked');
            if (!checked) {
                hasErrors = true;
                document.querySelectorAll('.userTypeRadioBtn').forEach(function(container) {
                    container.classList.add('is-invalid');
                    container.querySelector('.form-check-label').classList.add('is-invalid');
                });
                if (group.closest('#regForm')) {
                    isFirstSectionEmpty = true;
                }
            } else {
                document.querySelectorAll('.userTypeRadioBtn').forEach(function(container) {
                    container.classList.remove('is-invalid');
                    container.querySelector('.form-check-label').classList.remove('is-invalid');
                });
            }
        });

        // Validate sex radio buttons
        var sexRadioGroup = document.querySelectorAll('#radioBtn input[type="radio"][required]');
        sexRadioGroup.forEach(function(radio) {
            var formGroup = radio.closest('.form-group');
            var checked = formGroup.querySelector(':checked');
            if (!checked) {
                hasErrors = true;
                formGroup.classList.add('is-invalid');
                var label = formGroup.querySelector('.form-check-label');
                if (label) {
                    label.classList.add('is-invalid');
                }
                if (formGroup.closest('#regForm')) {
                    isFirstSectionEmpty = true;
                }
            } else {
                formGroup.classList.remove('is-invalid');
                var label = formGroup.querySelector('.form-check-label');
                if (label) {
                    label.classList.remove('is-invalid');
                }
            }
        });

        if (hasErrors) {
            window.scrollTo(0, 0);
            alert("Please fill out all required fields correctly before proceeding.");
            if (isFirstSectionEmpty) {
                scrollToRegForm(); // Go back to the first section
            }
            return false;
        } else {
            showNotification();
            return false; // Prevent form submission
        }
    }

    // Function to scroll to registration account section
    function scrollToRegAcc() {
        var section2 = document.getElementById('registerAcc');
        section2.style.display = 'block';
        var section1 = document.getElementById('regForm');
        section1.style.display = 'none';
    }

    // Function to scroll to registration form section
    function scrollToRegForm() {
        var section1 = document.getElementById('regForm');
        section1.style.display = 'block';
        var section2 = document.getElementById('registerAcc');
        section2.style.display = 'none';
    }

    // Function to show registration success notification and redirect to login page
    function showNotification(isSuccess = true) {
        var notification = document.getElementById('notification');
        if (isSuccess) {
            notification.textContent = "Registration successful!";
            setTimeout(function() {
                notification.style.display = 'none';
                window.location.href = "loginResponsive.php"; // Redirect to loginResponsive.php
            }, 2000); // Hide notification after 2 seconds
        } else {
            notification.textContent = "Registration failed. Please try again.";
            setTimeout(function() {
                notification.style.display = 'none';
            }, 2000); // Hide notification after 2 seconds
        }
    }
</script>


</body>

</html>
