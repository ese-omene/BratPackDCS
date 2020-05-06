<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];

    require_once ('classes/database.php');

    $sql = "DELETE FROM menus WHERE id = :id";

    $dbcon = Database::getDb();
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $count = $pst->execute();


    if($count){
        header("Location: menu_list.php");
    }
    else {
        echo "problem deleting";
    }


}