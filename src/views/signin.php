<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />;
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../public/assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign in</h2>
                        <?php
                            if(isset($_POST["submit"])){
                                require_once "../Database.php";
                                require_once '../config.php';
                                $email = $_POST['email'];
                                $pass = $_POST['pass'];
                                $errors = array();
    
                                if(empty($email) || empty($pass)){
                                    array_push($errors,"all fields are required!");
                                }
    
                                if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($email)){
                                    array_push($errors,"email format is incorrect");
                                }
    
                                if(count($errors) >0){
                                    echo "<ul>";
                                    foreach($errors as $error){
                                        echo "<li style=\"color:red;\">".$error."</li>";
                                    }
                                    echo "</ul>";
                                }
    
    
                                $db = new Database();
                                $sql = 'SELECT * FROM users WHERE email = ?';
                                $result = $db->prepare($sql,['s',$email]);
                                $user = $result->fetch_assoc();
                                
                                
                                if($result->num_rows < 1){
                                    echo "<ul>";
                                    echo "<li style=\"color:red;\">email or password is wrong</li>";
                                    echo "</ul>";
                                }else {
                                    if(password_verify($pass,$user['password'])){
                                        echo "<ul>";
                                        echo "<li style=\"color:green;\">logged in</li>";
                                        echo "</ul>";
                                        session_start();
                                        

                                        $_SESSION['userId'] = $user['id'];
                                        $_SESSION['name'] = $user['name'];
                                        $_SESSION['email'] = $user['email'];
                                        $_SESSION['LAST_ACTIVITY'] = time();

                                        header('Location: ../../');
                                    }else{
                                        echo "<ul>";
                                        echo "<li style=\"color:red;\">1email or password is wrong</li>";
                                        
                                        echo "</ul>";
                                    }
                                }

                            }

                        ?>
                        <form method="POST" class="register-form" id="register-form" action="signin.php">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                            <a href="signup.php" class="signup-image-link">Don't Have an account?</a>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Login"/>
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