<?php
include "includes/header.php";

require_once 'Classes/Database.php';
require_once 'Classes/Contact.php';

//making sure only users with type "admin" can access this page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
//we grab the information to show it in a confirmation screen
if(isset($_POST['deleteContact'])){
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
//once the admin confirms they want to delete that form the query is sent to the database
if(isset($_POST['delContact'])){
    $id = $_POST['sid'];
    $dbcon = Database::getDb();

    $c = new Contact();
    $count = $c->deleteContact($id, $dbcon);

    if($count){
        header("Location: contact_list.php");
    }
    else {
        echo " There was a problem deleting. ";
    }

}
?>
<div class="container">
    <h1>Are you sure you want to delete this form?</h1>
    <form action="" method="post">
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
                <input type="text" name="phone_number" id="program" class="form-control" value="<?= $phone_number; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="message" class="col-sm-2 col-form-label">Message :</label>
            <div class="col-sm-10">
                <input type="text" name="message" id="message" class="form-control" value="<?= $message; ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status :</label>
            <div class="col-sm-6">
                <select id="status" name="status" class="form-control" disabled>
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
            <button type="submit" name="delContact" class="button btn btn-del">Confirm Delete</button>
            <a href="contact_list.php" class="btn btn-back">Cancel</a>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>
