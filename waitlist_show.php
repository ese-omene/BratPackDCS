<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';

$dbcon = Database::getDb();
if(isset($_POST['searchStudents'])){
    $search_keyword = $_POST['searchKey'];
} else {
    $search_keyword = "";
}
$wl = new Student();
$waitlist = $wl->viewWaitlist($dbcon, $search_keyword);
include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

?>
<p class="h1 text-center">Current Waitlist</p>
<div class="container-fluid">
    <a href="student_list.php" class="btn btn-light">Back to Student List</a>
    <form action="" method="post">
        <input type="text" name="searchKey" id="searchKey" placeholder="Search students">
        <button type="submit" id="searchStudents" name="searchStudents">Search</button>
    </form>
    <table class="table table-bordered tbl container">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Age</th>
            <th scope="col">Parent Name</th>
            <th scope="col">Change Status</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($waitlist as $w) {
            ?>
            <tr>
                <th><?= $w->id; ?></th>
                <td><?= $w->first_name; ?></td>
                <td><?= $w->last_name; ?></td>
                <td><?= $w->Age; ?> year(s)</td>
                <td><?= $w->Parent_Name; ?></td>
                <td>
                    <form action="waitlist_status.php" method="post">
                        <input type="hidden" name="id" value="<?= $w->id ?>"/>
                        <input type="submit" class="btn btn-success" name="updateStatus" value="Change Status"/>
                    </form>
                </td>
                <td>
                    <form action="student_delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $w->id ?>"/>
                        <input type="submit" class="btn btn-danger" name="deleteStudent" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>
</div>
<?php
include "includes/footer.php";
?>