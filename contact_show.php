<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/Contact.php";

// only admin users have access to this page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

$first_name = $last_name = $email = $phone_number = $message = $status = "";
//we show the complete contact form information for the admin to view
if(isset($_POST['showContact'])){
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
?>


<div class="container">
    <h1>Contact Form </h1>
        <input type="hidden" name="sid" value="<?= $id ?>" />
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">First Name :</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $first_name; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name :</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $last_name; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="text" id="email" name="email" class="form-control" value="<?= $email; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="phone_number" class="col-sm-2 col-form-label">Phone Number :</label>
            <div class="col-sm-10">
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?= $phone_number; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="message" class="col-sm-2 col-form-label">Message :</label>
            <div class="col-sm-10">
                <textarea rows="15" name="message" id="message" class="form-control" disabled><?= $message; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status :</label>
            <div class="col-sm-10">
                <input type="text" name="status" id="status" class="form-control" value="<?= $status; ?>" disabled>
            </div>
        </div>
        <div class="navbar">
            <form action="contact_update.php" method="post">
                <input type="hidden" name="id" value="<?= $id?>"/>
                <input type="submit" class="button btn btn-up" name="updateContact" value="Update"/>
            </form>
            <div class="navbar"><a href="contact_list.php" class="btn btn-back">Back</a></div>
        </div>
</div>

<?php
include "includes/footer.php";
?>
