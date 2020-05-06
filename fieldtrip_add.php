<?php
include "includes/header.php";

include "functions/functions_susan.php";

require_once "Classes/Database.php";
require_once "Classes/Fieldtrip.php";
require_once 'Classes/StaffDirectory.php';

$error = FALSE;

$fieldtrip__location = $fieldtrip__description = $fieldtrip__date = $fieldtrip__start = $fieldtrip__end = $fieldtrip__organizer = "";

$staff__searchkey = "";
$public__jobtitle = "";

$dbcon = Database::getDb();

$sd = new StaffDirectory();
$staffmembers = $sd->liststaff($dbcon, $staff__searchkey, $public__jobtitle);

if(isset($_POST['submit__addtrip'])) {
    $fieldtrip__location = $_POST['fieldtrip__location'];
    $fieldtrip__description = $_POST['fieldtrip__description'];
    $fieldtrip__date = $_POST['fieldtrip__date'];
    $fieldtrip__start = $_POST['fieldtrip__start'];
    $fieldtrip__end = $_POST['fieldtrip__end'];
    $fieldtrip__organizer = $_POST['fieldtrip__organizer'];

    // Validation:
    if ($fieldtrip__location == "") {
        $locationerror = "Please enter trip location.";
        $error = TRUE;
    }

    if ($fieldtrip__description == "") {
        $descriptionerror = "Please enter trip description.";
        $error = TRUE;
    }

    if ($fieldtrip__date == "") {
        $dateerror = "Please select a date.";
        $error = TRUE;
    }

    if ($fieldtrip__start == "") {
        $starterror = "Please enter start time.";
        $error = TRUE;
    }

    if ($fieldtrip__end == "") {
        $enderror = "Please enter end time.";
        $error = TRUE;
    }

    if ($fieldtrip__organizer == "") {
        $organizererror = "Please enter trip organizer.";
        $error = TRUE;
    }

    // Submit form if there are no errors:
    if ($error == FALSE) {
        $ft = new Fieldtrip();
        $fieldtrips = $ft->addfieldtrip($dbcon, $fieldtrip__location, $fieldtrip__description, $fieldtrip__date, $fieldtrip__start, $fieldtrip__end, $fieldtrip__organizer);
    }

}

?>

<div class="container">
    <h1>Field Trips</h1>

    <div class="navbar">
        <a href="fieldtrip_list.php" class="btn btn-secondary">Back to List</a>
    </div>

    <form method="POST">
        <div class="form-group row">
            <label for="fieldtrip__location" class="col-sm-2 col-form-label">Location:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fieldtrip__location" name="fieldtrip__location" value="<?= holdvalue($fieldtrip__location); ?>">
                <?php
                if(isset($locationerror)){
                    echo "<div class='alert alert-danger' role='alert'>$locationerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="fieldtrip__description" rows="4" name="fieldtrip__description"><?=holdvalue($fieldtrip__description); ?></textarea>
                <?php
                if(isset($descriptionerror)){
                    echo "<div class='alert alert-danger' role='alert'>$descriptionerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__date" class="col-sm-2 col-form-label">Date:</label>
            <script>

                $( function() {
                    $("#fieldtrip__date").datepicker({
                        onSelect: function (fieldtrip__date){
                            //var fieldtrip__date = $("#fieldtrip__date").val();
                            console.log(fieldtrip__date);
                            $('input[name="fieldtrip__date"]').attr('value', fieldtrip__date);
                        },
                        dateFormat: "yy-mm-dd"
                    });

                });


            </script>
            <div class="col-sm-10">
                <div id="fieldtrip__date"></div>
                <input type="hidden" name="fieldtrip__date" value="">
                <?php
                if(isset($dateerror)){
                    echo "<div class='alert alert-danger' role='alert'>$dateerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__start" class="col-sm-2 col-form-label">Start Time:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__start" class="form-control col-sm-6" name="fieldtrip__start">
                    <?= displayselectoptions($starttimearray, null, 'fieldtrip__start'); ?>
                </select>
                <?php
                if(isset($starterror)){
                    echo "<div class='alert alert-danger' role='alert'>$starterror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__end" class="col-sm-2 col-form-label">End Time:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__end" class="form-control col-sm-6" name="fieldtrip__end">
                    <?= displayselectoptions($endtimearray, null, 'fieldtrip__end'); ?>
                </select>
                <?php
                if(isset($enderror)){
                    echo "<div class='alert alert-danger' role='alert'>$enderror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__organizer" class="col-sm-2 col-form-label">Organizer:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__organizer" class="form-control col-sm-6" name="fieldtrip__organizer">
                    <option value="">Please Select an Organizer</option>
                    <?php
                    foreach ($staffmembers as $key => $staffmember ){
                        $selected = "";
                        if ($_POST['fieldtrip__organizer'] == $staffmember['staffID'] ){
                            $selected = 'selected';
                        }
                        echo "<option value='". $staffmember['staffID'] . "'" . $selected . ">" . $staffmember['firstname'] . " " . $staffmember['lastname'] . "</option>";
                    }
                    ?>
                </select>
                <?php
                if(isset($organizererror)){
                    echo "<div class='alert alert-danger' role='alert'>$organizererror</div>";
                }
                ?>
            </div>
        </div>
        <div class="col-sm-6">
            <input class="btn btn-secondary" name="submit__addtrip" type="submit" value="Add New Field Trip">
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>





