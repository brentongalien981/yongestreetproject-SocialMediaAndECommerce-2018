<?php use App\Model\Profile; ?>

<?php
/**
 * @param int $user_id
 * @return picture src / null
 */
function b_get_profile_pic_src($user_id = 0)
{
    $data = array('id' => $user_id);
    $profile = new Profile();
    $profiles = $profile->read_by_id($data);
//    $profiles = Profile::read_by_id($data);

    $src = null;
    if (isset($profiles[0])) {
        $profile_obj = $profiles[0];

        $src = $profile_obj->pic_url;
//        $src = $profile_obj['pic_url'];
    }
    else {
        $src = getDefaultUserPhotoUrl();
    }


    return $src;
}

function show_user_home_icon($user_id = 0, $icon_class, $menu, $label = "")
{

    $src = b_get_profile_pic_src($user_id);

    if (isset($src) && ($src != "0")) {
        echo "<img id='profile_pic' src=\"{$src}\" class=\"{$icon_class}\">{$label}";
    } else {
        show_default_user_home_icon($icon_class, $menu, $label);
    }
}

/**
 * Usage: Get profile pic's dom element in string form. <img> or <i>
 */
function b_get_profile_pic_el_string($user_id = 0, $menu, $icon_class) {
    $src = b_get_profile_pic_src($user_id);

    if (isset($src)) {
        return "<img src=\"{$src}\" class=\"{$icon_class}\">";
    } else {
        return get_default_icon($icon_class, $menu);
    }
}

function get_default_icon($icon_class, $menu)
{
    switch ($menu) {
        case "post":
            return "<i class=\"fa fa-user-circle-o {$icon_class} b-i-{$icon_class}\"></i>";
            break;
    }

}

function show_default_user_home_icon($icon_class, $menu, $label = "")
{
    switch ($menu) {
        case "user_home":
        case "profile":
            echo "<i id='profile-pic' class=\"fa fa-user-circle-o {$icon_class} b-i-{$icon_class}\"></i>";
            break;
        case "wall":
            echo "<i class=\"fa fa-th-list {$icon_class} b-i-{$icon_class}\"></i>";
//            echo "<i class=\"material-icons {$icon_class} b-i-{$icon_class}\">x</i>";
            break;
    }

    echo "{$label}";

}

function getSiteLogoPhotoUrl() {
    return "https://farm5.staticflickr.com/4557/24004359337_33f64e5a90_q.jpg";
}

function getDefaultUserPhotoUrl() {
//    return "https://farm5.staticflickr.com/4619/39405776315_325e642287_q.jpg";
    return "https://farm5.staticflickr.com/4557/24004359337_33f64e5a90_q.jpg";
}

?>