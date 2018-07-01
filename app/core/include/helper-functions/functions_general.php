<?php
//function strip_zeros_from_date( $marked_string="" ) {
//  // first remove the marked zeros
//  $no_zeros = str_replace('*0', '', $marked_string);
//  // then remove any remaining marks
//  $cleaned_string = str_replace('*', '', $no_zeros);
//  return $cleaned_string;
//}
//
//function redirect_to( $location = NULL ) {
//  if ($location != NULL) {
//    header("Location: {$location}");
//    exit;
//  }
//}
//
//function output_message($message="") {
//  if (!empty($message)) { 
//    return "<p class=\"message\">{$message}</p>";
//  } else {
//    return "";
//  }
//}
//
//function __autoload($class_name) {
//	$class_name = strtolower($class_name);
//  $path = LIB_PATH.DS."{$class_name}.php";
//  if(file_exists($path)) {
//    require_once($path);
//  } else {
//		die("The file {$class_name}.php could not be found.");
//	}
//}

//function include_layout_template($template="") {
//	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
//}

//function log_action($action, $message="") {
//	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
//	$new = file_exists($logfile) ? false : true;
//  if($handle = fopen($logfile, 'a')) { // append
//    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
//		$content = "{$timestamp} | {$action}: {$message}\n";
//    fwrite($handle, $content);
//    fclose($handle);
//    if($new) { chmod($logfile, 0755); }
//  } else {
//    echo "Could not open log file for writing.";
//  }
//}


// Put all of your general functions in this file

// header redirection often requires output buffering 
// to be turned on in php.ini.
function redirect_to($new_location)
{
    header("Location: " . $new_location);
    exit;
}


function tryLoadingSpecificJsFile($filePath = null) {

    if ($filePath == null) { return; }

    $doesFileExist = file_exists(JS_PATH . "{$filePath}.js");
    if ($doesFileExist) {
        $scriptTag = "<script src='" . PUBLIC_LOCAL . "js/" . $filePath . ".js'></script>";
        echo $scriptTag;
    }
}

function tryLoadingSpecificJsFilesFor($currentDir, $specificFiles = null)
{

    // Now load all the remaining js files.
    foreach ($specificFiles as $file) {

        //
        $doesFileExist = file_exists(JS_PATH . "{$currentDir}/{$file}.js");
        if ($doesFileExist) {
            $scriptTag = "<script src='" . PUBLIC_LOCAL . "js/" . $currentDir . "/" . $file . ".js'></script>";
            echo $scriptTag;
        }
    }


}


function tryLoadingScriptFor($currentDir, $file = null, $isScriptTypeModulized = false)
{

    //
    $doesFileExist = file_exists(JS_PATH . "{$currentDir}/{$file}.js");
    if ($doesFileExist) {

        if ($isScriptTypeModulized) { $scriptTag = "<script src='" . PUBLIC_LOCAL . "js/" . $currentDir . "/" . $file . ".js' type='module'></script>"; }
        else { $scriptTag = "<script src='" . PUBLIC_LOCAL . "js/" . $currentDir . "/" . $file . ".js'></script>"; }

        echo $scriptTag;
    }


}


/**
 * @param $currentDir
 * @param null $requestAction
 * @param null $specificFiles are files that will loaded specifically for that
 *      $requestAction. Ex if $requestAction is "show", and $specificFiles is
 *      ['tasks', 'general_functions'], then instead of loading files tasks.js and
 *      general_functions.js by default, this func instead loads files tasks@show.js
 *      and general_functions@show.js and the other default *.js files...
 */
