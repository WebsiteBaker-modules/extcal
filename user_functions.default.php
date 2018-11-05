<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.2.2
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2018, Martin Hecht (mrbaseman)
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @link            https://forum.wbce.org/viewtopic.php?id=18536
 * @link            https://forum.websitebaker.org/index.php/topic,30975.0.html
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl
 *
 **/


/* -------------------------------------------------------- */
// Must include code to stop this file being accessed directly
if(!defined('WB_PATH')) {
        // Stop this file being access directly
        if(!headers_sent()) header("Location: ../index.php",TRUE,301);
        die('<head><title>Access denied</title></head><body><h2 style="color:red;margin:3em auto;text-align:center;">Cannot access this file directly</h2></body></html>');
}
/* -------------------------------------------------------- */



// user function hook to modify values of the entry before processing

/*
// This is an example code which puts a headline for each month into the list

function extcal_user_prepare_entry($entry,$settings=null,$section_id=NULL){
    global $extcal_current_month;
    $entry_month=date("F Y",$entry["start"]);
    if($entry_month!=$extcal_current_month && $entry["end"]>=strtotime(date("Ymd"))){
        // if the entry_template is empty, too, we don't expect any output
        if($settings['entry_template']!=''){
            // you might want to translate it
            // we abuse the function of the next example to accomplish this:
            echo extcal_user_process_placeholders("<h3>$entry_month</h3>\n");
            $extcal_current_month=$entry_month;
        }
    }
    // always return the entry again
    return $entry;
}

*/



// user function hook to process the individual place holders

/*
// this is an example function which translates English days of week to German

function extcal_user_process_placeholders($placeholders,$settings=null){

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
    return str_replace(
        array_keys($translation),
        array_values($translation),
        $placeholders
    );
}

*/



// user function hook to postprocess the whole entry

/*
// this is an example function which makes real links out of URLs e.g. in the descripton


function extcal_user_postprocess_entry($output_string,$settings=null){
    $matches=array();
    // define filter regular expressions and their replacements:
    $extcal_output_filters=array(
        // save links that are already html noted
        '/<[aA]\s[^>]*>[^<>]*<\/[aA]>/' => '$0',
        // fully enquoted links
        '/(HYPERLINK\s+)?&quot;(https?:\/\/.*?)&quot;\s*?&quot;(.*?)&quot;/' => '<a href="$2">$3</a>',
        // links with the link text not enquoted
        '/(HYPERLINK\s+)?&quot;(https?:\/\/.*?)&quot;\s*?([^\s<>]+)/' => '<a href="$2">$3</a>',
        // links without link text
        '/(HYPERLINK\s+)?&quot;(https?:\/\/.*?)&quot;/' => '<a href="$2">$2</a>',
        // not enquoted links - just written in the description text and the client program might have not touched them
        // depending on your calendar client you might have to add further patterns before this one
        '/(https?:\/\/[^\s<>]*)/' => '<a href="$1">$1</a>'
    );
    // now loop over the filter list, first loop: detect and store
    foreach($extcal_output_filters as $filter_match => $filter_replacement){
        // find all matches for the current pattern
        while(  preg_match($filter_match,$output_string,$found_matches)){
            // assign a number of the match
            $number='${'.count($matches).'}';
            // store the replacement for the matched string, note that we do the replacement of sub-patterns
            $matches[$number]=preg_replace($filter_match,$filter_replacement,$found_matches[0]);
            // replace the matched string by the number of the match
            $output_string=str_replace($found_matches[0],$number,$output_string);
        }
    }
    // now in a second loop: replace back the stored replacements
    foreach($matches as $number => $replacement){
        $output_string=str_replace($number,$replacement,$output_string);
    }
    // always return the modified output string
    return $output_string;
}

*/
