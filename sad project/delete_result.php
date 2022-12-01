<?php
   include("config.php");
   session_start();
?>
<?php
    $id =  $_GET['r_id'];
    $sql = "DELETE FROM results WHERE result_id ='".$id."'";
    if(mysqli_query($conn,$sql)){
        echo "Sucess";
    }
    else{
        echo "unsucess".mysqli_error($conn);
    }
    header("Location:retrieve_result.php");
    ?>