<?php
include "includes/header.php";
include "functions/functions_susan.php";

require_once "Classes/Database.php";
require_once "Classes/StaffDirectory.php";

if(isset($_GET['staffID'])){
    $staffID = $_GET['staffID'];
    $dbcon = Database::getDb();

    $sd = new StaffDirectory();
    $staffmembers = $sd->getStaffById($staffID, $dbcon);

    // var_dump($staffmembers);

    $staff__firstname =  $staffmembers->firstname;
    $staff__lastname =  $staffmembers->lastname;
    $staff__email =  $staffmembers->email;
    $staff__phone =  $staffmembers->phone;
    $staff__jobtitle =  $staffmembers->jobtitle;
    $staff__photo = $staffmembers->photo;

}
?>

<div class="container">
    <h1>Show Member</h1>

    <div class="navbar">
        <a href='staffdirectory_update.php?staffID=<?=$staffID ?>' class="button btn btn-primary" >Update Staff</a></td>
        <a href="staffdirectory_list.php" class="btn btn-secondary">Back to List</a>
        <button type='button' class='btn btn-danger' data-toggle='modal' data-target="#deletestaff<?=$staffID ?>">Delete Staff Member</button>
        <div class="modal fade" id="deletestaff<?=$staffID ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Delete Staff Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: left;">Would you like to delete <?= $staff__firstname . " " . $staff__lastname ?> from the staff directory?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="staffdirectory_delete.php?staffID=<?=$staffID  ?>" class="btn btn-danger" >Delete Staff</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form>
        <div class="form-group row">
            <label for="staff__firstname" class="col-sm-2 col-form-label">First Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="staff__firstname" name="staff__firstname" value="<?= $staff__firstname; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__lastname" class="col-sm-2 col-form-label">Last Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__lastname" name="staff__lastname" value="<?= $staff__lastname; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__email" name="staff__email" value="<?= $staff__email; ?>"  readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__phone" class="col-sm-2 col-form-label">Phone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="staff__phone" name="staff__phone" value="<?= $staff__phone; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__jobtitle" class="col-sm-2 col-form-label">Job Title:</label>
            <div class="col-sm-6">
                <select id="staff_jobtitle" class="form-control col-sm-6" name="staff__jobtitle" disabled>
                    <?php displayselectoptions($jobtitles, $staff__jobtitle); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staff__photo" class="col-sm-2 col-form-label">Photo:</label>
            <div class="input-group mb-3 col-sm-6">
                <img src="<?= $staff__photo; ?>" width="150px" align="left">
            </div>
            <script type="text/javascript">
                (function() {
                    var img = document.getElementById('container').firstChild;
                    img.onload = function() {
                        if(img.height > img.width) {
                            img.height = '100%';
                            img.width = 'auto';
                        }
                    };
                }());
            </script>
        </div>
        <div class="navbar">
            <input class="btn btn-secondary" type="submit" name="submit__updatestaff" value="Update Staff Member">
        </div>
    </form>
</div>


<?php
include "includes/footer.php";
?>
