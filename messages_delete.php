<?php
require_once 'Classes/Database.php';
require_once 'Classes/Message.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $dbcon = Database::getDb();

    $m = new Message();
    $count = $m->deleteMessage($id, $dbcon);
    if($count){
        header("Location: messages_show.php");
    }
    else {
        echo "Problem deleting";
    }


}