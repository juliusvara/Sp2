<?php
include_once("createDB.php");
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
</head>
<style>
    a {
        text-decoration: none;
    }
</style>

<body>
        <ul>
            <li>
                <a href="./?path=project">Projektai</a>
            </li>
            <li>
                <a href="./?path=employee">Darbuotojai</a>
            </li>
        </ul>
<?php 
    $path = $_GET['path']??"project";
    if ($path == "project") {
        include("project.php");
    } else if ($path == "employee") {
        include("employee.php");
    }
?>
</body>

</html>