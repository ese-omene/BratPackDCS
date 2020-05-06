<?php
require_once 'Classes/Database.php';
require_once 'Classes/Message.php';
$dbcon = Database::getDb();
$msgSort = "";
$msg = new Message();
$messages = $msg->viewMessages($dbcon, $msgSort);
$topics = $msg->viewTopics($dbcon);
if(isset($_POST['msgsort'])) {
    $topic = $_POST['topic'];
    $msgSort = " WHERE topics.id = $topic";
    $msg = new Message();
    $messages = $msg->viewMessages($dbcon, $msgSort);
    $topics = $msg->viewTopics($dbcon);
}

include "includes/header.php";
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
?>
<h1 class="h1 text-center">All Messages</h1>
<div class="container-fluid">
<div>
<a href="messages_new.php" id="btn_addMsg" class="btn btn-success btn-lg float-left">Add New Message</a>
    <form method="POST" action="" class="float-right">
    <div class="form-row align-items-center">
        <div class="col-auto">
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
        <div class="col-auto">
            <button class="btn btn-success" type="submit" name="msgsort"
                    id="msgsort">
                View
            </button>
        </div>
    </div>
</form>
</div>
<div class="m-1">
    <table class="table table-bordered tbl container">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Subject</th>
            <th scope="col">Body</th>
            <th scope="col">Topic</th>
            <th scope="col">Date</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($messages as $m) {
            ?>
            <tr>
                <th><?= $m->id; ?></th>
                <td><?= $m->subject; ?></td>
                <td><?= $m->body; ?></td>
                <td><?= $m->name; ?></td>
                <td><?= $m->m_date; ?></td>
                <td>
                    <form action="messages_update.php" method="post">
                        <input type="hidden" name="id" value="<?= $m->id?>"/>
                        <input type="submit" class="btn btn-success" name="updateMessage" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="messages_delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $m->id ?>"/>
                        <input type="submit" class="btn btn-danger" name="deleteMessage" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>
</div>
</div>
<?php
include "includes/footer.php";
?>
