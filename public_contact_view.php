<?php
include "includes/header.php";

// parents have access to the contact page
if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}
?>
<div class="container__public">
    <h1>Contact The Brat Pack: Daycare System</h1>
    <img src="images/icons/contactform.png" class="icons" alt="Contact Form Icon" width="100px" height="auto">
    <p>Have questions or want information about our services?</p>
    <p>Fill out our contact form!</p>
        <div class="public_contact"> <a href="contact_add.php" class="btn btn-sub">New Contact Form</a> </div>
</div>

<?php
include "includes/footer.php";
?>