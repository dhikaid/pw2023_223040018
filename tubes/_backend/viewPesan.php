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

?>

<div class="card bg-dark">
    <div class="messageRealtime"></div>
    <form action="" method="POST" name="kirimpesan">
        <input type="hidden" value="<?= $myuser2['id_users']; ?>" class="fromid">
        <input type="hidden" value="<?= $toid; ?>" class="toid">

        <div class="row container mb-3 mt-3">
            <div class="col-9">
                <div class="form-floating">
                    <input ca type="text" class="form-control bg-dark message" id="floatingInputInvalid" />
                    <label for="floatingInputInvalid">Send a message</label>
                </div>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-outline-light h-100 w-100">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script src="js/custom.js"></script>
<script>
    sendMessage();
    messageRealtime(<?= $toid; ?>);
</script>