<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @authors         Martin Hecht
 * @copyright       2004-2015, Website Baker Org. e.V.
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl 
 *
*/


/* -------------------------------------------------------- */
// Must include code to stop this file being accessed directly
if(!defined('WB_PATH')) {
        // Stop this file being access directly
        die('<head><title>Access denied</title></head><body><h2 style="color:red;margin:3em auto;text-align:center;">Cannot access this file directly</h2></body></html>');
}
/* -------------------------------------------------------- */



// these fields should be there - add them to the array and the upgrade script creates them

$MY_DB_FIELDS=array(
        "cal_urls"                        => "TEXT NOT NULL DEFAULT '".$example_url."'",
        "max_entries"                        => "INT DEFAULT '0'",
        "max_days"                        => "INT DEFAULT '0'",
        "time_zone"                        => "TEXT NOT NULL DEFAULT ''",
        "dateformat"                         => "TEXT NOT NULL DEFAULT ''",                
        "date_end"                         => "TEXT NOT NULL DEFAULT ''",                 
        "section_start"                        => "TEXT NOT NULL DEFAULT ''",                
        "section_end"                         => "TEXT NOT NULL DEFAULT ''",                
        "enable_cache"                         => "INT DEFAULT '1'",                
        "refresh_time"                         => "INT DEFAULT '0'", 
        "cache_time"                         => "INT DEFAULT '0'", 
        "description_end"                 => "TEXT NOT NULL DEFAULT ''",
        "entry_template"                => "TEXT NOT NULL DEFAULT ''",
        "description_start"             => "TEXT NOT NULL DEFAULT ''",
        "location_start"                => "TEXT NOT NULL DEFAULT ''",
        "location_end"                    => "TEXT NOT NULL DEFAULT ''",
        "title_start"                        => "TEXT NOT NULL DEFAULT ''",
        "title_end"                            => "TEXT NOT NULL DEFAULT ''",
        "date_start"                    => "TEXT NOT NULL DEFAULT ''",
        "confidential_text"                => "TEXT NOT NULL DEFAULT ''",
        "timeformat"                         => "TEXT NOT NULL DEFAULT ''",         
        "date_separator"                => "TEXT NOT NULL DEFAULT ''",        
        "date_template"                        => "TEXT NOT NULL DEFAULT ''",        
        "optimize_date"                 => "INT DEFAULT '1'",                
        "midnight_fix"                         => "INT DEFAULT '1'",                
        "verify_peer"                         => "INT DEFAULT '1'"                
);


// when fields become obsolete, just copy them from above into this array

$MY_OBSOLETE_DB_FIELDS=array(
        "location"                      => "TEXT NOT NULL DEFAULT ''",
        "location_separator"                 => "TEXT NOT NULL DEFAULT ''",
        "entry_start"                         => "TEXT NOT NULL DEFAULT ''",
        "entry_end"                         => "TEXT NOT NULL DEFAULT ''",
        "confidential_separator"        => "TEXT NOT NULL DEFAULT ''",
        "description_separator"         => "TEXT NOT NULL DEFAULT ''",
        "show_location"                 => "INT DEFAULT '1'", 
        "show_description"                 => "INT DEFAULT '0'", 
        "allday_dateformat"                 => "TEXT NOT NULL DEFAULT ''",         
        "multiday_separator"                => "TEXT NOT NULL DEFAULT ''",        
);



$msg = '';
$sTable = TABLE_PREFIX.'mod_extcal';
if(($sOldType = $database->getTableEngine($sTable))) {
        if(('myisam' != strtolower($sOldType))) {
                $query='ALTER TABLE `'.$sTable.'` Engine = \'MyISAM\' ';
                if(!$database->query($query)) {
                        $msg = $database->get_error();
                }
        }
} else {
        $msg = $database->get_error();
}

$example_url=WB_URL.__FILE__;
$example_url=preg_replace('/upgrade.php$/',"calendars/example.ics",$example_url);



// assuming section_id and page_id always exist
$prev_field="page_id";

// If not already there, add new fields to the existing settings table
$table_name = TABLE_PREFIX .'mod_extcal';

print "<div><h4>checkig presence of fields in database table</h4>\n";

$new_fields=array();

foreach($MY_DB_FIELDS as $field_name => $description){

        if ( ($database->field_exists($table_name,$field_name) )) {
                 print "."; // "field `$field_name` already updated<br />\n";
                 $new_fields[$field_name]=0;
        } else {
                if($database->field_add($table_name,$field_name,$description.' AFTER `'.$prev_field.'`' )) {
                      print "+";  // print "Added new field `$field_name` successfully<br />";
                      $new_fields[$field_name]=1;
                } else {
                        $admin->print_error( $database->get_error() );
                }
        }
        $prev_field=$field_name;
}

print " ready. </div>";



print "<div><h4>converting database entries</h4>\n";
$query="SELECT `section_id`";
$fields_to_save=array();

