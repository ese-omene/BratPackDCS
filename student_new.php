<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';
require_once 'Classes/Parents.php';

$dbcon = Database::getDb();
$parent = new Parents();
$parents = $parent->viewParents($dbcon);


//check if form is submitted
if(isset($_POST['addStudent'])){
    //get values from form and assign to local variable
    $id = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $parent_id = $_POST['parents'];
    $form_errs = "";

    $dbcon = Database::getDb();
    $snew = new Student();
    $count = $snew->addStudent($dbcon, $fname, $lname, $dob, $parent_id);

    if ($count){
        header('Location: waitlist_show.php');
    }else {
        echo "problem inserting data";
    }

}

include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

?>

<h1 class="h1 text-center">Register a New Student</h1>
<div class="container-fluid fullpg">
    <a href="student_list.php" class="btn btn-light">Back to Student List</a>
    <a href="parent_new.php" class="btn btn-light">Add A New Parent</a>
    <!--    Form to Add to Waitlist -->
    <div class="bg-light">
    <div class="container-fluid">
        <form action="" method="post">
        <div class="form-group">
             <label for="parents">Select Parent:</label>
             <select class="form-control" id="parents" name="parents">
                 <?php foreach($parents as $p) { ?>
                    <option value="<?= $p->id; ?>"> <?= $p->first_name . ' ' . $p->last_name; ?> </option>
                 <?php } ?>
             </select>
        </div>
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
            <label for="dob">Date of Birth:</label>
            <input class="form-control" type="text" id="dob" name="dob" placeholder="YYYY-MM-DD">
        </div>
        <button class="btn btn-success" type="submit" name="addStudent"
                id="btn-submit">
            Add Student
        </button>
    </form>
    </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>

