<?php

include_once "datab.php";
include_once "functions.php";
include_once "admin.php";
include_once "Editor.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
</head>
<body>
    
    <?php

    $admin = new Admin();
    $editor = new Editor();
    $id = $_POST['id'];
    $table = $_POST['table'];
    $primaryKey = $_POST["pk"];

    switch ($table) {
        case "usertype":
            include_once "adminheader.php";
            echo '<h1>Update User Type</h1>';
            $admin->updateUserType($id);
            break;
        
        case "donationtype":
            include_once "adminheader.php";
            echo '<h1>Update Donation Type</h1>';
            $editor->editDonationType($id);
            break;
        
        case "mediacontent":
            include_once "editorheader.php";
            echo '<h1>Update Media content</h1>';
            $editor->editMediaContent($id);
            break;
        
        default:
            include_once "adminheader.php";
            echo '<h1>Update '.$table.'</h1>';
            $crud->update($table, $primaryKey, $id);
            break;
    }

    ?>
</body>
</html>

<?php
include "footer.php";
?>
