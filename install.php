<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.1.9
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2018, Martin Hecht (mrbaseman)
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl
 *
 **/


/* -------------------------------------------------------- */
// Must include code to stop this file being accessed directly
if(defined('WB_PATH') == false) { die('Illegale file access /'.basename(__DIR__).'/'.basename(__FILE__).''); }
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
        . " `cal_urls` TEXT NOT NULL,"
        . " `max_entries` INT DEFAULT '0',"
        . " `max_days` INT DEFAULT '0',"
        . " `time_zone` TEXT NOT NULL,"
        . " `dateformat` TEXT NOT NULL,"
        . " `date_end` TEXT NOT NULL,"
        . " `section_start` TEXT NOT NULL,"
        . " `section_end` TEXT NOT NULL,"
        . " `enable_cache` INT DEFAULT '1',"
        . " `refresh_time` INT DEFAULT '0',"
        . " `cache_time` INT DEFAULT '0',"
        . " `description_end` TEXT NOT NULL,"
        . " `entry_template` TEXT NOT NULL,"
        . " `description_start` TEXT NOT NULL,"
        . " `location_start` TEXT NOT NULL,"
        . " `location_end` TEXT NOT NULL,"
        . " `title_start` TEXT NOT NULL,"
        . " `title_end` TEXT NOT NULL,"
        . " `date_start` TEXT NOT NULL,"
        . " `confidential_text` TEXT NOT NULL,"
        . " `timeformat` TEXT NOT NULL,"
        . " `date_separator` TEXT NOT NULL,"
        . " `date_template` TEXT NOT NULL,"
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
