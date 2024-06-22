<?php
include_once 'datab.php';
include_once 'functions.php';
include_once "admin.php";
include_once "Editor.php";

$admin = new Admin();
$editor = new Editor();

$id = $_POST['id'];
$table = $_POST['table'];
$primaryKey = $_POST['pk'];

switch ($table) {
    case "donationtype":
        $admin->deleteDonationType($id);
        break;
    case "usertype":
        $admin->deleteUserType($id);
        break;
    case "mediacontent":
        $editor->deleteMediaContent($id);
        break;
    default:
        $crud = new CRUD();
        $crud->delete($table, $primaryKey, $id);
        break;
}
?>
