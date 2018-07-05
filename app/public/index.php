<?php require_once("layout/master.php"); ?>


<h5>FILE: app/public/index.php</h5>



<?php if ($session->is_logged_in()) { ?>
    <h4>Oh yeah! You're now logged in!!</h4>
<?php } else { ?>
    <h4>Oh shootz! Ain't logged-in yet!!</h4>
<?php } ?>


