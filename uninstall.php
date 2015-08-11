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
 * @requirements    PHP 5.2.2 and higher
 *
*/


/* -------------------------------------------------------- */
// Must include code to stop this file being accessed directly
if(!defined('WB_PATH')) {
        require_once(dirname(dirname(__FILE__)).'/framework/globalExceptionHandler.php');
        throw new IllegalFileException();
}
/* -------------------------------------------------------- */


// Drop table
$mod_extcal = "DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_extcal`";
$database->query($mod_extcal);

