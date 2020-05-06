<?php include "includes/header.php";

if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
?>
    <div class="container">
        <h1>Daycare Admin Management</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Daycare Feature</th>
                <th>View</th>
                <th>Update</th>
            </tr>
            </thead>
            <tr>
                <td>Daily Updates</td>
                <td><a href="#">View</a></td>
                <td><a href="#">Edit</a></td>
            </tr>
            <tr>
                <td>Artwork</td>
                <td><a href="#">View</a></td>
                <td><a href="#">Edit</a></td>
            </tr>
            <tr>
                <td>Menu</td>
                <td><a href="menu_show.php">View</a></td>
                <td><a href="menu_list.php">Edit</a></td>
            </tr>
            <tr>
                <td>Activities</td>
                <td><a href="activities_show.php">View</a></td>
                <td><a href="activities_list.php">Edit</a></td>
            </tr>
            <tr>
                <td>Fieldtrips</td>
                <td><a href="fieldtrip_list.php">View</a></td>
                <td><a href="fieldtrip_list.php">Edit</a></td>
            </tr>
            <tr>
                <td>Reminders</td>
                <td><a href="#">View</a></td>
                <td><a href="#">Edit</a></td>
            </tr>
            <tr>
                <td>Student List</td>
                <td><a href="student_list.php">View</a></td>
                <td><a href="student_list.php">Edit</a></td>
            </tr>
            <tr>
                <td>Waitlist</td>
                <td><a href="waitlist_show.php">View</a></td>
                <td><a href="waitlist_show.php">Edit</a></td>
            </tr>
            <tr>
                <td>Pickup Scheduler</td>
                <td><a href="pickupschedule_list.php">View</a></td>
                <td><a href="pickupschedule_list.php">Edit</a></td>
            </tr>
            <tr>
                <td>Messages</td>
                <td><a href="messages_show.php">View</a></td>
                <td><a href="messages_show.php">Edit</a></td>
            </tr>
            <tr>
                <td>Staff Directory</td>
                <td><a href="staffdirectory_list.php">View</a></td>
                <td><a href="staffdirectory_list.php">Edit</a></td>
            </tr>
            <tr>
                <td>Contact Form</td>
                <td><a href="contact_list.php">View</a></td>
                <td><a href="contact_list.php">Edit</a></td>
            </tr>
        </table>
    </div>
<?php include "includes/footer.php";  ?>