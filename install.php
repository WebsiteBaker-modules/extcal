<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.1.3
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


if(defined('WB_URL'))
{

    // Drop preexisting table
    $mod_extcal = "DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_extcal`";
    $database->query($mod_extcal);

    // Create table
    $mod_extcal = "CREATE TABLE IF NOT EXISTS `".TABLE_PREFIX."mod_extcal` ("
        . " `section_id` INT NOT NULL DEFAULT '0',"
        . " `page_id` INT NOT NULL DEFAULT '0',"
        . " `cal_urls` TEXT NOT NULL DEFAULT '',"
        . " `max_entries` INT DEFAULT '0',"
        . " `max_days` INT DEFAULT '0',"
        . " `time_zone` TEXT NOT NULL DEFAULT '',"
        . " `dateformat` TEXT NOT NULL DEFAULT '',"        
        . " `date_end` TEXT NOT NULL DEFAULT '',"         
        . " `section_start` TEXT NOT NULL DEFAULT '',"
        . " `section_end` TEXT NOT NULL DEFAULT '',"
        . " `enable_cache` INT DEFAULT '1',"
        . " `refresh_time` INT DEFAULT '0'," 
        . " `cache_time` INT DEFAULT '0'," 
        . " `description_end` TEXT NOT NULL DEFAULT '',"
        . " `entry_template` TEXT NOT NULL DEFAULT '',"
        . " `description_start` TEXT NOT NULL DEFAULT '',"
        . " `location_start` TEXT NOT NULL DEFAULT '',"
        . " `location_end` TEXT NOT NULL DEFAULT '',"
        . " `title_start` TEXT NOT NULL DEFAULT '',"
        . " `title_end` TEXT NOT NULL DEFAULT '',"
        . " `date_start` TEXT NOT NULL DEFAULT '',"
        . " `confidential_text` TEXT NOT NULL DEFAULT '',"        
        . " `timeformat` TEXT NOT NULL DEFAULT '',"     
        . " `date_separator` TEXT NOT NULL DEFAULT '',"    
        . " `date_template` TEXT NOT NULL DEFAULT '',"    
        . " `optimize_date` INT DEFAULT '1',"
        . " `midnight_fix` INT DEFAULT '1',"
        . " `verify_peer` INT DEFAULT '1',"
        . " `keep_todays_events` INT DEFAULT '1',"
        . " `time_offset` INT DEFAULT '0',"
        . " PRIMARY KEY ( `section_id` )"
        . " ) ENGINE='MyISAM' DEFAULT CHARSET='utf8' COLLATE='utf8_unicode_ci'";
    $database->query($mod_extcal);

//Copy settings files
$mpath = WB_PATH.'/modules/extcal/';

if (!file_exists($mpath.'frontend.css')) { rename($mpath.'default.css', $mpath.'frontend.css') ; }
if (!file_exists($mpath.'user_functions.php')) { rename($mpath.'user_functions.default.php', $mpath.'user_functions.php') ; }

}
