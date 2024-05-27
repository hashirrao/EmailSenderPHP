<?php

include("src/php/connection.php");
session_start();
if(isset($_POST['submitlogin'])){
    $_SESSION["username"] = $_POST['username'];
    $_SESSION["password"] = $_POST['password'];
    $encpassword = md5($_SESSION["password"], "h123f3");
    $sql="SELECT * FROM `UsersTable` WHERE `Email`='".$_SESSION["username"]."' AND `Password`='".$encpassword."'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $_SESSION["isuser"] = "alreadyin";
        echo "<div id=\"settingsbutton\" onclick=\"settingsbutton()\">
        <div class=\"linediv\"></div>
        <div class=\"linediv\"></div>
        <div class=\"linediv\"></div>
    </div>";
        while($row = $result->fetch_assoc()){
            $fname = $row["FirstName"];
            $lname = $row["LastName"];
            $uname = $row["Username"];
            $contact = $row["ContactNo"];
            $dob = $row["DateOfBirth"];
            $gender = $row["Gender"];
          }
    }
    else{
        echo '<script>
        alert("Invalid Login");
        window.location="src/php/login.php";
        </script>';
    }
} 
else if(isset($_SESSION["isuser"])){
    $encpassword = md5($_SESSION["password"], "h123f3");
    $sql="SELECT * FROM `UsersTable` WHERE `Email`='".$_SESSION["username"]."' AND `Password`='".$encpassword."'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $_SESSION["isuser"] = "alreadyin";
    }
    else{
        header("location: ./src/php/login.php");
    }
}
else if(!isset($_SESSION["isuser"])){
    header("location: ./src/php/login.php");
}
else if($_SESSION["isuser"] != "alreadyin"){
    header("location: ./src/php/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Sender</title>
    <link rel="stylesheet" href="./assets/css/index.css"/>
</head>
<body>
<div id="bodydiv">
<label id="emaillabel"><?php echo $_SESSION["username"] ?></label>
<a href="./src/php/login.php" >Logout</a>
<div id="maindiv">
        <div id="headdiv">
            <h2>Email Sender</h2>
        </div>
        <div id="senderdiv">
            <input id="senderemail" placeholder="Your Email" type="text" />
            <input id="senderpassword" placeholder="Your Password" type="password" />
        </div>
        
        <div id=middiv>
            <input id="subject" placeholder="Subject" /><br>
            <textarea id="maintext"></textarea>
        </div>

        <div id="attachmentdiv">            
            <form id="form" action="./src/php/Upload.php" target="_blank" method="POST" enctype="multipart/form-data">
            <input type="file" name="f" id="test">
            <input type="submit" name="upload" id="uploadinput" value="Attach" />
            </form>
            <input id="attachmentsinput" readonly/>
        </div>

        <div id="recieverdiv">
            <div id="recieversupdiv">
            <input id="reciepentemail" placeholder="Reciepents" type="text">
            <button onclick="addemail()">Add</button>
            <input type="checkbox" id="checkall" onclick="checkall()">Check All
            <input type="checkbox" id="uncheckall" onclick="uncheckall()">Uncheck All
            </div>
            <div id="recieversdowndiv">
            <input id="searchemail" placeholder="SEARCH" onkeyup="fetchemail()" type="text">
                <div id="tablesscrolldiv">
                    <table id="reciepentstable">

                    </table>
                </div>
        </div>
        </div>
        <div id="buttonsdiv">
            <button onclick="deleteemails()">Delete Checked</button>
            <button onclick="sendemails()">Send to Checked</button>
        </div>
    </div>
    <div id="blockdiv">
        <div id="processdiv">
        <label>Please wait while sending is complete...</label>
            <table id="messagelabel"></table>
            <label id="processlabel">.</label>
        </div>
    </div>
</div>
    <script src="./src/js/index.js"></script>
</body>
</html>