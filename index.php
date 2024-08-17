<?php 
    require_once "src/Database.php";
    $db = new Database();
    $URI = $_SERVER['REQUEST_URI'];
    
    $segments = explode('/',trim($URI,'/'));
    if(isset($segments[1])){
        $id = $segments[1];
        $sql = 'SELECT * FROM urls WHERE shortenID = ?';
        
        $result = $db->prepare($sql,['s',$id]);
        $result = $result->fetch_assoc();
        $originalUrl = $result['originalUrl'];
        
        if (!preg_match('/^https?:\/\//i', $originalUrl)) {
            $originalUrl = 'http://' . $originalUrl; // Default to http:// if no protocol is specified
        }

        $clicks = $result['clicks'];
        $clicks++;
        $sql = 'UPDATE urls SET clicks=? WHERE shortenID=?';
        $db->prepare($sql,['is',$clicks,$id]);
        $db->close();

        header("Location: ". $originalUrl);
        exit();
    }else{
        header("Location: src/views/shortener.php");
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL shortener</title>
</head>
<body>
    
</body>
</html>
