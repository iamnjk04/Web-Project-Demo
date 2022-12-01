<?php
   include("config.php");
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link href = './bootstrap/css/style.css' rel = 'stylesheet'>

</head>
<body>
<?php
$errSubject=$errPercentage=$errTerminal=$errDisplay='';
$subject=$percentage=$terminal=$display='';
if(isset($_POST['submit']))
{
    $subject=$_POST['subject'];
    $percentage=$_POST['percentage'];
    $terminal=$_POST['is_terminal'];
    $display=$_POST['display_result'];
 

 if(empty($subject)){
    $errDisplay= "Subject is Blank <br>";
}
if(empty($percentage)){
    $errPercentage= "Percentage is Blank <br>";
}

if(empty($terminal)){
    $errTerminal= "Terminal is Blank <br>";
}
if(empty($display)){
    $errDisplay= "Display is Blank <br>";
}
}
?>
<div class="login-page">
        <div class="form">

<form action="create_result.php" method="post">
<label for="subject">Subject</label>
<select name="subject" id="subject" value="<?php echo $subject?>">
<?php
$semester_id = $_GET['id'];
    $student_id = $_GET['s_id'];
    if(isset($_SESSION['teacher_id'])){
        $id = $_SESSION['teacher_id'];
        $_SESSION['s_id']=$student_id;
     $sql = "SELECT subject_name, subject_id FROM subjects
    WHERE semester_id = $semester_id ;";
    $result = mysqli_query($conn,$sql);
    if(!(mysqli_num_rows($result)>0)){
        echo "No records Found!";
    }
    else{
        while($row = mysqli_fetch_array($result)){
                            echo '<option value='.$row['subject_id'].'>'.$row['subject_name'].'</option>';
                        }
        }
    }


    ?>


</select> <br>
<span class="error"><?php echo $errSubject;?></span> <br>

<label for="percentage">Percentage</label>
<input type="number" name="percentage" id="percentage" value="<?php echo $percentage?>"> <br>
<span class="error"><?php echo $errPercentage;?></span> <br>

<label for="terminal">Is Terminal</label>
<input type="radio" name="is_terminal" id="yes" value="yes"> <label for="yes">Yes</label>
<input type="radio" name="is_terminal" id="no" value="no"> <label for="no">No</label> <br>
<span class="error"><?php echo $errTerminal;?></span> <br>

<label for="displayresult">Dispaly Result</label>
<input type="radio" name="display_result" id="yes" value="yes"> <label for="yes">Yes</label>
<input type="radio" name="display_result" id="no" value="no"> <label for="no">No</label> <br>
<span class="error"><?php echo $errDisplay;?></span> <br>

<!-- <input type="submit" value="submit" name="submit"> -->
<button name = 'submit'> submit</submit>

</form>
</div>
</div>
</body>
</html>
