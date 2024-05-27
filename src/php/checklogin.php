<?php
include('connection.php');
$user = $_POST['user'];
$pass = $_POST['pass'];
$encpassword = md5($pass, "h123f3");
$sql="SELECT * FROM `UsersTable` WHERE `Email`='".$user."' AND `Password`='".$encpassword."'";
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0){
    
}
else{
    echo "Password Wrong";
}
?>