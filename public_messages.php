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
if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}
?>
<h1 class="h1 text-center">All Messages</h1>
<div class="container-fluid">
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
<div class="m-1">
    <table class="table table-bordered tbl container">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Subject</th>
            <th scope="col">Body</th>
            <th scope="col">Topic</th>
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
            </tr>
        <?php  } ?>
        </tbody>
    </table>
</div>
</div>
<?php
include "includes/footer.php";
?>
