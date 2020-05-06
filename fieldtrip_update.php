<?php
include "includes/header.php";
include "functions/functions_susan.php";

require_once "Classes/Database.php";
require_once "Classes/Fieldtrip.php";
require_once 'Classes/StaffDirectory.php';

$locationerror = $descriptionerror = $dateerror = $starterror = $enderror = $organizererror = "";


$fieldtrip__searchkey = "";
$staff__searchkey = "";
$public__jobtitle = "";



// Display existing trip from the database using the tripID"
if (isset($_GET['tripID'])){
    $tripID = $_GET['tripID'];
    $dbcon = Database::getDb();
    $ft = new Fieldtrip();

    $fieldtrips = $ft->listfieldtrips($dbcon, $fieldtrip__searchkey, $tripID);
    // print_r($fieldtrips);

    $fieldtrip__location =  $fieldtrips[0]['location'];
    $fieldtrip__description = $fieldtrips[0]['description'];
    $fieldtrip__date = $fieldtrips[0]['tripdate'];
    $fieldtrip__start = $fieldtrips[0]['starttime'];
    $fieldtrip__end = $fieldtrips[0]['endtime'];
    $fieldtrip__organizer = $fieldtrips[0]['staffID'];

}


$sd = new StaffDirectory();
$staffmembers = $sd->liststaff($dbcon, $staff__searchkey, $public__jobtitle);

$error = FALSE;

// Update trip data if there have been any updates:

if (isset($_POST['submit__updatetrip'])){

    $fieldtrip__location = $_POST['fieldtrip__location'];
    $fieldtrip__description = $_POST['fieldtrip__description'];
    $fieldtrip__date = $_POST['fieldtrip__date'];
    $fieldtrip__start = $_POST['fieldtrip__start'];
    $fieldtrip__end = $_POST['fieldtrip__end'];
    $fieldtrip__organizer = $_POST['fieldtrip__organizer'];

    // Error handling:
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


    // If here are no errors, update trip data:
    if ($error == FALSE) {
        $dbcon = Database::getDb();

        $trip = new Fieldtrip();
        $trips = $trip->updatefieldtrip($dbcon, $fieldtrip__location, $fieldtrip__description, $fieldtrip__date, $fieldtrip__start, $fieldtrip__end, $fieldtrip__organizer, $tripID);

    }

}



?>

<div class="container">
    <h1>Field Trips</h1>

    <div class="navbar">
        <a href="fieldtrip_list.php" class="btn btn-secondary">Back to List</a>
        <button type='button' class='btn btn-danger' data-toggle='modal' data-target="#deletefieldtrip<?=$tripID ?>">Delete</button>
        <div class="modal fade" id="deletefieldtrip<?=$tripID ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Delete Field Trip Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: left;">Would you like to delete the following Field Trip:<strong> <?= $fieldtrip__location?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="fieldtrip_delete.php?tripID=<?=$tripID ?>" class="btn btn-danger" >Delete Field Trip</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST">
        <div class="form-group row">
            <label for="fieldtrip__location" class="col-sm-2 col-form-label">Location:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fieldtrip__location" name="fieldtrip__location" value="<?= $fieldtrip__location; ?>">
                <?php
                if($locationerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$locationerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="fieldtrip__description" rows="4" name="fieldtrip__description"><?= $fieldtrip__description; ?></textarea>
                <?php
                if($descriptionerror!= ""){
                    echo "<div class='alert alert-danger' role='alert'>$descriptionerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__date" class="col-sm-2 col-form-label">Date:</label>

            <script>

                var fieldtrip__date_existing = new Date('<?= $fieldtrip__date; ?>');

                $( function() {
                    $("#fieldtrip__date").datepicker({
                        onSelect: function (fieldtrip__date){
                            console.log(fieldtrip__date);
                            $('input[name="fieldtrip__date"]').attr('value', fieldtrip__date);
                        },
                        dateFormat: "yy-mm-dd"
                    }).datepicker('setDate', fieldtrip__date_existing);
                });

            </script>
            <div class="col-sm-10">
                <div id="fieldtrip__date"></div>
                <input type="hidden" name="fieldtrip__date" value="<?= $fieldtrip__date ?>">
                <?php
                if($dateerror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$dateerror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__start" class="col-sm-2 col-form-label">Start Time:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__start" class="form-control col-sm-6" name="fieldtrip__start">
                    <?= displayselectoptions($starttimearray, $fieldtrip__start);?>
                </select>
                <?php
                if($starterror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$starterror</div>";
                }
                ?>
            </div>
        </div>


        <div class="form-group row">
            <label for="fieldtrip__end" class="col-sm-2 col-form-label">End Time:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__end" class="form-control col-sm-6" name="fieldtrip__end">
                    <?= displayselectoptions($endtimearray, $fieldtrip__end); ?>
                </select>
                <?php
                if($enderror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$enderror</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__organizer" class="col-sm-2 col-form-label">Organizer:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__organizer" class="form-control col-sm-6" name="fieldtrip__organizer">
                    <option selected value="">Please Select an Organizer</option>
                    <?php

                    foreach ($staffmembers as $staffmember){
                        $selected = "";
                        if( $staffmember['staffID'] == $fieldtrip__organizer)
                        {
                            //print_r($staffmember['staffID']);
                            $selected = "selected";
                        }
                        echo "<option value='". $staffmember['staffID'] . "' $selected>" . $staffmember['firstname'] . " " . $staffmember['lastname'] . "</option>";
                    }
                    ?>
                </select>
                <?php
                if($organizererror != ""){
                    echo "<div class='alert alert-danger' role='alert'>$organizererror</div>";
                }
                ?>
            </div>
        </div>
        <div class="col-sm-6">
            <input class="btn btn-secondary" name="submit__updatetrip" type="submit" value="Update Field Trip">
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>





