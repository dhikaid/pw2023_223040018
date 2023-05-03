<?php
// cek login
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
}

require 'functions.php';

$myuser2 = query("SELECT * FROM users WHERE id_users = '$_SESSION[ids]'")[0];

$toid = $_GET['toid'];

// message
$messages = query("SELECT message, to_id, from_id FROM messages WHERE (from_id = '$myuser2[id_users]' AND to_id = '$toid') OR (to_id = '$myuser2[id_users]' AND from_id = '$toid') ORDER BY id_message ASC");
?>
<div class="card-body overflow-y-scroll card-message">

    <?php foreach ($messages as $message) {
        if ($message['from_id'] === $myuser2['id_users']) { ?>
            <div class="alert alert-primary" role="alert">
                <b>Me : </b><br />
                <?= $message['message']; ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-light" role="alert">
                <b>Admin : </b><br />
                <?= $message['message']; ?>
            </div>
    <?php }
    } ?>
</div>