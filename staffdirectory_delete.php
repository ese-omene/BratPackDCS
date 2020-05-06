<?php

require_once "Classes/Database.php";
require_once "Classes/StaffDirectory.php";

if(isset($_GET['staffID'])){
    // Delete staff:
    $staffID = $_GET['staffID'];
    $dbcon = Database::getDb();

    $sd = new StaffDirectory();
    $count = $sd->deleteStaff($dbcon, $staffID);

}

