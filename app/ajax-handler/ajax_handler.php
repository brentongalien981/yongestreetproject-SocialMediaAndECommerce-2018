<?php require_once('../../vendor/autoload.php'); ?>

<?php
function isRequestAjax()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }

    return false;

}
?>


<?php
$menu = null;
$action = null;

/* Remember that I'm doing this for MainMiddleware. */
if (is_request_post()) {
    $menu = $_POST['menu'] . 'Controller';
    $action = $_POST['action'];
}
else {
    $menu = $_GET['menu'] . 'Controller';
    $action = $_GET['action'];
}


$class = "App\\Controller\\{$menu}";
$menu_controller = new $class();
$menu_controller->$action();
?>
