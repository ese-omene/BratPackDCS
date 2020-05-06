<?php
include "includes/header.php";
include "functions/functions_susan.php";

require_once 'Classes/Database.php';
require_once 'Classes/StaffDirectory.php';

$firstnameerror = $lastnameerror = $emailerror = $phoneerror = $jobtitleerror = $photoerror = $photoerror__detail = "";

$addstaff__firstname = $addstaff__lastname = $addstaff__email = $addstaff__phone = $addstaff__jobtitle = $addstaff__photo = "";


$error = FALSE;

if(isset($_POST['submit__addstaff'])) {

    $addstaff__firstname = $_POST['staff__firstname'];
    $addstaff__lastname = $_POST['staff__lastname'];
    $addstaff__email = $_POST['staff__email'];
    $addstaff__phone = $_POST['staff__phone'];
    $addstaff__jobtitle = $_POST['staff__jobtitle'];
    $addstaff__photo = $_FILES['staff__photo'];

    // Error handling:

    if ($addstaff__firstname == "") {
        $firstnameerror = "Please enter staff's first name.";
        $error = TRUE;
    }

    if ($addstaff__lastname == "") {
        $lastnameerror = "Please enter staff's last name.";
        $error = TRUE;
    }

    $addstaff__email = $_POST['staff__email'];
    if ($addstaff__email == "") {
        $emailerror = "Please enter staff's email.";
        $error = TRUE;
    } else if (!filter_var($addstaff__email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = "Please enter a valid email address.";
        $error = TRUE;
    }

    function validate_phone($addstaff__phone)
    {
        $phoneRegex = "/^(?:\d{8}(?:\d{2}(?:\d{2})?)?|\(\+?\d{2,3}\)\s?(?:\d{4}[\s*.-]?\d{4}|\d{3}[\s*.-]?\d{3}|\d{2}([\s*.-]?)\d{2}\1\d{2}(?:\1\d{2})?))$/";
        return preg_match($phoneRegex, $addstaff__phone); // Same as below:
    }

    // SRC: https://stackoverflow.com/questions/4933100/php-function-returning-boolean

    if ($addstaff__phone == "") {
        $phoneerror = "Please enter staff's phone number.";
        $error = TRUE;
    } else if (!validate_phone($addstaff__phone)) {
        $phoneerror = "Please enter a valid phone number. No spaces, dashes, or brackets.";
        $error = TRUE;
    }

    if($addstaff__jobtitle == ''){
        $jobtitleerror = "Please select a job title.";
        $error = TRUE;
    }


    // Path of the file in temp directory:
    $file_temp = $_FILES['staff__photo']['tmp_name'];
    // Original path and file name of the uploaded file:
    $file_name = $_FILES['staff__photo']['name'];
    // Size of the uploaded file in bytes:
    $file_size = $_FILES['staff__photo']['size'];
    //print_r($file_size);
    // Type of the file (if browser provides):
    $file_type = $_FILES['staff__photo']['type'];
    // Error number
    $file_error = $_FILES['staff__photo']['error'];

    $max_file_size = 20000000;
    if ($file_size > $max_file_size) {
        echo "File size too big.";
    }

    // Folder to move the uploaded file
    $target_path = "images/staffdirectory/"; // Create folder
    $target_path = $target_path . $_FILES['staff__photo']['name'];

    // Move the uploaded file from temp path to target path. On a mac, or map you'll need to give recursive right permissions.
    if (move_uploaded_file($_FILES['staff__photo']['tmp_name'], $target_path)) {
        $success = "The file " . $_FILES['staff__photo']['name'] . " has been uploaded. ";
    } else {
        $photoerror ="There was an error uploading the file, please try again.";
    }


    if ($_FILES['staff__photo']['name'] != ""){
        $staff__photo =  $target_path;
    } else {
        // Set default image:
        $addstaff__photo = "images/staffdirectory/avatar.png";
    }


    if($file_error > 0) {
        $photoerror = "Problem uploading file.";
        switch ($file_error) {
            case 1:
                $photoerror__detail = "File exceeded upload_max_filesize.";
                $error = TRUE;
                break;
            case 2:
                $photoerror__detail = "File exceeded max_file_size.";
                $error = TRUE;
                break;
            case 3:
                $photoerror__detail = "File only partially uploaded.";
                $error = TRUE;
                break;
            case 4:
                $photoerror__detail = "No file uploaded.";
                break;
        }

    }


    // If there are no errors, add staff to directory:
    if ($error == FALSE) {
        $dbcon = Database::getDb();
        $sd = new StaffDirectory();
        $staffmembers = $sd->addstaff($dbcon, $addstaff__firstname, $addstaff__lastname, $addstaff__email, $addstaff__phone, $addstaff__jobtitle, $addstaff__photo);
    }
}

?>

<div class="container">
    <h1>Add New Staff Member</h1>

    <div class="navbar">
        <a href="staffdirectory_list.php" class="btn btn-secondary">Back to List</a>
    </div>

    <form method="POST" action="staffdirectory_add.php" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="staff__firstname" class="col-sm-2 col-form-label">First Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__firstname" name="staff__firstname" value="<?php echo $addstaff__firstname; ?>">
                <?php
                if($firstnameerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$firstnameerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__lastname" class="col-sm-2 col-form-label">Last Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__lastname" name="staff__lastname" value="<?php echo $addstaff__lastname; ?>">
                <?php
                if($lastnameerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$lastnameerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__email" name="staff__email" value="<?php echo $addstaff__email; ?>">
                <?php
                if($emailerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$emailerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__phone" class="col-sm-2 col-form-label">Phone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__phone" name="staff__phone" placeholder="1231234567" value="<?php echo $addstaff__phone; ?>">
                <?php
                if($phoneerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$phoneerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__jobtitle" class="col-sm-2 col-form-label">Job Title:</label>
            <div class="col-sm-6">
                <select id="staff_jobtitle" class="form-control col-sm-6" name="staff__jobtitle" >
                    <?= displayselectoptions($jobtitles, null, 'staff__jobtitle'); ?>
                </select>

                <?php
                if($jobtitleerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$jobtitleerror</div>";
                }
                ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__photo" class="col-sm-2 col-form-label">Photo:</label>
            <div class="input-group mb-3 col-sm-6" >
                <div class="custom-file">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                    <input type="file" class="custom-file-input" id="staff__photo" name="staff__photo">
                    <label class="custom-file-label" for="staff__photo">Choose file</label>
                </div>
            </div>
            <script>
                // Filename to appear on select:
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>
        </div>

        <div class="navbar">
            <input class="btn btn-primary" type="submit" name="submit__addstaff" value="Add New Staff Member">
        </div>

    </form>
</div>


<?php
include "includes/footer.php";
?>
