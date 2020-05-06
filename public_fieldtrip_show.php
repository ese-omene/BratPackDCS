<?php
include "includes/header.php";
include "functions/functions_susan.php";

require_once "Classes/Database.php";
require_once "Classes/Fieldtrip.php";
require_once 'Classes/StaffDirectory.php';


$fieldtrip__searchkey = "";
$staff__searchkey = "";
$public__jobtitle = "";
$tripID = $_GET['tripID'];


$dbcon = Database::getDb();

$sd = new StaffDirectory();
$staffmembers = $sd->liststaff($dbcon, $staff__searchkey, $public__jobtitle);

$ft = new Fieldtrip();

// Diplay details for that specific trip:

if (isset($_GET['tripID'])){

    $fieldtrips = $ft->listfieldtrips($dbcon, $fieldtrip__searchkey, $tripID);
    // print_r($fieldtrips);

    $fieldtrip__location =  $fieldtrips[0]['location'];
    $fieldtrip__description = $fieldtrips[0]['description'];
    $fieldtrip__date = $fieldtrips[0]['tripdate'];
    $fieldtrip__start = $fieldtrips[0]['starttime'];
    $fieldtrip__end = $fieldtrips[0]['endtime'];
    $fieldtrip__organizer = $fieldtrips[0]['staffID'];

}


?>

<div class="container">
    <h1>Field Trips</h1>

    <div class="navbar">
        <a href="public_fieldtrip_list.php" class="btn btn-secondary">Back to List</a>
    </div>

    <form method="POST">
        <div class="form-group row">
            <label for="fieldtrip__location" class="col-sm-2 col-form-label">Location:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fieldtrip__location" name="fieldtrip__location" value="<?= $fieldtrip__location; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="fieldtrip__description" rows="4" name="fieldtrip__description" readonly><?= $fieldtrip__description ?></textarea>
            </div>
        </div>
        <div id="txtDate"></div>
        <div class="form-group row">
            <label for="fieldtrip__date" class="col-sm-2 col-form-label">Date:</label>

            <script>
                var fieldtrip__date_existing = new Date('<?= $fieldtrip__date; ?>');
                $( function() {
                    $("#fieldtrip__date").datepicker({
                        onSelect: function (fieldtrip__date){
                            //console.log(fieldtrip__date);
                            $('input[name="fieldtrip__date"]').attr('value', fieldtrip__date);
                        },
                        dateFormat: "yy-mm-dd",
                        disabled: true
                    }).datepicker('setDate', fieldtrip__date_existing);
                });


            </script>
            <div class="col-sm-10">
                <div id="fieldtrip__date"></div>
                <input type="hidden" name="fieldtrip__date" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="fieldtrip__start" class="col-sm-2 col-form-label">Start Time:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__start" class="form-control col-sm-6" name="fieldtrip__start" disabled>
                    <?= displayselectoptions($starttimearray, $fieldtrip__start);?>
                </select>
            </div>
        </div>


        <div class="form-group row">
            <label for="fieldtrip__end" class="col-sm-2 col-form-label">End Time:</label>
            <div class="col-sm-6">
                <select id="fieldtrip__end" class="form-control col-sm-6" name="fieldtrip__end" disabled>
                    <?= displayselectoptions($endtimearray, $fieldtrip__end); ?>
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
                <select id="fieldtrip__organizer" class="form-control col-sm-6" name="fieldtrip__organizer" disabled>
                    <option selected value="">Please Select an Organizer</option>
                    <?php
                    foreach ($staffmembers as $staffmember){
                        if( $staffmember['staffID'] == $fieldtrip__organizer)
                        {
                            $selected = "";
                            //print_r($staffmember['staffID']);
                            $selected = "selected";
                        }
                        echo "<option value='". $staffmember['staffID'] . "' $selected>" . $staffmember['firstname'] . " " . $staffmember['lastname'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>





