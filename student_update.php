<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';

    if(isset($_POST['updateS'])) {
        $id = $_POST['id'];
        $dbcon = Database::getDb();
        $student = new Student();
        $s = $student->getSById($dbcon, $id);

        $fname = $s->first_name;
        $lname = $s->last_name;
        $dob = $s->dob;
        $status = "student";
    }

    if(isset($_POST['updateStudent'])) {
        $id = $_POST['sid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $status = "student";
        $form_errs = "";

        $dbcon = Database::getDb();
        $supdate = new Student();
        $sup = $supdate->updateStudent($dbcon, $id, $fname, $lname, $dob, $status);

        if ($supdate) {
            header('Location: student_list.php');
        } else {
            echo "problem";
        }

        $form_errs = $wl->validateForm($fname, $lname, $dob, $status, $form_errs);
        if (empty($form_errs)){
            $form_errs .= "Student added!";
        }
    }

include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
?>
<h1 class="h1 text-center">Update Information</h1>
<div class="container-fluid fullpg">
    <a href="waitlist_show.php" class="btn btn-light">Back to Student List</a>
    <!-- Update Waitlist -->
    <div class="bg-light">
        <div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="p_name">First Name:</label>
            <input class="form-control" type="text" name="fname" id="fname" value="<?= $fname; ?>"
                   placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="c_name">Last Name:</label>
            <input class="form-control" type="text" name="lname" id="lname" value="<?= $lname; ?>"
                   placeholder="Enter child's name">
        </div>
        <div class="form-group">
            <label for="p_email">Date of Birth:</label>
            <input class="form-control" type="text" id="dob" name="dob"
                   value="<?= $dob ?>" placeholder="YYYY-MM-DD">
        </div>
        <button type="submit" name="updateStudent"
                 id="btn-submit" class="btn-success">
            Update Student Record
        </button>
    </form>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>