<?php 
require_once(PUBLIC_PATH . "layout/master.php"); 
?>


<h5>FILE: home/index</h5>



<?php if (\App\Model\Session::getInstance()->is_logged_in()) { ?>
    <h4>Oh yeah! You're now logged in!!</h4>
<?php } else { ?>
    <h4>Oh shootz! Ain't logged-in yet!!</h4>
<?php } ?>