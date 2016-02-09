<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.0.9
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2016, Martin Hecht (mrbaseman)
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



// include language settings 
$lang = (dirname(__FILE__))."/languages/". DEFAULT_LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );


// check if frontend.css file needs to be included into the <body></body> of view.php
if((!function_exists('register_frontend_modfiles') || !defined('MOD_FRONTEND_CSS_REGISTERED')) &&  
        file_exists(WB_PATH .'/modules/extcal/frontend.css')) {
        echo '<style type="text/css">';
        include_once(WB_PATH .'/modules/extcal/frontend.css');
        echo "\n</style>\n";
} 



// Get content
$query="SELECT "
        . " `cal_urls`,"
        . " `max_entries`,"
        . " `max_days`,"
        . " `time_zone`,"
        . " `dateformat`,"
        . " `date_end`,"
        . " `section_start`,"
        . " `section_end`,"
        . " `enable_cache`,"
        . " `refresh_time`," 
        . " `cache_time`," 
        . " `description_end`,"
        . " `entry_template`,"
        . " `description_start`,"     
        . " `location_start`,"
        . " `location_end`,"    
        . " `title_start`,"
        . " `title_end`,"    
        . " `date_start`,"    
        . " `confidential_text`,"
        . " `date_template`,"
        . " `timeformat`,"
        . " `date_separator`,"
        . " `date_template`,"
        . " `optimize_date`,"
        . " `midnight_fix`,"
        . " `verify_peer`,"
        . " `keep_todays_events`,"
        . " `time_offset` "
        . " FROM `".TABLE_PREFIX."mod_extcal`"
        . " WHERE `section_id` = '$section_id'";

$get_content = $database->query($query);
$fetch_content = $get_content->fetchRow();

$cal_urls = $fetch_content['cal_urls'];
$max_days = $fetch_content['max_days'];
$max_entries = $fetch_content['max_entries'];
$time_zone = $fetch_content['time_zone'];
$dateformat = $fetch_content['dateformat'];
$date_end = $fetch_content['date_end'];
$section_start = $fetch_content['section_start'];
$section_end = $fetch_content['section_end'];
$enable_cache = $fetch_content['enable_cache'];
$refresh_time = $fetch_content['refresh_time'];
$cache_time = intval($fetch_content['cache_time'])*24*3600 or 0;
$description_end = $fetch_content['description_end'];
$entry_template = $fetch_content['entry_template'];
$description_start = $fetch_content['description_start'];
$location_start = $fetch_content['location_start'];
$location_end = $fetch_content['location_end'];
$title_start = $fetch_content['title_start'];
$title_end = $fetch_content['title_end'];
$date_start = $fetch_content['date_start'];
$confidential_text = $fetch_content['confidential_text'];
$timeformat = $fetch_content['timeformat'];
$date_separator = $fetch_content['date_separator'];
$date_template = $fetch_content['date_template'];
$optimize_date = $fetch_content['optimize_date'];
$midnight_fix = $fetch_content['midnight_fix'];
$verify_peer = $fetch_content['verify_peer'];
$keep_todays_events = $fetch_content['keep_todays_events'];
$time_offset = $fetch_content['time_offset'];



// for the calendar stuff we need a proper timezone

$TZ=$LANG['frontend']['MOD_EXTCAL_TIMEZONE'];
if($TZ===NULL or $TZ==="{DEFAULT}" or $TZ==="") $TZ=date_default_timezone_get();

if($time_zone === "{DEFAULT}" or $time_zone===NULL)
        $time_zone=$TZ;

$SAVED_TZ=date_default_timezone_get();
date_default_timezone_set($time_zone);

// select range for displaying events *after* having set the time correct zone
$starttime=date("Ymd",strtotime("+$time_offset seconds"));
if(!$keep_todays_events) $starttime.="T".date("His",strtotime("+$time_offset seconds"));  
$endtime=date("Ymd", strtotime("+".$max_days." days", strtotime($starttime)));
if($max_days==0)$endtime=0;


