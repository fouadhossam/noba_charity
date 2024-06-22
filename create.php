<?php
include_once "footer.php";
include_once "datab.php";
include_once "functions.php";
include_once "Classes.php";
include_once "admin.php";
include_once "Editor.php";
include_once "Donator.php";

$admin = new Admin();
$editor = new Editor();
$donator = new Donator();

$table = $_POST['table'];
$primaryKey = $_POST['pk'];

switch ($table) {
    case "usertype":
        include_once "adminheader.php";
        $admin->createUserType();
        break;
    case "donation":
        include_once "adminheader.php";
        $donator->makeDonation();
        break;
    case "mediacontent":
        include_once "editorheader.php";
        $editor->addMediaContent();
        break;
    default:
        include_once "adminheader.php";
        $crud = new CRUD();
        $crud->create($table, $primaryKey);
        break;
}
?>
