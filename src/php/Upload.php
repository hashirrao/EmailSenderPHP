<?php
  if(isset($_POST['upload'])){
    $fname = $_FILES["f"]["name"];
    $dst = "../../Uploads/".$fname;
    if(move_uploaded_file($_FILES['f']['tmp_name'], $dst)){
      echo "<script>window.close();</script>";
    }
    else{
      echo "Error in uploading...";
    }
  }
?>
