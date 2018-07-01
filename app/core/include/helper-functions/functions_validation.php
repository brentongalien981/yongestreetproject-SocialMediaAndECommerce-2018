<?php

// Core validation functions
// These need to be called from another validation function which 
// handles error reporting.
//
// For example:
//
// $errors = [];
// function validate_presence_on($required_fields) {
//   global $errors;
//   foreach($required_fields as $field) {
//     if (!has_presence($_POST[$field])) {
//       $errors[$field] = "'" . $field . "' can't be blank";
//     }
//   }
// }
//// * validate value has presence
//// use trim() so empty spaces don't count
//// use === to avoid false positives
//// empty() would consider "0" to be empty
//function has_presence($value) {
//	$trimmed_value = trim($value);
//  return isset($trimmed_value) && $trimmed_value !== "";
//}
// * validate value has string length
// leading and trailing spaces will count
// options: exact, max, min
// has_length($first_name, ['exact' => 20])
// has_length($first_name, ['min' => 5, 'max' => 100])
function has_length($value, $options = []) {
    if (isset($options['max']) && (strlen($value) > (int) $options['max'])) {
        return false;
    }
    if (isset($options['min']) && (strlen($value) < (int) $options['min'])) {
        return false;
    }
    if (isset($options['exact']) && (strlen($value) != (int) $options['exact'])) {
        return false;
    }
    return true;
}

// Use only allowable GET and POST variables. 
// Maybe put an array like: $allowed_gets = array();
// @return:
//      - valid POST arrays ==> THIS IS BEFORE ONLY... NOW IT SHOULD RETURN..
//      - true
//      or
//      - false if there's any tampered/invalid var.
function are_post_vars_valid($allowed_assoc_indexes_for_post) {

    foreach ($allowed_assoc_indexes_for_post as $assoc_index) {


        if (isset($_POST[$assoc_index]) || isset($_GET[$assoc_index])) {
//            MyValidationErrorLogger::log("are_vars_clean::: no. Incomplete and tampered");
            continue;
        }
        else { return false; }
    }

    return true;
}


// @param $var_lengts_arr: Post vars that need their length validated.
// @return $return_value: 1 error alone, this will be false.
function validate_vars_lengths($var_lengts_arr) {
    // 
    $return_value = true;

    //
    foreach ($var_lengts_arr as $key => $value) {
        // Validate presence.
        if (!has_presence($_POST[$key])) {
            MyValidationErrorLogger::log("{$key}::: can not be blank");

            $return_value = false;
        }

        // Validate the length.   
        if (!has_length($_POST[$key], $value)) {
            MyValidationErrorLogger::log("{$key}::: should be between {$value['min']} to {$value['max']} characters.");

            $return_value = false;
        }
    }


    return $return_value;
}



// @param $min: The minimum number of numeric characters that should be present in $str.
function has_numeric_chars($str, $min) {
    $strlen = strlen($str);
    $count = 0;

    for ($i = 0; $i <= $strlen; $i++) {
        $char = substr($str, $i, 1);
        if (is_numeric($char)) {
            ++$count;
        }

        if ($count == $min) {
            return true;
        }
    }

    return false;
}

//
function has_alphabet_chars($str, $min) {
    $strlen = strlen($str);
    $count = 0;

    for ($i = 0; $i <= $strlen; $i++) {
        $char = substr($str, $i, 1);
        if (ctype_alpha($char)) {
            ++$count;
        }

        if ($count == $min) {
            return true;
        }
    }

    return false;
}

// * validate value has a format matching a regular expression
// Be sure to use anchor expressions to match start and end of string.
// (Use \A and \Z, not ^ and $ which allow line returns.) 
// 
// Example:
// has_format_matching('1234', '/\d{4}/') is true
// has_format_matching('12345', '/\d{4}/') is also true
// has_format_matching('12345', '/\A\d{4}\Z/') is false
function has_format_matching($value, $regex = '//') {
    return preg_match($regex, $value);
}

// * validate value is a number
// submitted values are strings, so use is_numeric instead of is_int
// options: max, min
// has_number($items_to_order, ['min' => 1, 'max' => 5])
function has_number($value, $options = []) {
    if (!is_numeric($value)) {
        return false;
    }
    if (isset($options['max']) && ($value > (int) $options['max'])) {
        return false;
    }
    if (isset($options['min']) && ($value < (int) $options['min'])) {
        return false;
    }
    return true;
}

//// * validate value is inclused in a set
//function has_inclusion_in($value, $set=[]) {
//  return in_array($value, $set);
//}
// * validate value is excluded from a set
function has_exclusion_from($value, $set = []) {
    return !in_array($value, $set);
}

// * validate uniqueness
// A common validation, but not an easy one to write generically.
// Requires going to the database to check if value is already present.
// Implementation depends on your database set-up.
// Instead, here is a mock-up of the concept.
// Be sure to escape the user-provided value before sending it to the database.
// Table and column will be provided by us and escaping them is optional.
// Also consider whether you want to trim whitespace, or make the query 
// case-sentitive or not.
//
function is_unique($value, $table, $column) {
    global $database;
    $escaped_value = $database->escape_value($value);
    $query = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = '{$escaped_value}'";

    $result_set = $database->get_result_from_query($query);

    //
    while ($row = $database->fetch_array($result_set)) {
        if ($row['count'] > 0) {
            return false;
        } else {
            return true;
        }
    }
}





/* Option #1 checks if the email will be unique after
 * all of the update process. For ex.
 * if I update my email to "email1" from "email",
 * I should be able to access the db and count all users
 * that have the email "email1". If that count is 0, that means
 * the new email will be unique. If that count is 1, check further
 * because the user might not have updated her email at all. So check:
 * is $new_email == $user's_current_email. If it's true, the email will still
 * be unique after the update. If it's not true, then that new email is already
 * taken.
 */
function will_it_be_unique($value, $table, $column, $user_id) {
    global $database;
    $escaped_value = $database->escape_value($value);
    $query = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = '{$escaped_value}'";

    $result_set = $database->get_result_from_query($query);

    //
    while ($row = $database->fetch_array($result_set)) {
        if ($row['count'] == 0) {
            return true;
        }
        else if ($row['count'] == 1) {
            $query = "SELECT {$column} FROM {$table} WHERE user_id = {$user_id}";

            $another_result_set = $database->get_result_from_query($query);

            while ($another_row = $database->fetch_array($another_result_set)) {
                // If old_email == new_email, it still will be unique.
                if ($another_row[$column] == $value) {
                    return true;
                }
                else { return false; }
            }
        }
        else {
            return false;
        }
    }
}

?>