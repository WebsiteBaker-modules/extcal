<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         0.9.6
 * @authors         Martin Hecht
 * @copyright       2004-2015, Website Baker Org. e.V.
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
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


$example_url=WB_URL."/modules/extcal/calendars/example.ics";


// Insert an extra row into the database
$query = "INSERT INTO `".TABLE_PREFIX."mod_extcal`"
         . " SET `page_id` = '$page_id',"
         . " `section_id` = '$section_id',"
         . " `cal_urls` = '$example_url',"
         . " `max_entries` = '50',"
         . " `max_days` = '365',"
         . " `time_zone` = '{DEFAULT}',"
         . " `dateformat` = '{DEFAULT}',"
         . " `date_end` = '{DEFAULT}',"
         . " `section_start` = '{DEFAULT}',"
         . " `section_end` = '{DEFAULT}',"
         . " `enable_cache` = '1',"
         . " `refresh_time` = '300',"
         . " `cache_time` = '7',"
         . " `description_end` = '{DEFAULT}',"
         . " `entry_template` = '{DEFAULT}',"
         . " `description_start` = '{DEFAULT}',"
         . " `location_start` = '{DEFAULT}',"
         . " `location_end` = '{DEFAULT}',"
         . " `title_start` = '{DEFAULT}',"
         . " `title_end` = '{DEFAULT}',"
         . " `date_start` = '{DEFAULT}',"
         . " `confidential_text` = '{DEFAULT}',"
         . " `timeformat` = '{DEFAULT}',"
         . " `date_separator` = '{DEFAULT}',"
         . " `date_template` = '{DEFAULT}',"
         . " `optimize_date` = '1',"
         . " `midnight_fix` = '1',"
         . " `verify_peer` = '1'";


$database->query($query);

