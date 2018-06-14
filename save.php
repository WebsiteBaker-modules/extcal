<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.2.0
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2018, Martin Hecht (mrbaseman)
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl
 *
 **/

require('../../config.php');


// suppress to print the header, so no new FTAN will be set
$admin_header = false;
// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

if (!$admin->checkFTAN())
{
        $admin->print_header();
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
        $admin->print_footer();
        exit();
} else {
        $admin->print_header();
}



$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );

if (isset($_POST['cmd_empty'])) {
    $list = glob(dirname(__FILE__).'/cache/*.ics');
    if ($list)
        foreach ($list as $file_name)
            if (strrchr($file_name,'.')!='.')
                unlink($file_name);
    $admin->print_success(
        $LANG['backend']['TXT_EXTCAL_CACHE_EMPTY'],
            ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
} else {


// Update the mod_extcal table with the contents
if(isset($_POST['cal_urls'])) {
    $tags                  = array('<?php', '<?script', '?>' , '<?', '<?=');
    $cal_urls              = $admin->add_slashes(str_replace($tags, '', $_POST['cal_urls']));
    $max_days              = intval($_POST['max_days']) or $max_days = 0;
    if($_POST['max_days']==="{DEFAULT}")$max_days=365;
    $max_entries           = intval($_POST['max_entries']) or $max_entries = 0;
    if($_POST['max_entries']==="{DEFAULT}")$max_entries=50;
    $time_zone             = $admin->add_slashes(str_replace($tags, '', $_POST['time_zone']));
    $dateformat            = $admin->add_slashes(str_replace($tags, '', $_POST['dateformat']));
    $date_end              = $admin->add_slashes(str_replace($tags, '', $_POST['date_end']));
    $section_start         = $admin->add_slashes(str_replace($tags, '', $_POST['section_start']));
    $section_end           = $admin->add_slashes(str_replace($tags, '', $_POST['section_end']));
    $enable_cache          = isset($_POST['enable_cache']) ? 1 : 0;
    $refresh_time          = intval($_POST['refresh_time']) or $refresh_time = 0;
    if($_POST['refresh_time']==="{DEFAULT}")$refresh_time=300;
    $cache_time            = intval($_POST['cache_time']) or $cache_time = 0;
    if($_POST['cache_time']==="{DEFAULT}")$cache_time=7;
    $description_end       = $admin->add_slashes(str_replace($tags, '', $_POST['description_end']));
    $entry_template        = $admin->add_slashes(str_replace($tags, '', $_POST['entry_template']));
    $description_start     = $admin->add_slashes(str_replace($tags, '', $_POST['description_start']));
    $location_start        = $admin->add_slashes(str_replace($tags, '', $_POST['location_start']));
    $location_end          = $admin->add_slashes(str_replace($tags, '', $_POST['location_end']));
    $title_start           = $admin->add_slashes(str_replace($tags, '', $_POST['title_start']));
    $title_end             = $admin->add_slashes(str_replace($tags, '', $_POST['title_end']));
    $date_start            = $admin->add_slashes(str_replace($tags, '', $_POST['date_start']));
    $confidential_text     = $admin->add_slashes(str_replace($tags, '', $_POST['confidential_text']));
    $timeformat            = $admin->add_slashes(str_replace($tags, '', $_POST['timeformat']));
    $date_separator        = $admin->add_slashes(str_replace($tags, '', $_POST['date_separator']));
    $date_template         = $admin->add_slashes(str_replace($tags, '', $_POST['date_template']));
    $optimize_date         = isset($_POST['optimize_date']) ? 1 : 0;
    if($_POST['optimize_date']==="{DEFAULT}")$optimize_date=1;
    $midnight_fix          = isset($_POST['midnight_fix']) ? 1 : 0;
    if($_POST['midnight_fix']==="{DEFAULT}")$midnight_fix=1;
    $verify_peer           = isset($_POST['verify_peer']) ? 1 : 0;
    if($_POST['verify_peer']==="{DEFAULT}")$verify_peer=1;
    $keep_todays_events    = isset($_POST['keep_todays_events']) ? 1 : 0;
    if($_POST['keep_todays_events']==="{DEFAULT}")$keep_todays_events=1;
    $time_offset           = intval($_POST['time_offset']) or $time_offset = 0;
    if($_POST['time_offset']==="{DEFAULT}")$time_offset=0;
    $calendar_start        = $admin->add_slashes(str_replace($tags, '', $_POST['calendar_start']));
    $calendar_end          = $admin->add_slashes(str_replace($tags, '', $_POST['calendar_end']));

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
        . " `optimize_date` = '$optimize_date',"
        . " `midnight_fix` = '$midnight_fix',"
        . " `verify_peer` = '$verify_peer',"
        . " `keep_todays_events` = '$keep_todays_events',"
        . " `time_offset` = '$time_offset',"
        . " `calendar_start` = '$calendar_start',"
        . " `calendar_end` = '$calendar_end' "
        . " WHERE `section_id` = '$section_id'";
    $database->query($query);
}

// Check if there is a database error, otherwise say successful
if($database->is_error()) {
    $admin->print_error($database->get_error(), $js_back);
} else {
    $admin->print_success($MESSAGE['PAGES']['SAVED'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}
}

// Print admin footer
$admin->print_footer();