if($dateformat === "{DEFAULT}" or $dateformat===NULL)
        $dateformat=$LANG['frontend']['MOD_EXTCAL_DATEFORMAT'];

if($date_end === "{DEFAULT}" or $date_end===NULL)
        $date_end=$LANG['frontend']['MOD_EXTCAL_DATE_END'];

if($section_start === "{DEFAULT}" or $section_start===NULL)
        $section_start=$LANG['frontend']['MOD_EXTCAL_SECTION_START'];

if($section_end === "{DEFAULT}" or $section_end===NULL)
        $section_end=$LANG['frontend']['MOD_EXTCAL_SECTION_END'];

if($description_end === "{DEFAULT}" or $description_end===NULL)
        $description_end=$LANG['frontend']['MOD_EXTCAL_DESCRIPTION_END'];

if($entry_template === "{DEFAULT}" or $entry_template===NULL)
        $entry_template=$LANG['frontend']['MOD_EXTCAL_ENTRY_TEMPLATE'];

if($description_start === "{DEFAULT}" or $description_start===NULL)
        $description_start=$LANG['frontend']['MOD_EXTCAL_DESCRIPTION_START'];

if($location_start === "{DEFAULT}" or $location_start===NULL)
        $location_start=$LANG['frontend']['MOD_EXTCAL_LOCATION_START'];

if($location_end === "{DEFAULT}" or $location_end===NULL)
        $location_end=$LANG['frontend']['MOD_EXTCAL_LOCATION_END'];

if($title_start === "{DEFAULT}" or $title_start===NULL)
        $title_start=$LANG['frontend']['MOD_EXTCAL_TITLE_START'];

if($title_end === "{DEFAULT}" or $title_end===NULL)
        $title_end=$LANG['frontend']['MOD_EXTCAL_TITLE_END'];

if($date_start === "{DEFAULT}" or $date_start===NULL)
        $date_start=$LANG['frontend']['MOD_EXTCAL_DATE_START'];

if($confidential_text === "{DEFAULT}" or $confidential_text===NULL)
        $confidential_text=$LANG['frontend']['MOD_EXTCAL_CONFIDENTIAL_TEXT'];

if($timeformat === "{DEFAULT}" or $timeformat===NULL)
        $timeformat=$LANG['frontend']['MOD_EXTCAL_TIMEFORMAT'];

if($date_separator === "{DEFAULT}" or $date_separator===NULL)
        $date_separator=$LANG['frontend']['MOD_EXTCAL_DATE_SEPARATOR'];

if($date_template === "{DEFAULT}" or $date_template===NULL)
        $date_template=$LANG['frontend']['MOD_EXTCAL_DATE_TEMPLATE'];

// update fetch_contets array now

$fetch_content=array(
    'cal_urls' => $cal_urls,
    'max_days' => $max_days,
    'max_entries' => $max_entries,
    'time_zone' => $time_zone,
    'dateformat' => $dateformat,
    'date_end' => $date_end,
    'section_start' => $section_start,
    'section_end' => $section_end,
    'enable_cache' => $enable_cache,
    'refresh_time' => $refresh_time,
    'cache_time' => $cache_time,
    'description_end' => $description_end,
    'entry_template' => $entry_template,
    'description_start' => $description_start,
    'location_start' => $location_start,
    'location_end' => $location_end,
    'title_start' => $title_start,
    'title_end' => $title_end,
    'date_start' => $date_start,
    'confidential_text' => $confidential_text,
    'timeformat' => $timeformat,
    'date_separator' => $date_separator,
    'date_template' => $date_template,
    'optimize_date' => $optimize_date,
    'midnight_fix' => $midnight_fix,
    'verify_peer' => $verify_peer,
    'keep_todays_events' => $keep_todays_events,
    'time_offset' => $time_offset
);

