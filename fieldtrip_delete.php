<?php


require_once "Classes/Database.php";
require_once "Classes/Fieldtrip.php";

if (isset($_GET['tripID'])) {
    // Delete fieltrip:
    $tripID = $_GET['tripID'];
    $dbcon = Database::getDb();

    $ft = new Fieldtrip();
    $count = $ft->deletefieldtrip($dbcon, $tripID);

}

