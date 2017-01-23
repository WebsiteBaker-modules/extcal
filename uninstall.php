<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.1.8
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2017, Martin Hecht (mrbaseman)
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
        if(!headers_sent()) header("Location: ../index.php",TRUE,301);
        die('<head><title>Access denied</title></head><body><h2 style="color:red;margin:3em auto;text-align:center;">Cannot access this file directly</h2></body></html>');
}
/* -------------------------------------------------------- */


// Drop table
$mod_extcal = "DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_extcal`";
$database->query($mod_extcal);

