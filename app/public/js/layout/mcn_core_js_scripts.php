<?php
// TODO:SECTION: General js scripts that needs <php> tags.
?>
<script>
    function get_csrf_token() {
        return "<?= sessionize_csrf_token(); ?>";
    }

    function get_local_url() {
        return "http://localhost/myPersonalProjects/CuteNinjar/app/public/";
    }

    function get_local_ajax_handler_url() {
        return "http://localhost/myPersonalProjects/CuteNinjar/app/request/request.php";
    }
</script>



<script src="<?= PUBLIC_LOCAL . "js/layout/general.js"; ?>"></script>
<script src="<?= PUBLIC_LOCAL . "js/layout/main_script.js"; ?>"></script>
<script src="<?= PUBLIC_LOCAL . "js/layout/main_script2.js"; ?>"></script>