<?php
require_once 'Classes/Database.php';
require_once 'Classes/Activities.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon = Database::getDb();

    $a = new Activities();
    $count = $a->deleteActivities($dbcon,$id);


    if($count){
        header("Location: activities_list.php");
    }
    else {
        echo "problem deleting";
    }


}