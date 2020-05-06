<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/PickupScheduler.php";

// only users that are admins have access to the page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

$dateerr = $childfirstnameerr = $childlastnameerr = $pickupfirstnameerr = $pickuplastnameerr = $pickupphonenumerr = $pickupemailerr = "";
$date = $child_first_name = $child_last_name = $pickup_first_name = $pickup_last_name = $pickup_phone_number = $pickup_email = "";

$error = FALSE;
if(isset($_POST['updatePickupSchedule'])){
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
if(isset($_POST['upPickup'])) {
    $date = $_POST['date'];
    $child_first_name = $_POST['child_first_name'];
    $child_last_name = $_POST['child_last_name'];
    $pickup_first_name = $_POST['pickup_first_name'];
    $pickup_last_name = $_POST['pickup_last_name'];
    $pickup_phone_number = $_POST['pickup_phone_number'];
    $pickup_email = $_POST['pickup_email'];
    $id = $_POST['sid'];

    //check if user entered valid data
    if($date == ""){
        $dateerr="<div class=\"alert alert-danger\">Please enter a pickup date.</div>";
        $error = TRUE;
    }
    if($child_first_name == ""){
        $childfirstnameerr="<div class=\"alert alert-danger\">Please enter child's first name.</div>";
        $error = TRUE;
    }
    if($child_last_name == ""){
        $childlastnameerr="<div class=\"alert alert-danger\">Please enter child's last name.</div>";
        $error = TRUE;
    }
    if($pickup_first_name == ""){
        $pickupfirstnameerr="<div class=\"alert alert-danger\">Please enter pickup's first name.</div>";
        $error = TRUE;
    }
    if($pickup_last_name == ""){
        $pickuplastnameerr="<div class=\"alert alert-danger\">Please enter pickup's last name.</div>";
        $error = TRUE;
    }
    if($pickup_email == ""){
        $pickupemailerr="<div class=\"alert alert-danger\">Please enter pickup's email.</div>";
        $error = TRUE;
    } else if (!filter_var($pickup_email, FILTER_VALIDATE_EMAIL)) {
        $pickupemailerr="<div class=\"alert alert-danger\">Please enter pickup's email.</div>";
        $error = TRUE;
    }
    $phonepattern = "/[0-9]{10}/";
    if($pickup_phone_number == ""){
        $pickupphonenumerr="<div class=\"alert alert-danger\">Please enter your phone number.</div>";
        $error = TRUE;
    } else if (!preg_match($phonepattern, $pickup_phone_number)) {
        $pickupphoneerr ="<div class=\"alert alert-danger\">Please enter your phone number.</div>";
        $error = TRUE;
    }
//if there are no errors we submit to database
    if ($error == FALSE) {
        $dbcon = Database::getDb();
        $ps = new PickupScheduler();
        $upPickup = $ps->updatePickupSchedule($id, $date, $child_first_name, $child_last_name, $pickup_first_name, $pickup_last_name, $pickup_phone_number, $pickup_email, $dbcon);

        if ($upPickup) {
            header("Location: pickupschedule_list.php");
        } else {
            echo "There was a problem updating the data.";
        }
    }
}

?>


<div class="container">
    <h1>Update Child Pickup Schedule</h1>
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id ?>" />
        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date:</label>
            <div class="col-sm-10">
                <input type="date" name="date" id="date" class="form-control" value="<?= $date ?>">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $dateerr ?></span>
        </div>
        <div class="form-group row">
            <label for="child_first_name" class="col-sm-2 col-form-label"> Child First Name :</label>
            <div class="col-sm-10">
                <input type="text" name="child_first_name" id="child_first_name" class="form-control"  value="<?= $child_first_name ?>" placeholder="Enter Child First Name">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $childfirstnameerr ?></span>
        </div>
        <div class="form-group row">
            <label for="child_last_name" class="col-sm-2 col-form-label"> Child Last Name :</label>
            <div class="col-sm-10">
                <input type="text" name="child_last_name" id="child_last_name" class="form-control"  value="<?= $child_last_name ?>" placeholder="Enter Child Last Name">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $childlastnameerr ?></span>
        </div>
        <div class="form-group row">
            <label for="pickup_first_name" class="col-sm-2 col-form-label"> Pickup First Name:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_first_name" id="pickup_first_name" class="form-control"  value="<?= $pickup_first_name ?>" placeholder="Enter Pickup First Name">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $pickupfirstnameerr ?></span>
        </div>
        <div class="form-group row">
            <label for="pickup_last_name" class="col-sm-2 col-form-label"> Pickup Last Name:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_last_name" class="form-control"  id="pickup_last_name" value="<?= $pickup_last_name ?>" placeholder="Enter Pickup Last Name">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $pickuplastnameerr ?></span>
        </div>
        <div class="form-group row">
            <label for="pickup_phone_number" class="col-sm-2 col-form-label"> Pickup Phone Number:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_phone_number" id="pickup_phone_number" class="form-control"  value="<?= $pickup_phone_number ?>" placeholder="Enter Pickup Phone Number">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $pickupphonenumerr ?></span>
        </div>
        <div class="form-group row">
            <label for="pickup_email" class="col-sm-2 col-form-label"> Pickup Email:</label>
            <div class="col-sm-10">
                <input type="text" name="pickup_email" id="pickup_email" class="form-control"  value="<?= $pickup_email ?>" placeholder="Enter Pickup Email">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $pickupemailerr ?></span>
        </div>
        <div class="navbar">
            <button type="submit" name="upPickup" class="btn btn-sub"> Update Pickup Schedule Form </button>
            <div class="navbar"><a href="pickupschedule_list.php" class="btn btn-back">Cancel</a></div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>
