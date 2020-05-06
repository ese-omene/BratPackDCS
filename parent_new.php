<?php
require_once 'Classes/Database.php';
require_once 'Classes/Parents.php';

//check if form is submitted
if(isset($_POST['addStudent'])){
    //get values from form and assign to local variable
    $id = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $form_errs = "";

    $dbcon = Database::getDb();
    $snew = new Parents();
    $count = $snew->addParent($dbcon, $fname, $lname, $address, $email, $phone);

    if ($count){
        header('Location:student_new.php');
    }else {
        echo "problem inserting data";
    }

//    $form_errs = $wl->validateForm($fname, $lname, $dob, $form_errs);
//    if (empty($form_errs)){
//        $form_errs .= "Thank you for registering a new student!";
//    }

}

include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

?>

<h1 class="h1 text-center">Add a New Parent</h1>
<div class="container-fluid fullpg">
    <a href="student_list.php" class="btn btn-light">Back to Student List</a>
    <!--    Form to Add to Waitlist -->
    <div class="bg-light">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input class="form-control" type="text" name="fname" id="fname"
                           placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input class="form-control" type="text" name="lname" id="lname"
                           placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input class="form-control" type="text" id="address" name="address" placeholder="123 Main Street">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="example@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input class="form-control" type="text" id="phone" name="phone" placeholder="123-456-7890">
                </div>
                <button class="btn btn-success" type="submit" name="addStudent"
                        id="btn-submit">
                    Add Parent
                </button>
            </form>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>

