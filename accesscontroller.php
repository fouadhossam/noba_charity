<?php
include_once 'result.php';
include_once 'datab.php';
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $type = new result();
    $userTypeID = $type->getUserType($userid);

    switch ($userTypeID) {
        case 1:
            header('Location: donatorcontroller.php');
            break;
        case 2:
            header('Location: editcontroller.php');
            break;
        case 3:
            header('Location: admincontroller.php');
            break;
        default:
            echo 'none';
            echo $_SESSION['userid'];
            echo $userTypeID;
            break;
    }
} else {
    header('Location: login.html');
}
?>
