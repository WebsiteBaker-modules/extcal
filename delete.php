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


// Delete record from the database
$query = "DELETE FROM `".TABLE_PREFIX."mod_extcal` "
        . "WHERE `section_id` = '$section_id'";

$database->query($query);

