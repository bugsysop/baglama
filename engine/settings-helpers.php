<?php
// Check if option is Valid to string
function baglama_check_valid_option($optionString, $validString = "")
{
    $baglama_tools_options = get_option('baglama_tools_option_name'); // Array of All Options
    if ($validString == "") {
        $validString = $optionString;
    }
    if (isset($baglama_tools_options[$optionString])) {
        if ($validString == $optionString) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
