<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/Contact.php";

//only admin users have access to this page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

$first_name = $last_name = $email = $phone_number = $message = $status = "";
$firstnameerr = $lastnameerr = $emailerr = $phonenumerr = $messageerr = "";
$error = FALSE;
//we get all the values of the specific form to show them
if(isset($_POST['updateContact'])){
    $id= $_POST['id'];
    $dbcon = Database::getDb();

    $c = new Contact();
    $contact_f = $c->getContactbyId($id, $dbcon);

    $first_name =  $contact_f->first_name;
    $last_name =  $contact_f->last_name;
    $email = $contact_f->email;
    $phone_number = $contact_f->phone_number;
    $message = $contact_f->message;
    $status = $contact_f->status;
}
//once the user has made changes we submit them to the database
if(isset($_POST['upContact'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];
    $status = $_POST['status'];
    $id = $_POST['sid'];

    //check if user entered valid data
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
        $messageerr="<div class=\"alert alert-danger\" role=\"alert\">Please enter your message.</div>";
        $error = TRUE;
    }

    if ($error == FALSE) {
        //if all the information is correct we submit it to the database
        $dbcon = Database::getDb();
        $c = new Contact();
        $upContact = $c->updateContact($id, $first_name, $last_name, $email, $phone_number, $message, $status, $dbcon);

        if ($upContact) {
            header("Location: contact_list.php");
        } else {
            echo "There was a problem updating the data.";
        }
    }
}

?>


<div class="container">
    <h1>Update Contact Form</h1>
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id ?>" />
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">First Name :</label>
            <div class="col-sm-10">
            <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $first_name; ?>">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $firstnameerr ?></span>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name :</label>
            <div class="col-sm-10">
            <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $last_name; ?>">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $lastnameerr ?></span>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
            <input type="text" id="email" name="email" class="form-control" value="<?= $email; ?>">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $emailerr ?></span>
        </div>
        <div class="form-group row">
            <label for="phone_number" class="col-sm-2 col-form-label">Phone Number :</label>
            <div class="col-sm-10">
            <input type="text" name="phone_number" id="program" class="form-control" value="<?= $phone_number; ?>">
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $phonenumerr ?></span>
        </div>
        <div class="form-group row">
            <label for="message" class="col-sm-2 col-form-label">Message :</label>
            <div class="col-sm-10">
                <textarea rows="15" name="message" id="message" class="form-control" ><?= $message; ?></textarea>
            </div>
            <span style="color:red; margin:auto; padding-top:1em;"><?= $messageerr ?></span>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status :</label>
            <div class="col-sm-6">
            <select id="status" name="status" class="form-control">
                <option value="submitted" <?php if ($status == "submitted")
                    echo "selected";
                ?> >Submitted</option>
                <option value="in-process" <?php if($status == "in-process")
                    echo "selected";
                ?> >In- Process</option>
                <option value="contacted" <?php if($status == "contacted")
                    echo "selected";
                ?> >Contacted</option>
            </select>
            </div>
        </div>
        <div class="navbar">
            <button type="submit" name="upContact" class="btn btn-sub">Update Contact Form</button>
            <a href="contact_list.php" class="btn btn-back">Cancel</a>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>
