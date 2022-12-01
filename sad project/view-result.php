<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result view Form </title>
    <link href = './bootstrap/css/style.css' rel = 'stylesheet'>
</head>
<body>
<div class="login-page1">
        <div class="form">
    <form action="<?php echo  $_SERVER['PHP_SELF'];?>" method="post">
    <label for="name">Student Name:</label>
    <input type="text" name="name" id="name"><br>
    <span></span>
    <label for="dob">DOB:</label>
    <input type="text" name="date" id="date"><br>
    <span></span>
    <label for="terminal">Terminal:</label>
    <input type="radio" name="is_terminal" class ='rad' id="yes" value="0">No
    <input type="radio" name="is_terminal" id="no" class ='rad'value="1">Yes
    <br>
    <!-- <input type="submit" value="Submit" name="submit"> -->
    <button name = 'submit'> submit</submit>
    

</form>
</div>
    </div>
    <!-- <div class="login-page"> -->
        <div class="form">
<table border='1px'>
    <tr>
        <th>SN</th>
        <th>Student Name</th>
        <th>Subject Name</th>
        <th>Credit hrs</th>
        <th>Result Grade</th>
    </tr>
    <?php
    if(isset($_POST['submit'])){
        $name = $_POST["name"];
        $date = $_POST["date"];
        $terminal = $_POST["is_terminal"];
        $sql = "SELECT s.student_name,r.result_grade, su.subject_name, su.credit_hr 
        FROM students s 
        INNER JOIN results r 
        ON r.student_id = s.student_id 
        INNER JOIN subjects su 
        ON su.subject_id = r.subject_id
        WHERE s.student_name='".$name."' AND s.student_dob='".$date."' AND r.display_result=1 AND r.is_terminal=".$terminal;
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        if((mysqli_num_rows($result))==0){
            echo "No records found";
        }
        else{
            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row['student_name'].'</td>';
                echo '<td>'.$row['subject_name'].'</td>';
                echo '<td>'.$row['credit_hr'].'</td>';
                echo '<td>'.$row['result_grade'].'</td>';          
                echo "</tr>";
            }
        }
    }
?>
</table>
</div>
    <!-- </div> -->
</body>
</html>


