<?php

require_once 'Classes/Database.php';
require_once 'Classes/Message.php';

$dbcon = Database::getDb();
$topic = new Message();
$topics = $topic->viewTopics($dbcon);

//check if form is submitted
if (isset($_POST['addMsg'])) {
    //get values from form and assign to local variable
    $id = $_POST['mid'];
    $subject = $_POST['subject'];
    $msg = $_POST['body'];
    $topic = $_POST['topic'];
    $form_errs = "";

    $dbcon = Database::getDb();
    $msgs = new Message();
    $messages = $msgs->addMessage($dbcon, $subject, $msg, $topic);

    if ($messages) {
        header('Location: messages_show.php');
    } else {
        echo "problem inserting data";
    }

}

include "includes/header.php";

?>

<h1 class="h1 text-center">Create New Message</h1>
    <div class="container-fluid fullpg">
    <a href="messages_show.php" class="btn btn-light">Back to Messages</a>
    <!--    Form to Add to Waitlist -->
    <div class="bg-light">
        <div class="container-fluid">
    <form action="" method="post">
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input class="form-control" type="text" name="subject" id="subject" value=""
                   placeholder="Enter your subject">
        </div>
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" rows="10" name="body" id="body"></textarea>
        </div>
        <div class="form-group">
            <label for="topics">Topic:</label>
            <select class="form-control" id="topics" name="topic">
            <?php foreach($topics as $t) { ?>
                <option value="<?= $t->id; ?>"> <?= $t->name; ?> </option>
            <?php } ?>
            </select>
        </div>
        <button class="btn btn-success" type="submit" name="addMsg"
                id="btn-submit">
            Add Message
        </button>
    </form>
        </div>
    </div>
</div>
    <!-- tinymce editor for message system -->
    <script src="https://cdn.tiny.cloud/1/frxcubdtghe207z3aetz6v38pnxocd1g4i4fnie8597tnee2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
<?php
include "includes/footer.php";
?>