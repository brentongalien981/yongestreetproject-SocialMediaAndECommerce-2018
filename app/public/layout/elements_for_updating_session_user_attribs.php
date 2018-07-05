<input id="input_currently_viewed_user_id" type="hidden"
<?php
echo " value='";

if (isset($session->currently_viewed_user_id)) {
    echo $session->currently_viewed_user_id;
}

echo "'>";
?>


<input id="input_currently_viewed_user_name" type="hidden"
<?php
// This input is used to control the currently_viewed_user_id
// on multiple tabs.
echo " value='";

if (isset($session->currently_viewed_user_name)) {
    echo $session->currently_viewed_user_name;
}

echo "'>";
?>