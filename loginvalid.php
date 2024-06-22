<?php

session_start();

include "footer.php";
include "datab.php";
include "functions.php";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$username = $_POST['UserName'];
$password = $_POST['Password'];

$sql = "SELECT * FROM user WHERE UserName='$username' AND password='$password'";
$result = $connection->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    $usertypeid = $user['UserTypeID'];
    $usertype_sql = "SELECT * FROM usertype WHERE UserTypeID='$usertypeid'";
    $usertype_result = $connection->query($usertype_sql);
    $usertype_row = $usertype_result->fetch_assoc();

    $usertypepages_sql = "SELECT * FROM usertypepages WHERE UserTypeID='$usertypeid'";
    $usertypepages_result = $connection->query($usertypepages_sql);
    $allowed_pages = array();
    while ($row = $usertypepages_result->fetch_assoc()) {
        $pageID = $row['pageID'];
        $page_url_sql = "SELECT * FROM pages WHERE ID='$pageID'";
        $page_url_result = $connection->query($page_url_sql);
        $page_url_row = $page_url_result->fetch_assoc();
        if ($page_url_row) {
            $allowed_pages[] = $page_url_row['physicalname'];
        }
    }

    if (count($allowed_pages) > 0) {
        if ($usertype_row['UserTypeName'] == 'Donator') {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $username;
            $_SESSION["userid"] = $user['UserID'];
            header("Location: donatorcontroller.php");
            exit(); 
        } else {
            $_SESSION["userid"] = $user['UserID'];
            header("Location: " . $allowed_pages[0]);
            exit(); 
        }
    } else {
        header("Location: login.html");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}

$connection->close();

?>
