<?php
session_start();
require('config.php');
$sql =  "SELECT r.result_id, s.student_name, r.result_percentage, r.result_grade, su.subject_name, su.credit_hr, su.semester_id
        FROM students s 
        INNER JOIN results r 
        ON r.student_id = s.student_id 
        INNER JOIN subjects su 
        ON su.subject_id = r.subject_id";
        $result = mysqli_query($conn,$sql);
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href = './bootstrap/css/style.css' rel = 'stylesheet'>

</head>
<body>
    <a href="logout.php">Logout</a>
    <!-- <div class="login-page"> -->
    <div class="form">
    <table border='1px'>
        <tr>
            <th>Sn</th>
            <th>Name</th>
            <th>Percentage</th>
            <th>Grade</th>
            <th>Subject Name</th>
            <th>Credit hr</th>
            <th>Action I</th>
            <th>Action II</th>
        </tr>
        <tr>
            <!-- <a href="update_result.php?id=...">Edit</a> -->
            
        <?php
        if((mysqli_num_rows($result))==0){
            echo "No records found";
        }
        else{
            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td>".$row['student_name']."</td>";
                echo "<td>".$row['result_percentage']."</td>";
                echo "<td>".$row['result_grade']."</td>";
                echo "<td>".$row['subject_name']."</td>";
                echo "<td>".$row['credit_hr']."</td>";
                echo '<td><a href="update_result.php?id='.$row['semester_id'].'&&r_id='.$row['result_id'].'">Edit</a></td>';
                echo '<td><a href="delete_result.php?id='.$row['semester_id'].'&&r_id='.$row['result_id'].'">Delete</a></td>';
                echo "</tr>";
            }
            echo "</table>";
        }
?>
        </tr>
    </table>
    </div>
    <!-- </div> -->
</body>
</html>
        

