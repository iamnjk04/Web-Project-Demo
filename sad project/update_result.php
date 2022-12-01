<?php
session_start();
require('config.php');
$semester_id = $_GET['id'];
$id = $_GET['r_id'];
$sql1 = "SELECT student_id,result_percentage, is_terminal, display_result, subject_id FROM results WHERE result_id='".$id."'";
$result1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result1)==1){
    while($row = mysqli_fetch_array($result1)){
        $id = $row['subject_id'];
        $percentage = $row['result_percentage'];
        $display_result = $row['display_result'];
        $is_terminal = $row['is_terminal'];
        $_SESSION['student_id'] = $row['is_terminal'];
    }
    $_SESSION['result_id'] = $id;
    // echo $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update result</title>
    <link href = './bootstrap/css/style.css' rel = 'stylesheet'>

</head>
<body>
<div class="login-page">
        <div class="form">
    <form action="result_update.php" method="post">
    <label for="percentage">Percentage</label>
    <input type="number" name="percentage" id="percentage" value="<?php echo $percentage; ?>"><br>
    <label for="terminal">Is Terminal</label>
    <input type="radio" name="is_terminal" id="yes" value="yes" <?php if($is_terminal == "1") echo 'checked="checked"'?>> <label for="yes">Yes</label>
    <input type="radio" name="is_terminal" id="no" value="no" <?php if($is_terminal == "0") echo 'checked="checked"'?>> <label for="no">No</label> <br>
    <label for="displayresult">Dispaly Result</label>
    <input type="radio" name="display_result" id="yes" value="yes" <?php if($display_result == "1") echo 'checked="checked"'?>> <label for="yes">Yes</label>
    <input type="radio" name="display_result" id="no" value="no" <?php if($display_result == "0") echo 'checked="checked"'?>> <label for="no">No</label> <br>
    <label for="subject">Subject</label>
    <select name="subject" id="subject">
    <?php
      $sql2 = "SELECT subject_name, subject_id FROM subjects
      WHERE semester_id = $semester_id ;";
    $result2 = mysqli_query($conn,$sql2);
    if(!(mysqli_num_rows($result2)>0)){
        echo "No records Found!";
    }
    else{
        while($row2 = mysqli_fetch_array($result2)){
            if($id == $row2['subject_id']){
                            echo '<option value='.$row2['subject_id'].' selected>'.$row2['subject_name'].'</option>';
                        }
            else{
                echo '<option value='.$row2['subject_id'].'>'.$row2['subject_name'].'</option>';
            }
                    }
                    echo "<br>";
        }
        // header("Location:dashboard.php");

    ?>
    
    <input type="submit" value="submit" name="submit">
    <!-- <?php
        header("Location:dashboard.php");

    ?> -->
    </form>
    </div>
    </div>

    
</body>
</html>
