<?php
    session_start();
    $name = '';
    $location = '';
    $update = false;
    $id = 0;
    $link = mysqli_connect("localhost", "root", "", "crud")
        or mysqli_connect_error();
    if(isset($_POST['save'])){
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $location =  mysqli_real_escape_string($link, $_POST['location']);
        $query = "INSERT INTO data (name, location) VALUES('$name', '$location')";
        if(!$result = mysqli_query($link, $query))
            echo mysqli_error($link);
        else {
            $_SESSION['message'] = "Record has been saved!";
            $_SESSION['msg_type'] = "success";
        }
        mysqli_close($link);
        header("location: index.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $query = "DELETE FROM data WHERE id='$id'";
        if(!$result = mysqli_query($link, $query))
            echo mysqli_error($link);
        else {
            $_SESSION['message'] = "Record has been deleted!";
            $_SESSION['msg_type'] = "danger";
        }
        mysqli_close($link);
        header("location: index.php");       
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $query = "SELECT * FROM data WHERE id=$id";
        if(!$result = mysqli_query($link, $query))
            echo mysqli_error($link);
        else {
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
                $location = $row['location'];
            }
        }
        mysqli_close($link);
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $location =  mysqli_real_escape_string($link, $_POST['location']);
        $query = "UPDATE data SET name='$name', location='$location' WHERE id='$id'";
        if(!$result = mysqli_query($link, $query))
            echo mysqli_error($link);
        else {
            $_SESSION['message'] = "Record has been updated!";
            $_SESSION['msg_type'] = "warning";
        }
        mysqli_close($link);
        header("location: index.php");
    }