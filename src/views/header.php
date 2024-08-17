<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/assets/css/contact.css">
    <title>custom title</title>

</head>

<nav class="flex flex-row justify-around py-5 items-center bg-[#83d888] text-white ">
    <a href="/">
        <img src="" alt="Logo">
    </a>
    <ul class="flex justify-between gap-5">
        <li><a href="contact.php">Contact</a></li>
        <li><a href="shortener.php">Shortener</a></li>
    </ul>
    <div class="flex gap-3 items-center">
        <?php
            session_start();
            if(!isset($_SESSION['email'])){
        ?>
            <a href="signin.php">signin</a>
            <a href="signup.php" class="text-white bg-[#03ACF2] py-2 px-5 rounded-lg">signup</a>
        <?php 
            }else{

        ?>
            <p>Hello <span class="text-yellow-300">
                <?php 
                    $fullName = $_SESSION['name'];
                    $firstName = explode(' ', trim($fullName))[0]; // Get the first name
                    echo htmlspecialchars($firstName); 
                ?> 
            </span></p>
            <a href="signout.php" class="text-white bg-[#03ACF2] py-2 px-5 rounded-lg">sign out</a>
        <?php }?>
    </div>
</nav>