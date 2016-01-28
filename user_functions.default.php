<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.0.0
 * @authors         Martin Hecht
 * @copyright       2004-2015, Website Baker Org. e.V.
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl 
 *
 **/


/* -------------------------------------------------------- */
// Must include code to stop this file being accessed directly
if(!defined('WB_PATH')) {
        // Stop this file being access directly
        die('<head><title>Access denied</title></head><body><h2 style="color:red;margin:3em auto;text-align:center;">Cannot access this file directly</h2></body></html>');
}
/* -------------------------------------------------------- */



// user function hook to modify values of the entry before processing

/* 
// This is an example code which puts a headline for each month into the list

function extcal_user_prepare_entry($entry){
        global $extcal_current_month;
        $entry_month=date("F Y",$entry["start"]);
        if($entry_month!=$extcal_current_month && $entry["end"]>=strtotime(date("Ymd"))){
                // you might want to translate it 
                // we abuse the function of the next example to accomplish this:
                echo extcal_user_process_placeholders("<h3>$entry_month</h3>\n");
                $extcal_current_month=$entry_month;
        }
        // always return the entry again
        return $entry;
}

*/
                

                
// user function hook to process the individual place holders

/*
// this is an example function which translates English days of week to German

function extcal_user_process_placeholders($placeholders){

        $translation = array (  "Monday" => "Montag",
                                "Tuesday" => "Dienstag",
                                "Wednesday" => "Mittwoch",
                                "Thursday" => "Donnerstag",
                                "Friday" => "Freitag",
                                "Saturday" => "Samstag",
                                "Sunday" => "Sonntag",
                                
                                "January" => "Januar",
                                "February" => "Februar",
                                "March" => "M&auml;rz",
                                // April stays the same in German
                                "May" => "Mai",
                                "June" => "Juni",
                                "July" => "Juli",
                                // August and September stay the same
                                "October" => "Oktober",
                                // November stays the same
                                "December" => "Dezember"
                        );

        // always return an array for the placeholders again
        return str_replace(array_keys($translation),array_values($translation),$placeholders);
}

*/

                

// user function hook to postprocess the whole entry

/*
// this is an example function which makes real links out of URLs e.g. in the descripton

function extcal_user_postprocess_entry($output_string){
        // always return the modified output string
        return preg_replace("/(https?:\/\/\S+)/",'<a href="$1">$1</a>',$output_string);
}

*/
