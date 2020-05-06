<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon = Database::getDb();

    $s = new Student();
    $count = $s->deleteStudent($id, $dbcon);
    if($count){
        header("Location: student_list.php");
    }
    else {
        echo "Problem deleting";
    }


}
