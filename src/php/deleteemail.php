<?php
    include('connection.php');
    $reciepentemails = $_POST["reciepentemails"];
    $useremail = $_POST["useremail"];
    $emailsarr = explode(",", $reciepentemails);
    $emailcount = count($emailsarr);
    $i=0;
    while ($i<$emailcount) {
        $email = $emailsarr[$i];
        $sql = "DELETE FROM `EmailsTable` WHERE EmailAdd='$email' AND `UserEmail`='$useremail'";
        $result = mysqli_query($conn, $sql);
        if($result == true){
            echo $email." Successfully deleted...";
        }
        else{
            echo $email." Error in deleting...";
        }
        $i++;
    }
?>