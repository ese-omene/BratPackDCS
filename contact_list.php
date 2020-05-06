<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/Contact.php";
// only admin users have access to this page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

// if the user uses the search bar we get only the data that matches the search
if(isset($_GET['searchContact'])){
    $dbcon = Database::getDb();
    $c = new Contact();
    $contact__searchkey = $_GET['contact__searchkey'];
    $contacts = $c->searchContact($contact__searchkey,$dbcon);

}
// if the user filters by status we only show the data depending on the status
    else if  (isset($_GET['status']))  {
        $dbcon = Database::getDb();
        $c = new Contact();
        $contact__status = $_GET['status'];
        $contacts = $c->sortContactByStatus($contact__status,$dbcon);
}
// if not we get the full list of entries
    else {
    $dbcon = Database::getDb();
    $c = new Contact();
    $contacts = $c->listContact($dbcon);
}

?>

<div class="container">
    <h1>Contact Forms Management System</h1>
    <div class="navbar">
        <form class="form-inline my-2 my-lg-0" method="GET">
            <input class="form-control mr-sm-2" id="search" type="text" name="contact__searchkey" placeholder="Search by name...">
            <input class="btn btn-sub" id="submit" name="searchContact" type="submit" value="Search">
        </form>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter by status
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="contact_list.php?status=submitted">Submitted</a>
                <a class="dropdown-item" href="contact_list.php?status=in-process">In-Process</a>
                <a class="dropdown-item" href="contact_list.php?status=contacted">Contacted</a>
            </div>
        </div>
        <div>
            <a href="contact_list.php" class="btn btn-sub">Full List View</a>
        </div>
    </div>
    <table class="table">
        <thead class="thead-cust">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($contacts as $contact_f) {
            ?>
            <tr>
                <td><?= $contact_f['id'] ?></td>
                <td><?= $contact_f['first_name'] ?></td>
                <td><?= $contact_f['last_name'] ?></td>
                <td><?= $contact_f['status'] ?></td>
                <td>
                    <form action="contact_show.php" method="post">
                        <input type="hidden" name="id" value="<?= $contact_f['id'] ?>"/>
                        <input type="submit" class="btn btn-back" name="showContact" value="Show"/>
                    </form>
                </td>
                <td>
                    <form action="contact_update.php" method="post">
                        <input type="hidden" name="id" value="<?= $contact_f['id'] ?>"/>
                        <input type="submit" class="button btn btn-up" name="updateContact" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="contact_delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $contact_f['id'] ?>"/>
                        <input type="submit" class="button btn btn-del" name="deleteContact" value="Delete"/>
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
