<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../public/assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <?php
                        require_once '../Database.php';
                        if(isset($_POST['submit'])){
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $pass = $_POST['pass'];
                            $re_pass = $_POST['re_pass'];
                            $phone = $_POST['phone'];

                            $errors = array();
                            $passwordHash = password_hash($pass,PASSWORD_BCRYPT);
                            //checking errors and validation
                            if(empty($name) || empty($email) || empty($pass) || empty($phone)){
                                array_push($errors,'all fields are required');
                            }

                            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                                array_push($errors,'email is not valid');
                            }

                            if(strlen($pass) < 8){
                                array_push($errors,'password must be at least 8 characters');
                            }

                            if($pass !== $re_pass){
                                array_push($errors,"please make sure you repeat your password correctly");
                            }
                            
                            //initiating database
                            $db = new Database();
                            
                            //checking if the user exists
                            $sql = "SELECT * FROM users WHERE email = ?";
                            $result = $db->prepare($sql,['s',$email]);
                            if($result->num_rows > 0){
                                array_push($errors,"email already exists");
                            }

                            if(count($errors) > 0){
                                echo '<ul>';
                                foreach($errors as $error){
                                    echo "<li style=\" color:red;\">" . $error . "</li>";
                                }
                                echo '</ul>';
                            }else{
                                    //creating the user if the account not found
                                    $sql = "INSERT INTO users(name,email,password,phone) VALUES(?,?,?,?)";
                                    $db->prepare($sql,['ssss',$name,$email,$passwordHash,$phone]);
                                    header("Location: signin.php");
                                    exit();
                                
                            }
                        }
                        ?>
                        <form method="POST" class="register-form" id="register-form" action="signup.php">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Your Phone"/>
                            </div>
                            <div class="form-group">
                            <a href="signin.php" class="signup-image-link">I am already member</a>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>

       

    </div>

    <!-- JS -->
    <script src="../../public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/assets/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>