<?php
require_once 'Classes/Database.php';
require_once 'Classes/Student.php';

$dbcon = Database::getDb();
    if(isset($_POST['searchStudents'])){
        $search_keyword = $_POST['searchKey'];
    } else {
        $search_keyword = "";
    }
$student = new Student();
$students = $student->viewStudents($dbcon, $search_keyword);

include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}


?>
<p class="h1 text-center">Student List</p>
<div class="container-fluid">
    <a href="waitlist_show.php" class="btn btn-light">View Waitlist</a>
    <a href="student_new.php" id="btn_addStudent" class="btn btn-success btn-lg float-right">Add New Student</a>
    <form action="" method="post">
        <input type="text" name="searchKey" id="searchKey" placeholder="Search students">
        <button type="submit" id="searchStudents" name="searchStudents">Search</button>
    </form>
    <table id="studentTable" class="table table-bordered tbl container">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Age</th>
            <th scope="col">Parent Name</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($students as $s) {
                ?>
            <tr>
                <th><?= $s->id; ?></th>
                <td><?= $s->first_name; ?></td>
                <td><?= $s->last_name; ?></td>
                <td><?= $s->Age; ?>  year(s)</td>
                <td><?= $s->Parent_Name; ?></td>
                <td>
                    <form action="student_update.php" method="post">
                         <input type="hidden" name="id" value="<?= $s->id ?>"/>
                         <input type="submit" class="btn btn-success" name="updateS" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="student_delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $s->id ?>"/>
                        <input type="submit" class="btn btn-danger" name="deleteStudent" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
include "includes/footer.php";
?>