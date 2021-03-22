<?php
    $id = $_GET["id"];
    $sql = "select * from project where id = '".$id."'";
    $exec = $conn->query($sql);
    $sql = "select * from project where project_id = '".$id."'";
    $projectemployees = $conn->query($sql);
    $sql = "select * from employee";
    $allemployees = $conn->query($sql);
?>
<form action="" method="POST">
    <input type="text" name="name1" value="<?php echo (mysqli_fetch_assoc($exec)["project_name"]) ?>">
<?php
    echo('<select name="myArr[]" multiple="multiple">');
    echo('<option type="checkbox">Remove all employees</option>');
    while($row = mysqli_fetch_assoc($allemployees)) {
        $sql = "select * from project_employee where project_id ='".$id."' and employee_id = '".$row["id"]."'";
        $exec = $conn->query($sql);
        $exist = mysqli_num_rows($exec) > 0?"selected":"";
        // echo ('<input type="checkbox" name="' . $row["id"] . '" '.$exist.' value="' . $row["id"] . '">' . $row["employee_name"] . '</input>');
        echo ('<option type="checkbox" '.$exist.' value="' . $row["id"] . '">' . $row["employee_name"] . '</option>');
    }
    echo('</select>');
?>
    <input type="submit" value="Update">
</form>
