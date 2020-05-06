<?php
require_once 'Classes/Database.php';
require_once 'Classes/Message.php';

if(isset($_POST['updateMessage'])) {
    $id = $_POST['id'];
    $dbcon = Database::getDb();
    $m = new Message();
    $msg = $m->getMsgByID($dbcon, $id);

    $subject = $msg->subject;
    $body = $msg->body;
    $topic = $msg->name;
    $topic_id = $msg->topic_id;
    $selected = "";

    $topics = $m->viewTopics($dbcon);
}

if(isset($_POST['updateMsg'])) {
    $id = $_POST['msgid'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $topic = $_POST['topic'];

    $dbCon = Database::getDb();
    $msgUpdate = new Message();
    $mup = $msgUpdate->updateMessage($dbCon, $id, $subject, $body, $topic);

    if ($mup) {
        header('Location: messages_show.php');
    } else {
        echo "problem";
    }

//    $form_errs = $wl->validateForm($subject, $body, $topic, $form_errs);
//    if (empty($form_errs)){
//        $form_errs .= "Student registered!";
//    }
}

include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
?>

<h1 class="h1 text-center">Update Message</h1>
<div class="container-fluid fullpg">
    <a href="messages_show.php" class="btn btn-light">Back to Messages</a>
    <!--    Update Message -->
    <div class="bg-light">
    <div class="container-fluid">
        <form action="" method="post">
        <input type="hidden" name="msgid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input class="form-control" type="text" name="subject" id="subject" value="<?= $subject; ?>">
        </div>
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" rows="10" name="body" id="body"><?= $body; ?></textarea>
        </div>
        <div class="form-group">
            <label for="topic">Topic:</label>
            <select class="form-control" id="topic" name="topic">
                <?php foreach($topics as $t) {
                    if ($topic === $t->name){
                        $selected = "selected";
                    }
                ?>
                    <option value="<?= $t->id; ?>" <?=$selected;?>><?= $t->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <button class="btn btn-success" type="submit" name="updateMsg"
                id="updateMsg">
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
