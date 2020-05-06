<?php
include "includes/header.php";
require_once 'Classes/Database.php';
require_once 'Classes/PickupScheduler.php';

// "parent" user is able to access this page
if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}

//we set values
$dateerr = $childfirstnameerr = $childlastnameerr = $pickupfirstnameerr = $pickuplastnameerr = $pickupphonenumerr = $pickupemailerr = "";
$date = $child_first_name = $child_last_name = $pickup_first_name = $pickup_last_name = $pickup_phone_number = $pickup_email = "";
//we give a class value to the form so we can hide it after it's submitted
$hideform = "showForm";
//error variable to handle validation
$error = FALSE;
//to hold our thank you message which will show after the form is submitted
$thankyoumess = "";

if (isset($_POST['newPickupSchedule'])){

    $date = $_POST['date'];
    $child_first_name = $_POST['child_first_name'];
    $child_last_name = $_POST['child_last_name'];
    $pickup_first_name = $_POST['pickup_first_name'];
    $pickup_last_name = $_POST['pickup_last_name'];
    $pickup_phone_number = $_POST['pickup_phone_number'];
    $pickup_email = $_POST['pickup_email'];

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
// if data is valid then inster into database
    if ($error == FALSE) {
        $dbcon = Database::getDb();
        $insertPickupSched = new PickupScheduler();
        $in = $insertPickupSched->newPickupSchedule($date, $child_first_name, $child_last_name, $pickup_first_name, $pickup_last_name, $pickup_phone_number, $pickup_email, $dbcon);
        //once form is submitted we hide the form
        $hideform = "hideForm";
        //and show the thank you message confirming
        $thankyoumess = "\"<div class=\"container\"><h2>Thank you for submitting your form! <div>An email was sent to $pickup_first_name  $pickup_last_name confirming the information.</div></h2><div class=\"navbar\"><a href=\"index.php\" class=\"btn btn-back\">Back to Home Page</a></div></div> \"";
            include 'phpmailer/sendemailpickup.php';
    } else {
       echo "Problem inserting data error.";
    }

}
?>

    <div class="container <?= $hideform ?>">
        <h1>New Child Pickup Schedule</h1>
        <form action="" method="post">
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Date:</label>
                <div class="col-sm-10">
                    <input type="date" name="date" id="date"  class="form-control" value="<?= $date ?>">
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
                <button type="submit" name="newPickupSchedule" class="btn btn-sub"> Submit Pickup Schedule Form </button>
                <a href="public_pickupschedule_view.php" class="btn btn-back">Back</a>
            </div>
        </form>
    </div>
    <div>
        <?=  $thankyoumess ?>
    </div>
<?php
include "includes/footer.php";
?>