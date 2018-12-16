<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.2.6
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2018, Martin Hecht (mrbaseman)
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl
 *
 **/

require('../../config.php');

$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );


// Include WB admin wrapper script
$admin_header = FALSE;
require(WB_PATH.'/modules/admin.php');
$admin->print_header();

$back=$TEXT['BACK'];

echo "
<!-- BEGIN main_block -->
<form action=\"".ADMIN_URL."/pages/modify.php\">
<input type=\"hidden\" name=\"page_id\" value=\"$page_id\" />

$module_description

<div align=center>
<input type=\"submit\" value=\"$back\" style=\"width: 100px; margin-top: 5px;\" />
</div>
</form>
<p>&nbsp;</p>
<!-- END main_block -->
";

// Print admin footer
$admin->print_footer();
