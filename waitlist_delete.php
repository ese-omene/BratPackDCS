<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon = Database::getDb();

    $wl = new Student();
    $count = $wl->deleteStudent($id, $dbcon);
    if($count){
        header("Location: index.php");
    }
    else {
        echo " problem deleting";
    }


}
