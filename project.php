<?php
    if(isset($_POST['name']) != "") {
        $sql = "select * from project where project_name = '".$_POST['name'] . "'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) === 0) {
            $sql = "insert into project (project_name) values ('".$_POST['name']."')";
            $conn->query($sql); 
        }
    }
    if ($_GET['action'] == 'delete') {
        $sql = "delete from project where id = '".$_GET['id'] . "'";
        $conn->query($sql);
        header("location:./?path=project");
        exit;
    }
    if ($_GET['action'] == 'update') {
        if(isset($_POST['name1'])) {
            $sql = "update project set project_name ='".$_POST['name1']."' where id =" .$_GET['id'];
            $conn->query($sql);
            $values = $_POST['myArr'];
            $flagToRemoveAllemployees = false;
            foreach ($values as $value) {
                if($value == "Remove all employees") {
                    $flagToRemoveAllemployees = true;
                    break;
                } 
                $sql = "select * from project_employee where project_id=" . $_GET['id'] . " and employee_id=" . $value;
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) === 0) {
                    $sql = "insert into project_employee (project_id, employee_id) values (".$_GET['id'] . ", " . $value.")";
                    $conn->query($sql);
                }
            }
            $sql = "select * from project_employee where project_id=" . $_GET['id'];
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)) {
                if(!in_array($row['employee_id'],$values) || $flagToRemoveAllemployees) {
                    $sql = "delete from project_employee where employee_id = ".$row['employee_id'] . " and project_id = " . $_GET['id'];
                    $conn->query($sql);
                }
            }
            header("location:./?path=project");
            exit; 
        }
    }
?>
<table>
    <thead>
        <th>Id</th>
        <th>Project name</th>
        <th>Employee name</th>
        <th>Actions</th>
    </thead>
<?php 
    $sql = "select id, project_name from project";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "select * from project_employee where project_id = ".$row["id"];
            $result2 = $conn->query($sql);
            $employees = "";
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $sql = "select employee_name from employee where id = ".$row2["employee_id"];
                $result3 = $conn->query($sql);
                $row3 = mysqli_fetch_assoc($result3);
                $employees .= $row3["employee_name"] . ", ";
            }
            $employees = substr_replace($employees, "",-2);
        ?>
        <tr>
            <td><?php echo $row["id"]?></td>
            <td><?php echo $row["project_name"]?></td>
            <td><?php echo $employees ?></td>
            <td><button><a href='./?path=project&action=delete&id=<?php echo($row["id"])?>'>Delete</a></button><button><a href="./?path=project&action=update&id=<?php echo($row["id"])?>">Update</a></button></td>
        </tr>
            <?php }
    }
?>
</table>
<form action="" method="POST">
    <input type="text" id="name" name="name" placeholder="add project">
    <input type="submit" value="add">
</form>
<?php 
    if ($_GET['action'] == 'update' && !isset($_POST['name1'])) {
        include("update_project.php");
    }
?>
