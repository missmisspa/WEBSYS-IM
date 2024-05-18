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
                    <form id="regAccForm" method="post" action="#">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        <i class="icon fas fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="forgot-password">
                                <a href="#">Forgot Password</a>
                            </div>
                        </div>
                        </div>                                
                        <div class="button-container">
                            <a href="#" class="custom-btn" id="register-btn">Login</a>
                        </div>
                    </form>
                        <div class="register-now">
                            <p>Don't Have An Account?<a href="register.php"> Register Now</a></p>
                        </div>
                    </div>  
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
    </script>
    
</body>
</html>
