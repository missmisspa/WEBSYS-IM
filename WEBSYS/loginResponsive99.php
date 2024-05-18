<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="loginResponsive.css">

    <style>
        .error {
            font-size: 12px;
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <section class="loginSection">
        <div class="background">
            <div class="containerTitle-Logo">
                <div class="logo-container">
                    <img src="icons/Legazpi-LOGO.png" alt="legazpi logo" class="img-fluid mb-2">
                    <img src="icons/BRGY LOGO.png" alt="tamaoyan logo" class="img-fluid mb-2">
                </div>
                <div class="titleText">
                    <p>Barangay<br>Monitoring<br>System</p>
                </div>
            </div>
            <div class="loginSectionContent">
                <div class="loginSectionContainer">
                    <h2>Login</h2>
                    <form id="regAccForm" method="post" action="#" onsubmit="return submitForm()">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter Username">
                                    <span id="usernameError" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter Password">
                                        <i class="icon fas fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                    <span id="passwordError" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="forgot-password">
                                <a href="searchforgotPass.html">Forgot Password</a>
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="submit" class="custom-btn" id="register-btn">Login</button>
                        </div>
                    </form>
<<<<<<< HEAD:WEBSYS/loginResponsive99.php
                        <div class="register-now">
                            <p>Don't Have An Account?<a href="register.php"> Register Now</a></p>
                        </div>
                    </div>  
=======
                    <div class="register-now">
                        <p>Don't Have An Account?<a href="register.html"> Register Now</a></p>
                    </div>
>>>>>>> 851ff7e12607a4c622a8f2f01a5ff871a40bca9d:WEBSYS/loginResponsive.html
                </div>
            </div>
        </div>
    </section>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
    
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    
        function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
    
            var usernameRegex = /^[a-zA-Z0-9]{8,}$/;
            var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    
            var usernameValid = usernameRegex.test(username);
            var passwordValid = passwordRegex.test(password);
    
            var usernameEmpty = username.trim() === '';
            var passwordEmpty = password.trim() === '';
    
            var errors = [];
    
            var usernameError = document.getElementById('usernameError');
            var passwordError = document.getElementById('passwordError');
    
            if (usernameEmpty) {
                errors.push('Username is required');
                usernameError.innerText = 'Username is required';
            } else if (!usernameValid) {
                errors.push('Username is not valid.');
                usernameError.innerText = 'Username is not valid.';
            } else {
                usernameError.innerText = '';
            }
    
            if (passwordEmpty) {
                errors.push('Password is required');
                passwordError.innerText = 'Password is required';
            } else if (!passwordValid) {
                errors.push('Password is not valid.');
                passwordError.innerText = 'Password is not valid.';
            } else {
                passwordError.innerText = '';
            }
    
            if (errors.length > 0) {
                return false;
            }
    
            return true;
        }
    
        function submitForm() {
            if (!validateForm()) {
                return false;
            }
            return true;
        }
    
        document.getElementById('register-btn').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default form submission behavior
            if (validateForm()) {
                window.location.href = 'user/userDashboard.html';
            }
        });
    </script>    
</body>
</html>
