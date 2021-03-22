<?php 
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "myDB";

    $conn = mysqli_connect($servername, $username, $password);
    if ($conn->select_db($dbname) === false) {
    $sql = "create database if not exists myDB";
    $conn->query($sql);
    $conn->select_db($dbname);
    $sql = "create table if not exists project (
        id int auto_increment primary key,
        project_name varchar(45) not null   
    )";
    $conn->query($sql);
    $sql = "create table if not exists employee (
        id int auto_increment primary key,
        employee_name varchar(45) not null   
    )";
    $conn->query($sql);
    $sql = "create table if not exists project_employee (
        project_id int,
        employee_id int,
        primary key (project_id, employee_id),
        foreign key (project_id) references project(id),
        foreign key (employee_id) references employee(id)
        )";
    $conn->query($sql);

    $sql = "insert into project (project_name) values ('Java'), ('C#')";
    $conn->query($sql);

    $sql = "insert into employee (employee_name) values ('Jonas'), ('Mindaugas')";
    $conn->query($sql);

    $sql = "insert into project_employee (project_id, employee_id) values (1, 1), (1, 2)";
    $conn->query($sql);
    }
?>