<script>

    window.onfocus = function () {
        //                window.alert("main content loaded");
        console.log("this tab is now focused and active: " + document.getElementById("title").innerHTML);
        set_session_currently_viewed_user_id();

    };

    function set_session_currently_viewed_user_id() {
        var xhr = new XMLHttpRequest();

        var url = "http://localhost/myPersonalProjects/CuteNinjar/app/ajax-handler/SessionAjaxHandler.php";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    console.log("SUCCESS AJAX for method: set_session_currently_viewed_user_id().");
                    console.log("xhr.responseText.trim(): " + xhr.responseText.trim());
                }

            }


        }

        //uki
        var post_key_value_pairs = "input_currently_viewed_user_id=" + document.getElementById("input_currently_viewed_user_id").value;
        post_key_value_pairs += "&input_currently_viewed_user_name=" + document.getElementById("input_currently_viewed_user_name").value;
        xhr.send(post_key_value_pairs);
    }
</script>