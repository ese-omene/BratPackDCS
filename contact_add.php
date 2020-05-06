<?php
include "includes/header.php";
require_once 'Classes/Database.php';
require_once 'Classes/Contact.php';

// first we make sure that the user is a parent so they have access to this page
if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}

$firstnameerr = $lastnameerr = $emailerr = $phonenumerr = $messageerr = "";
$first_name = $last_name = $email = $phone_number = $message = $status = "";

// to be able to hide the form we give it a class value which will change after it's submitted
$hideform = "showForm";
//to handle errors
$error = FALSE;
//once the form is submitted we show the thank you message with the confirmation
$thankyoumess = "";

if (isset($_POST['newContact'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    //check if user entered the valid data
    if($first_name == ""){
        $firstnameerr="<div class=\"alert alert-danger\">Please enter your first name.</div>";
        $error = TRUE;
    }
    if($last_name == ""){
        $lastnameerr="<div class=\"alert alert-danger\">Please enter your last name.</div>";
        $error = TRUE;
    }
    if($email == ""){
        $emailerr="<div class=\"alert alert-danger\">Please enter your email.</div>";
        $error = TRUE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerr="<div class=\"alert alert-danger\">Please enter your email.</div>";
        $error = TRUE;
    }
    $phonepattern = "/[0-9]{10}/";
    if($phone_number == ""){
        $phonenumerr="<div class=\"alert alert-danger\">Please enter your phone number.</div>";
        $error = TRUE;
    } else if (!preg_match($phonepattern, $phone_number)) {
        $phoneerr = "<div class=\"alert alert-danger\">Please enter your phone number.</div>";
        $error = TRUE;
    }
    if($message == ""){
        $messageerr="<div class=\"alert alert-danger\">Please enter your message.</div>";
        $error = TRUE;
    }

    //if user entered valid data then we insert into the database
    if ($error == FALSE) {
        $dbcon = Database::getDb();
        $insertCont = new Contact();
        $in = $insertCont->newContact($first_name, $last_name, $email, $phone_number, $message, $status, $dbcon);
        // after submitting the form the class will change to display:none; this way we will only get the thank you message
        $hideform = "hideForm";
        $thankyoumess = "\"<div class=\"container\"><h2>Thank you  $first_name  $last_name for submitting your form! <div>An email was sent to you confirming your information.</div></h2><div class=\"navbar\"><a href=\"index.php\" class=\"btn btn-back\">Back to Home Page</a></div></div> \"";
        //once the form is submitted an email will be automatically sent
        include 'phpmailer/sendemail.php';
    }  else {
        echo "Problem inserting data.";
    }

}
?>

    <div class="container <?= $hideform ?>">
        <h1>New Contact Form</h1>
        <form action="" method="post">
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label"> First Name :</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" id="first_name" class="form-control"  value="<?= $first_name ?>" placeholder="Enter First Name">
                </div>
                <span style="color:red; margin:auto; padding-top:1em;"><?= $firstnameerr ?></span>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label"> Last Name :</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" id="last_name" class="form-control"  value="<?= $last_name ?>" placeholder="Enter Last Name">
                </div>
                <span style="color:red; margin:auto; padding-top:1em;"><?= $lastnameerr ?></span>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                    <input type="text" name="email" id="email" class="form-control"  value="<?= $email ?>" placeholder="Enter Email">
                </div>
                <span style="color:red; margin:auto; padding-top:1em;"><?= $emailerr ?></span>
            </div>
            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Phone Number:</label>
                <div class="col-sm-10">
                    <input type="text" name="phone_number" class="form-control"  id="phone_number" value="<?= $phone_number ?>" placeholder="Enter Phone Number">
                </div>
                <span style="color:red; margin:auto; padding-top:1em;"><?= $phonenumerr ?></span>
            </div>
            <div class="form-group row">
                <label for="message" class="col-sm-2 col-form-label">Message:</label>
                <div class="col-sm-10">
                    <textarea rows="15" name="message" id="message" class="form-control"  placeholder="Enter Message"><?= $message ?></textarea>
                </div>
                <span style="color:red; margin:auto; padding-top:1em;"><?= $messageerr ?></span>
            </div>
            <div class="d-none">
                <label for="status">Status :</label>
                <select id="status" name="status">
                    <option value="submitted">Submitted</option>
                    <option value="in-process">In- Process</option>
                    <option value="contacted">Contacted</option>
                </select>
            </div>
            <div class="navbar">
                <button type="submit" name="newContact" class="btn btn-sub"> Submit Contact Form </button>
                <a href="public_contact_view.php" class="btn btn-back">Back</a>
            </div>
        </form>
    </div>
    <div>
        <?=  $thankyoumess ?>
    </div>
<?php
include "includes/footer.php";
?>