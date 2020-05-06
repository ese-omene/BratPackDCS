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
if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}

?>
<p class="h1 text-center">Student Waitlist</p>
<div class="container-fluid">
    <div class="container-fluid">
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
            </tr>
        <?php  } ?>
        </tbody>
    </table>
</div>
</div>
<?php
include "includes/footer.php";
?>