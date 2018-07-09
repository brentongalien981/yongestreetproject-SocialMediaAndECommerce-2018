<?php
// TODO:SECTION: General js scripts that needs <php> tags.
?>
<script>
    function get_csrf_token() {
        return "<?= sessionize_csrf_token(); ?>";
    }

    function get_local_url() {
        return "http://localhost/myPersonalProjects/yongestreetproject/app/public/";
    }

    function getLocalUrl() {
        return get_local_url();
    }

    function get_local_ajax_handler_url() {
        return "http://localhost/myPersonalProjects/yongestreetproject/app/request/request.php";
    }

    function getLocalAjaxHandlerUrl() {
        return "http://localhost/myPersonalProjects/yongestreetproject/app/core/main2/Request.php";
    }
</script>



<script src="<?= PUBLIC_LOCAL . "js/layout/general.js"; ?>"></script>
<script src="<?= PUBLIC_LOCAL . "js/layout/main_script.js"; ?>"></script>
<script src="<?= PUBLIC_LOCAL . "js/layout/main_script2.js"; ?>"></script>