require_once('SG_iCal/SG_iCal.php');
require_once('client.php');

$calendars = preg_replace("/#.*/","",preg_split("/[\s]+/", $cal_urls));

$data = array();

if($max_entries>=0 && $max_days>=0)
foreach ($calendars as $ICS){
   if($ICS!=""){
        $filename = tempnam(sys_get_temp_dir(), 'ICS');
        $cachefile=dirname(__FILE__)."/cache/".md5($ICS).".ics";

        if ($enable_cache
            && ($refresh_time > 0)
            && file_exists($cachefile) 
            && time() - filemtime($cachefile) < $refresh_time ){
                if (copy($cachefile, $filename) === FALSE) break;
        } else {
                if (preg_match('/\/$/',$ICS)){
                        if (file_put_contents($filename,WebDAVFetch($ICS,$enable_cache,$cache_time,$verify_peer)) === FALSE) break;
                } else {
                        if(function_exists('curl_init')){
                                if(!curl_get_copy($ICS, $filename, $verify_peer)) break;
                        } else {
                                 // try without curl 
                                 // works for public source and basic authentication only
                                 $copy_result=get_copy($ICS, $filename, $verify_peer);
                                 if(!($copy_result === TRUE)){
                                         echo $copy_result;
                                         break;
                                 }
                        }
                }
                if($enable_cache)copy($filename,$cachefile);
        }

        $ICS=$filename;

        $ical = new SG_iCalReader($ICS);
        $query = new SG_iCal_Query();

        $evts = $ical->getEvents();
        $tzinfo = $ical->getTimeZoneInfo();

        //$evts = $query->Between($ical,strtotime($starttime),strtotime($endtime));

        foreach($evts as $id => $ev) {
                $curr_Evt = array(
                        "id" => ($id+1),
                        "title" => $ev->getProperty('summary'),
                        "start" => $ev->getStart(),
                        "end"   => $ev->getEnd(),
                        "allDay" => $ev->isWholeDay(),
                        "location" => $ev->getLocation(),
                        "description" => $ev->getDescription(),
                        "data" => $ev->data
                );

                if (isset($ev->recurrence)) {
                        $count = 0;
                        $next = -1;
                        $start = $ev->getStart();
                        $freq = $ev->getFrequency();
                        if ($freq->firstOccurrence() == $start)
                                $data[] = $curr_Evt;
                        while ( $next < strtotime($endtime) || $endtime==0 ){
                                $next = $freq->nextOccurrence($start);
                                if (!$next or $count >= 1000) break;
                                $count++;
                                $start = $next;
                                if(($start >= strtotime($endtime)) && ($endtime!=0)) break;
                                $curr_Evt["start"] = $start;
                                $curr_Evt["end"] = $start + $ev->getDuration();
                                $data[] = $curr_Evt;
                        }
                } else {
                        $start = $ev->getStart();
                        if($start < strtotime($endtime) && ($endtime!=0))
                                $data[] = $curr_Evt;
                }
        }
        unlink($filename);
    }
}


$astart = array();

foreach($data as $key => $entry){
        $astart[$key]  = $entry["start"];
}


array_multisort($astart, SORT_ASC, $data);


echo $section_start;

if (file_exists(WB_PATH.'/modules/extcal/user_functions.php'))
        include_once(WB_PATH.'/modules/extcal/user_functions.php');