function tryLoadingJsFilesFor($currentDir, $requestAction = null, $specificFiles = [])
{
    $files = [
        'instance_vars',
        'general_functions',
        'general_functions2',
        'general_functions3',
        'create',
        'read',
        'show',
        'update',
        'delete',
        'fetch',
        'patch',
        'event_handlers',
        'event_handlers2',
        'event_listeners',
        'event_listeners2',
        'event_listeners3',
        'tasks',
        'experiments'
    ];

    $specificJsPseudoObjFileName = getSpecificJsPseudoObjFileName($currentDir);

    // Load the JsPseudoObj first.
    $doesFileExist = file_exists(JS_PATH . "{$currentDir}/{$specificJsPseudoObjFileName}");
    if ($doesFileExist) {
        $scriptTag = "<script src='" . PUBLIC_LOCAL . "js/" . $currentDir . "/" . $specificJsPseudoObjFileName . "'></script>";
        echo $scriptTag;
    }

    // Now load all the remaining js files.
    foreach ($files as $file) {

        // Sanity check.
//        if ($specificFiles == null) { continue; }

        // If the request action is other than index or read, like show, create, etc.,
        // change it to like tasks@show, tasks@create, etc...
        if (in_array($file, $specificFiles)) {
            $file = $file . "@" . $requestAction;
        }

        //
        $doesFileExist = file_exists(JS_PATH . "{$currentDir}/{$file}.js");
        if ($doesFileExist) {
            $scriptTag = "<script src='" . PUBLIC_LOCAL . "js/" . $currentDir . "/" . $file . ".js'></script>";
            echo $scriptTag;
        }
    }


}

function getSpecificJsPseudoObjFileName($currentDir)
{
    $specificJsPseudoObjFileName = null;
    switch ($currentDir) {
        case 'user':
            $specificJsPseudoObjFileName = "User";
            break;
        case 'profile':
            $specificJsPseudoObjFileName = "Profile";
            break;
        case 'timeline-post':
            $specificJsPseudoObjFileName = "TimelinePost";
            break;
        case 'timeline-post-reply':
            $specificJsPseudoObjFileName = "TimelinePostReply";
            break;
        case 'timeline-post-user-subscription':
            $specificJsPseudoObjFileName = "TimelinePostUserSubscription";
            break;
        case 'rateable-item':
            $specificJsPseudoObjFileName = "RateableItem";
            break;
        case 'rateable-item-user':
            $specificJsPseudoObjFileName = "RateableItemUser";
            break;
        case 'notification':
            $specificJsPseudoObjFileName = "Notification";
            break;
        case 'notification-rateable-item':
            $specificJsPseudoObjFileName = "NotificationRateableItem";
            break;
        case 'notification-timeline-post-reply';
            $specificJsPseudoObjFileName = "NotificationTimelinePostReply";
            break;
        case 'photo';
            $specificJsPseudoObjFileName = "Photo";
            break;
        case 'my-photo';
            $specificJsPseudoObjFileName = "MyPhoto";
            break;
        case 'user-social-media-account';
            $specificJsPseudoObjFileName = "UserSocialMediaAccount";
            break;
        case 'user-top-activity';
            $specificJsPseudoObjFileName = "UserTopActivity";
            break;
        case 'work';
            $specificJsPseudoObjFileName = "Work";
            break;
        case 'friendship';
            $specificJsPseudoObjFileName = "Friendship";
            break;
        case 'friend';
            $specificJsPseudoObjFileName = "Friend";
            break;
        case 'video';
            $specificJsPseudoObjFileName = "Video";
            break;
        case 'video-playlist-plug-in';
        case 'video-playlist';
            $specificJsPseudoObjFileName = "Playlist";
            break;
        case 'comments-plug-in';
            $specificJsPseudoObjFileName = "Comment";
            break;
        case 'video-recommendations-plug-in';
            $specificJsPseudoObjFileName = "VideoRecommendationItem";
            break;
        case 'video-user-playlists-plug-in';
            $specificJsPseudoObjFileName = "UserPlaylist";
            break;
        case 'video-categories-plug-in';
            $specificJsPseudoObjFileName = "Category";
            break;


    }

    $specificJsPseudoObjFileName .= ".js";

    return $specificJsPseudoObjFileName;
}

?>