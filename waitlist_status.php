<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';
if(isset($_POST['updateStatus'])){
    $id = $_POST['id'];
    $dbcon = Database::getDb();
    $s = new Student();
    $status = $s->updateStatus($dbcon, $id);

    if($status){
        header("Location: waitlist_show.php");
    }
    else {
        echo "Problem updating waitlist status!";
    }

}