// find out which of the fields used in the past are present in the database 

foreach($MY_OBSOLETE_DB_FIELDS as $field_name => $description){

        if ( ($database->field_exists($table_name,$field_name) )) {
                print "+";
                $query .= ", `".$field_name."`";
                $fields_to_save["$field_name"]=1;
        } else {
                $fields_to_save["$field_name"]=0;
                print ".";
        }
}

print " ";



// fetch the currently used ones as well - we may have to fill in default values

foreach($MY_DB_FIELDS as $field_name => $description){
        if ( ($database->field_exists($table_name,$field_name) )) {
                print ".";
                $query .= ", `".$field_name."`";
        } else {
                print "!";  // this should never happen
        }

}

$query .= " FROM `".TABLE_PREFIX."mod_extcal`";
$get_content = $database->query($query);
print " ";


$TRANSFORM_TO_TEMPLATE=$new_fields["entry_template"];



while( $fetch_content = $get_content->fetchRow() ) {

        $section_id = $fetch_content['section_id'];
        
        // this is basically from view.php

        $location = $fetch_content['location'];
        $location_separator = $fetch_content['location_separator'];
        $entry_start = $fetch_content['entry_start'];
        $entry_end = $fetch_content['entry_end'];
        $confidential_separator = $fetch_content['confidential_separator'];
        $description_separator = $fetch_content['description_separator'];
        $show_location = $fetch_content['show_location'];
        $show_description = $fetch_content['show_description'];
        $allday_dateformat = $fetch_content['allday_dateformat'];
        $multiday_separator = $fetch_content['multiday_separator'];

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
        $cache_time = intval($fetch_content['cache_time']);
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


        // initialize new fields
        
        if($new_fields["description_start"]==1)
                $description_start="{DEFAULT}";     
        
        if($new_fields["location_end"]==1)
                $location_end="{DEFAULT}";     
        
        if($new_fields["location_start"]==1)
                $location_start="{DEFAULT}";     
   
        if($new_fields["title_start"]==1)
                $title_start="{DEFAULT}";     
        
        if($new_fields["title_end"]==1)
                $title_end="{DEFAULT}";     
        
        if($new_fields["date_start"]==1)
                $date_start="{DEFAULT}";     
    
        if($new_fields["confidential_text"]==1)
                $confidential_text="{DEFAULT}";     
        
        if($new_fields["entry_template"]==1)
                $entry_template="{DEFAULT}";     

        if($new_fields["timeformat"]==1)
                $timeformat="{DEFAULT}";     

        if($new_fields["date_separator"]==1)
                $date_separator="{DEFAULT}";     

        if($new_fields["date_template"]==1)
                $date_template="{DEFAULT}";     

        if($new_fields["optimize_date"]==1)
                $optimize_date="1";     

        if($new_fields["midnight_fix"]==1)
                $midnight_fix="1";     

        if($new_fields["verify_peer"]==1)
                $verify_peer="1";     

        // if entry_template is new tranform empty strings to default settings
        if($TRANSFORM_TO_TEMPLATE) {
        
                // the deprecated ones:
        
                if($location === "" or $location===NULL)
                        $location="{DEFAULT}";

                if($location_separator === "" or $location_separator===NULL)
                        $location_separator="{DEFAULT}";

                if($entry_start === "" or $entry_start===NULL)
                        $entry_start="{DEFAULT}";

                if($entry_end === "" or $entry_end===NULL)
                        $entry_end="{DEFAULT}";

                if($confidential_separator === "" or $confidential_separator===NULL)
                        $confidential_separator="{DEFAULT}";

                if($description_separator === "" or $description_separator===NULL)
                        $description_separator="{DEFAULT}";
                        
                // now the ones which stay

                if($time_zone === "" or $time_zone===NULL)
                        $time_zone="{DEFAULT}";

                if($dateformat === "" or $dateformat===NULL)
                        $dateformat="{DEFAULT}";

                if($date_end === "" or $date_end===NULL)
                        $date_end="</h4><p>";  // this was the old default

                if($section_start === "" or $section_start===NULL)
                        $section_start="{DEFAULT}";

                if($section_end === "" or $section_end===NULL)
                        $section_end="{DEFAULT}";

                if($description_end === "" or $description_end===NULL)
                        $description_end="{DEFAULT}";
                        
                // now the new fields

                if($entry_template === "" or $entry_template===NULL)
                        $entry_template="{DEFAULT}";

                if($description_start === "" or $description_start===NULL)
                        $description_start="{DEFAULT}";

                if($location_start === "" or $location_start===NULL)
                        $location_start="{DEFAULT}";

                // location_end will be filled below
                
                if($title_start === "" or $title_start===NULL)
                        $title_start="{DEFAULT}";

                if($title_end === "" or $title_end===NULL)
                        $title_end="{DEFAULT}";

                if($date_start === "" or $date_start===NULL)
                        $date_start="";  // this must be consistent with the old date_end and the template

                // confidential_text will be filled below

                if($date_template === "" or $date_template===NULL)
                        $date_template="{DEFAULT}";

        }


        
        // save old fields and transfer to the new ones

        if($fields_to_save["location"]==1)
                $location_end=$location;
        
        if($fields_to_save["location_separator"]==1)
                $location_end=$location_separator;
        
        if($fields_to_save["confitential_separator"]==1)
                $confidential_text=$confidential_separator;

        $descr_str="";
        if($show_description)
                $descr_str="{DESCRIPTION}";
        $loc_str="";
        if($show_location)
                $loc_str="{LOCATION}";
        if(($fields_to_save["entry_start"]==1)&&($fields_to_save["entry_end"]==1))
                $entry_template="$entry_start {DATE}\n$loc_str {TITLE}\n$descr_str $entry_end";

        if($fields_to_save["allday_dateformat"]==1){
                $timeformat=preg_replace('/\s*'.$allday_dateformat.'\s*/',"",$dateformat);
                $dateformat=$allday_dateformat;
        }
        
        if($fields_to_save["multiday_separator"]==1)
                $date_separator=$multiday_separator;

        // and this is more or less from save.php 

        $cal_urls = $admin->add_slashes($cal_urls);
        $max_entries = $admin->add_slashes($max_entries);
        $max_days = $admin->add_slashes($max_days);
        $time_zone = $admin->add_slashes($time_zone);
        $dateformat = $admin->add_slashes($dateformat);
        $date_end = $admin->add_slashes($date_end);
        $section_start = $admin->add_slashes($section_start);
        $section_end = $admin->add_slashes($section_end);
        $enable_cache = $admin->add_slashes($enable_cache);
        $refresh_time = $admin->add_slashes($refresh_time);
        $cache_time = $admin->add_slashes($cache_time);
        $description_end = $admin->add_slashes($description_end);
        $entry_template = $admin->add_slashes($entry_template);
        $description_start = $admin->add_slashes($description_start);
        $location_start = $admin->add_slashes($location_start);
        $location_end = $admin->add_slashes($location_end);
        $title_start = $admin->add_slashes($title_start);
        $title_end = $admin->add_slashes($title_end);
        $date_start = $admin->add_slashes($date_start);
        $confidential_text = $admin->add_slashes($confidential_text);
        $timeformat = $admin->add_slashes($timeformat);
        $date_separator = $admin->add_slashes($date_separator);
        $date_template = $admin->add_slashes($date_template);
        $optimize_date = $admin->add_slashes($optimize_date);
        
        $query = "UPDATE `".TABLE_PREFIX."mod_extcal`"
                . " SET `cal_urls` = '$cal_urls',"
                . " `max_entries` = '$max_entries',"
                . " `max_days` = '$max_days',"
                . " `time_zone` = '$time_zone',"
                . " `dateformat` = '$dateformat',"
                . " `date_end` = '$date_end',"
                . " `section_start` = '$section_start',"
                . " `section_end` = '$section_end',"
                . " `enable_cache` = '$enable_cache',"
                . " `refresh_time` = '$refresh_time',"
                . " `cache_time` = '$cache_time',"
                . " `description_end` = '$description_end',"
                . " `entry_template` = '$entry_template',"
                . " `description_start` = '$description_start',"
                . " `location_start` = '$location_start',"
                . " `location_end` = '$location_end',"
                . " `title_start` = '$title_start',"
                . " `title_end` = '$title_end',"
                . " `date_start` = '$date_start',"
                . " `confidential_text` = '$confidential_text',"
                . " `timeformat` = '$timeformat',"
                . " `date_separator` = '$date_separator',"
                . " `date_template` = '$date_template',"
                . " `optimize_date` = '$optimize_date' "
                . " WHERE `section_id` = '$section_id'";
        $database->query($query);        

        if($TRANSFORM_TO_TEMPLATE) print "+";
                else print ".";

}



print "<div><h4>removing obsolete fields from database table</h4>\n";

foreach($MY_OBSOLETE_DB_FIELDS as $field_name => $description){

        if ( ($database->field_exists($table_name,$field_name) )) {
                if(($database->field_remove($table_name,$field_name)) ){
                      print "-";  // print "Removed obsolete field `$field_name` successfully<br />";
                } else {
                        $admin->print_error( $database->get_error() );
                }
        } else {
                 print "."; // "field `$field_name` already removed<br />\n";
        }
        $prev_field=$field_name;
}

print " ready. </div>";


print "<div><h4>finishing update process</h4>\n";


// the following forces a rebuild of the table to free up the storage
// occupied by the columns we have deleted before:

if(!$database->query('ALTER TABLE `'.$table_name.'` Engine = \'MyISAM\' ')) {
        $admin->print_error( $database->get_error() );
}

print " ready. </div>";



