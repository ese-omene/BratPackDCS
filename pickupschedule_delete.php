<?php
include "includes/header.php";

require_once 'Classes/Database.php';
require_once 'Classes/PickupScheduler.php';

// "admin" user has access to this page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
// we pull the form information to show
if(isset($_POST['deletePickupSchedule'])){
    $id= $_POST['id'];
    $dbcon = Database::getDb();

    $ps = new PickupScheduler();
    $pickup_s = $ps->getPickupSchedulebyId($id, $dbcon);

    $date = $pickup_s->date;
    $child_first_name =  $pickup_s->child_first_name;
    $child_last_name =  $pickup_s->child_last_name;
    $pickup_first_name =  $pickup_s->pickup_first_name;
    $pickup_last_name =  $pickup_s->pickup_last_name;
    $pickup_phone_number = $pickup_s->pickup_phone_number;
    $pickup_email = $pickup_s->pickup_email;

}
//once user confirms they want to delete we send the query to the database and go  back to the list
if(isset($_POST['delPickup'])){
    $id = $_POST['sid'];
    $dbcon = Database::getDb();

    $ps = new PickupScheduler();
    $count = $ps->deletePickupSchedule($id, $dbcon);

    if($count){
        header("Location: pickupschedule_list.php");
    }
    else {
        echo " There was a problem deleting. ";
    }

}
?>
<div class="container">
    <h1>Are you sure you want to delete this entry?</h1>
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id ?>" />
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date:</label>
            <div class="col-sm-10">
                <input type="date" name="date" id="date" class="form-control" value="<?= $date ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="child_first_name" class="col-sm-2 col-form-label"> Child First Name :</label>
            <div class="col-sm-10">
                <input type="text" name="child_first_name" id="child_first_name" class="form-control"  value="<?= $child_first_name ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="child_last_name" class="col-sm-2 col-form-label"> Child Last Name :</label>
            <div class="col-sm-10">
                <input type="text" name="child_last_name" id="child_last_name" class="form-control"  value="<?= $child_last_name ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="pickup_first_name" class="col-sm-2 col-form-label"> Pickup First Name:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_first_name" id="pickup_first_name" class="form-control"  value="<?= $pickup_first_name ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="pickup_last_name" class="col-sm-2 col-form-label"> Pickup Last Name:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_last_name" class="form-control"  id="pickup_last_name" value="<?= $pickup_last_name ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="pickup_phone_number" class="col-sm-2 col-form-label"> Pickup Phone Number:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_phone_number" id="pickup_phone_number" class="form-control"  value="<?= $pickup_phone_number ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="pickup_email" class="col-sm-2 col-form-label"> Pickup Email:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_email" id="pickup_email" class="form-control"  value="<?= $pickup_email ?>" disabled>
            </div>
        </div>
        <div class="navbar">
            <button type="submit" name="delPickup" class="button btn btn-del"> Confirm Delete</button>
            <div class="navbar"><a href="pickupschedule_list.php" class="btn btn-back">Cancel</a></div>
        </div>
    </form>
</div>
<?php
include "includes/footer.php";
?>

