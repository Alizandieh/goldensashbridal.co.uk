<?php


if(isset($_REQUEST["isvalid"])){
    
    $youremail = "info@goldensashbridal.co.uk"; // Enter your email here!!

    $usersubject    = "contact form sub";
    $usersemail     = $_POST["usersemail"];
    $usersname      = $_POST["usersname"];
    $usersphone     = $_POST["usersphone"];
    $userscomment   = $_POST["userscomment"];
    $date           = $_POST["wedding_date"];
    
    if(strlen($usersweb) > 0){
        $usersweb = "Their website is: " . $usersweb;
    }
    
    $message =
    
    " {$usersname} has signed up Contact page of GoldenSashBridal site.\n

    User Email : {$usersemail}
    User Phone : {$usersphone}
    Wedding Date : {$date}

    Message:
    
    {$userscomment}
    
    
    {$usersweb}"; 
    
    $headers = 'From: admin@goldensashbridal.co.uk';
    mail($youremail, $usersubject, $message, $headers);
    
    die("success");
    
} else {
    
    echo "failed";
    
}

