<?php
session_start();
//we start the session in the nav so that depending on which user is logged in they can see their options
?><nav id="main__nav">
    <ul>
        <li class="nav-item"><a href="index.php">Home</a></li>
        <?php
        // if the user is a type 'admin' they'll be able to see the dropdown for their pages on the nav and be redirected to they're homepage.
        if (isset($_SESSION['userinfo']) && $_SESSION['userinfo']['type'] == 'admin') {
            ?>
            <li class="nav-item"><a href="admin.php">Profile</a></li>
            <li class="nav-item dropdown">
                <a class="nav-item dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">Admin</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="contact_list.php">Contact Forms</a>
                    <a class="dropdown-item" href="pickupschedule_list.php">Pickup Schedule</a>
                    <a class="dropdown-item" href="fieldtrip_list.php">Field Trips</a>
                    <a class="dropdown-item" href="staffdirectory_list.php">Staff Directory</a>
                    <a class="dropdown-item" href="messages_show.php">Messages</a>
                    <a class="dropdown-item" href="waitlist_show.php">Waitlist</a>
                    <a class="dropdown-item" href="student_list.php">All Students</a>
                    <a class="dropdown-item" href="menu_list.php">Menu</a>
                    <a class="dropdown-item" href="activities_list.php">Activities</a>
                </div>
            </li>
            <?php
        } ?>
        <?php
        // if the user is a type 'parent' they'll be able to see the dropdown for the parent view in the homepage
        if (isset($_SESSION['userinfo']) && $_SESSION['userinfo']['type'] == 'parent') {
        ?>
        <li class="nav-item"><a href="public_interface.php">Profile</a></li>
        <li class="nav-item dropdown">
            <a class="nav-item dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Parents</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="public_contact_view.php">Contact Form</a>
                <a class="dropdown-item" href="public_pickupschedule_view.php">Pickup Scheduler</a>
                <a class="dropdown-item" href="public_fieldtrip_list.php">Field Trips</a>
                <a class="dropdown-item" href="public_staffdirectory_list.php">Staff Directory</a>
                <a class="dropdown-item" href="public_messages.php">Messages</a>
                <a class="dropdown-item" href="public_waitlist_show.php">Waitlist</a>
                <a class="dropdown-item" href="public_menu_list.php">Menu</a>
                <a class="dropdown-item" href="public_activities_list.php">Activities</a>
            </div>
        </li>
            <?php
        }?>
        <?php
        //if no user is logged in then they will see the  'Log In' option
        if (!isset($_SESSION['userinfo'])){
        ?>
        <li class="nav-item"><a href="public_login.php">Log In</a></li>
        <?php
        // if a user is logged in the will see the 'Log Out' option
        } else if (isset($_SESSION['userinfo'])){
        ?>
        <li class="nav-item"><a href="logout.php">Log Out</a></li>
        <?php
        }
        ?>
    </ul>
</nav>