$counter=0;
foreach($data as $key => $entry){

        // user function hook to modify values of the entry before processing
        if(function_exists('extcal_user_prepare_entry'))
                $entry=extcal_user_prepare_entry($entry);
                
        if((($entry["start"]>=strtotime($starttime))||($entry["end"]>=strtotime($starttime)))
          &&(!array_key_exists("class",$entry["data"])
          ||preg_match("/PRIVATE/i",$entry["data"]["class"])===0)){
                if ( $entry["location"] != "" ){
                        $entry["location"]
                                = $location_start
                                . htmlentities($entry["location"])
                                . $location_end;
                } 
                $start_date=date($dateformat,$entry["start"]);
                $start_time=date($timeformat,$entry["start"]);
                $end_date=date($dateformat,$entry["end"]);
                $end_time=date($timeformat,$entry["end"]);
                if($midnight_fix && date("H:i",$entry["end"])=="00:00"){
                        $end_date=date($dateformat,$entry["end"]-1);
                        $end_time=date($timeformat,$entry["end"]-1);
                }        
                $entry_dateformat=$dateformat." ".$timeformat;

                if($entry["allDay"]){
                        $start_time="";
                        $end_time="";
                }

                if($optimize_date){
                        if($start_date==$end_date){
                                $end_date="";
                        } else {
                                $end_time="";
                        }
                }

                if($entry["description"]!=""){
                        $entry["description"]
                                = $description_start
                                . nl2br(htmlentities($entry["description"]))
                                . $description_end;
                } 

                $date_string=$date_template;
                $date_string = preg_replace("/{START_DATE}/",$start_date,$date_string);
                $date_string = preg_replace("/{END_DATE}/",$end_date,$date_string);
                $date_string = preg_replace("/{START_TIME}/",$start_time,$date_string);
                $date_string = preg_replace("/{END_TIME}/",$end_time,$date_string);
                
                if($optimize_date){
                        $date_string = preg_replace('/\s*{DATE_SEPARATOR}\s*$/',"",$date_string);
                        $date_string = preg_replace('/^\s*/',"",$date_string);
                        // fetch this again for below
                        $end_date=date($dateformat,$entry["end"]);  
                        $end_time=date($timeformat,$entry["end"]);
                        if($midnight_fix && date("H:i",$entry["end"])=="00:00"){
                                $end_date=date($dateformat,$entry["end"]-1);
                                $end_time=date($timeformat,$entry["end"]-1);
                        }        
                        if($entry["allDay"]){
                                $start_time="";
                                $end_time="";
                        }
                }

                $date_string = preg_replace("/{DATE_SEPARATOR}/",$date_separator,$date_string);
                
                if($date_string!="")
                        $date_string
                        = $date_start
                        . $date_string
                        . $date_end;

                if($entry["title"]!="")
                        $entry["title"]
                        = $title_start
                        . htmlentities($entry["title"])
                        . $title_end;        

                if(array_key_exists("class",$entry["data"])
                   && !(preg_match("/CONFIDENTIAL/i",$entry["data"]["class"])===0)){
                        $entry["description"]="";
                        $entry["title"]=$confidential_text;
                }
                
                $output_string = $entry_template;
                
                $placeholders = array (
                        '{DATE}'        => $date_string,
                        '{START_DATE}'        => $start_date,
                        '{END_DATE}'        => $end_date,
                        '{START_TIME}'        => $start_time,
                        '{END_TIME}'        => $end_time,
                        '{DATE_SEPARATOR}' => (($date_string=="")&&($entry["allDay"]))?"":$date_separator,
                        '{LOCATION}'        => $entry["location"],
                        '{TITLE}'        => $entry["title"],
                        '{DESCRIPTION}' => $entry["description"]
                );
                
                // user function hook to process the individual place holders
                if(function_exists('extcal_user_process_placeholders'))
                        $placeholders=extcal_user_process_placeholders($placeholders);
                
                        
                foreach($placeholders as $template_key => $template_value)
                        $output_string = preg_replace("/$template_key/",$template_value,$output_string);
                

                // user function hook to postprocess the whole entry
                if(function_exists('extcal_user_postprocess_entry'))
                        $output_string=extcal_user_postprocess_entry($output_string);

                echo $output_string."\n";
                $counter++;
                if($counter>=$max_entries and $max_entries>0) break;
        }
}

echo $section_end;

date_default_timezone_set($SAVED_TZ);

?>
