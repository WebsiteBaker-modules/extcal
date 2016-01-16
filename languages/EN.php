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

/*
 -----------------------------------------------------------------------------------------
  ENGLISH LANGUAGE FILE FOR THE  MODULE: External Calendar
 -----------------------------------------------------------------------------------------
*/

// English module description
$module_description = "
<p>
The module External Calendar allows you to include external calendars (DavCAL or ics) into a WebsiteBaker page.
</p>

<p>The calendars are managed my means of usual calendar programs like Outlook, Thunderbird Lightning and similar, or by means of a web-interface of a WebSpace-provider.
The calendar is included with this module into the web page. The focus is not on displaying an online-calendar, but explicitly on displaying the appointments the most homogeneously as possible inside the web page. (If you are looking for a tool to display an external calendar in a week- or month-view you could use php-icalendar and include that one in an iframe page.) </p>  

<p> For configuring the module, simply enter the URL of the ical files or the WebDAV-calendar and the appointments of the calendar appear as a list in the frontend.
The most simple solution is to put your ical files just into the media folder or into the calendars directory of this module and manage them by using the ftp-url out of your client software. However, this only works for a single client where it is ensured that no concurrent access may happen. If you need several accounts and you are looking for a simple WebDAV server you might want to try out Ba&iuml;kal.</p>

<p> In the backend you can configure lots of details about the appearance of the module. The central setting is the textbox where you enter the URLs of your calendars. If a username and password is needed to access your calendar, you have to include these credentials in the URL following the scheme [protocol]://[user]:[password]@[domain]/[path]. <br/>
Keep in mind that only read-access is required. If you have no possibility to share the calendar read-only, you might want to protect your password by restricting the access to the page in the backend. 
Using an https-connection is recommended. In the advanced options you can disable the verification of the server certificate in case it is not signed by a trusted authority (on the other hand renouncing on a verification implies a security risk).
</p>

<p>If the path terminates on &quot;/&quot; the URL is interpreted as CalDAV - otherwise it is assumed that the URL points to an ical-file. Lines starting with '&#35;' are considered commented-out.</p>

<p>The calendar entries can be limited in the sense of how many days in future shall be displayed. Also, you can configure a limit for the number of appointments to show. If you enter a zero for one of these limits, this means  &quot;unlimited&quot;.</p>

<p>The timezone based on which the dates in the calenders are interpreted, can be configured in the backend, too. This is especially important for a correct handling of appointments across daylight-savings. Choose the correct timezone for your country. Do not use something like &quot;UTC+X hours&quot;, because this setting would not be aware of any daylight savings. You can also leave the field empty, then the module tries to determine the time zone from the language global settings of WebsiteBaker (this should work for Germany, England, France and Italy, currently). To reset any of the fields, just enter &quot;{DEFAULT}&quot; and save the settings.</p>

<p>The whole formatting of the appointments is controlled by templates and formatting blocks. Note that some of these settings are hidden in the advanced settings.
There is a template for the whole entry and a special one for the date. In the date template, several place holders can be used:  {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME}, and {DATE_SEPARATOR}. The date format and the time format can be adjusted in the backend. These formats are used to fill the place holders from the data of each appointment. Also, there is a separator, which can be inserted between start and end date. Depending on the type of the entry, the date is displayed in different manners. For allday-entries the start and end time is not displayed at all. The module also tries to optimize the date string. If the start date and the end date are the same, the end date is ommitted. However, if you want to disable this feature, you can do so by unchecking that checkbox. Another checkbox allows you to configure, if the module should subtract one second from end dates at midnight, so that the end of the appointment still belongs to the last (real) day. Finally, the whole string is surrounded by a starting and an end formatting block. That's how the {DATE} block is generated.</p>

<p> The other place holders are more simple. They basically consist of a value which comes out of the appointment and a prefix and a suffix formatting block. This applies for the title of the entry ({TITLE}), the location ({LOCATION}), and the detailled description ({DESCRIPTION}).
If one of the fields is empty, also the prefix and suffix formatting block are suppressed. If you want to avoid this, just enter a space character in the title, the location or the description, respectively.
</p>

<p> Apart from the formatting blocks used in each calendar entry, there are two more formatting blocks for the whole section: One for the begin of the whole &quot;section&quot; (for instance you can add a headline there), and one for the end of the section. In order to add some style definitions for use in these formatting blocks you can add them to the frontend style file of this module directly out of the backend. </p>

<p>The module takes care about the privacy settings of the calendar entries. Appointments marked as private are not displayed at all, whereas confidential appointments are shown with the date only, but without any description. Instead of the title, a fixed text block which can be configured in the backend, is displayed for confidential entries. </p>

<p>Finally, the module contains a configurable internal cache, which can be activated with another checkbox. There are two flavors of the cache: There is a short time cache, which stores the whole calendars for a few seconds up to minutes between accesses of the web page. There is also a long time cache for WebCal-calendars. The latter stores the individual entries of the WebCal-calendar for several days. As long as the entry is not modified online in the WebCal calendar, the entry is loaded from the cache. Both timings of the caches can be configured individually in the backend. At any time you can see how much disk space your cache takes in overall for all instances of the external calendar module, and if required you can clear the cache with a single click.</p>

<p> This module uses SabreDAV and php-curl for accessing WebDAV-URLs and SG-ICalendar for parsing the calendars.</p> 
";

// declare module language array
global $LANG;
$LANG = array();

// Text outputs for the backend
$LANG['backend'] = array(
        'TXT_EXTCAL_SETTINGS'                         => "Settings for the external calendar - enter {DEFAULT} to reset any field to its default value",
        'TXT_EXTCAL_SETTINGS_URLS'                 => "Enter the URLs of your calendars to display here, one line per URL",
        'TXT_EXTCAL_MAX_DAYS'                        => "show that many days in advance (0 = no limit)",
        'TXT_EXTCAL_MAX_ENTRIES'                 => "show that many entries at maximum (0 = no limit)",
        'TXT_EXTCAL_TIME_ZONE'                         => "time zone to display entries (empty = default time zone)",
        'TXT_EXTCAL_DATEFORMAT'                        => "the date format (without time)",
        'TXT_EXTCAL_TIMEFORMAT'                 => "the time format (unless it's an allday-appointment)",
        'TXT_EXTCAL_DATE_SEPARATOR'                => "the separator used between start and end date or time",
        'TXT_EXTCAL_SECTION_START'                => "formatting for the beginning of the whole section (e.g. headline)",
        'TXT_EXTCAL_DATE_END'                         => "formatting at the end of the date (appended to {DATE})",
        'TXT_EXTCAL_SECTION_END'                => "formatting for the end of the whole section",
        'TXT_EXTCAL_CACHE_SIZE'                        => "Cache currently used for CalDAV entries",
        'TXT_EXTCAL_EMPTY_CACHE'                => "Clear cache",
        'TXT_EXTCAL_ENABLE_CACHE'                => "Enable cache",
        'TXT_EXTCAL_REFRESH_TIME'                      => "Refresh time for the whole calendars between a few calls of the site in seconds",
        'TXT_EXTCAL_CACHE_TIME'                        => "Cache time for calendar entries which are not modified in days",
        'TXT_EXTCAL_DESCRIPTION_END'             => "formatting of the end of the detailed description (appended to {DESCRIPTION})",
        'TXT_EXTCAL_HELP_PAGE'                        => "Help page",
        'TXT_EXTCAL_CACHE_EMPTY'                => "Cache empty",        
        'TXT_EXTCAL_ENTRY_TEMPLATE'                => "in the following template you can set up the appearance of each calendar entry. Possible place holders are {DATE}, {TITLE}, {LOCATION}, and {DESCRIPTION}. Instead of the date you can also use {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME}, and {DATE_SEPARATOR} here. The opening and closing blocks defined above are inserted around each of these placeholders provided that this string is not empty for the current entry.",

        'TXT_EXTCAL_DESCRIPTION_START'             => "formatting of the beginning of the description (prepended to {DESCRIPTION})",
        'TXT_EXTCAL_LOCATION_START'                => "formatting at the beginning of a location (prepended to {LOCATION})",
        'TXT_EXTCAL_LOCATION_END'                => "formatting at the end of a location (appended to {LOCATION})",
        'TXT_EXTCAL_TITLE_START'                => "formatting at the beginning of a title (prepended to {TITLE})",
        'TXT_EXTCAL_TITLE_END'                        => "formatting at the end of a title (appended to {TITLE})",
        'TXT_EXTCAL_DATE_START'                        => "formatting at the beginning of the date (prepended to {DATE})",
        'TXT_EXTCAL_CONFIDENTIAL_TEXT'                 => "text displayed as description for confidential entries (including the opening and closing tags if you would like to have those around that text)",
        'TXT_EXTCAL_DATE_TEMPLATE'                 => "in the following template you can fine-tune the appearance of the date. Possible place holders are {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME}, and {DATE_SEPARATOR}.  The latter and the opening and closing blocks, are wrapped around the result of this template, are defined above.",
        'TXT_EXTCAL_OPTIMIZE_DATE'                => "try to optimize the date output (e.g. drop end date if it is on the same day)",
        'TXT_EXTCAL_MIDNIGHT_FIX'                => "squeeze appointments ending at midnight into the day before",
        'TXT_EXTCAL_VERIFY_PEER'                => "verify ssl-certificates for https-connections (security risk if unchecked)",

);

$LANG['frontend'] = array(
        'MOD_EXTCAL_TIMEZONE'                         => "Europe/London",
        'MOD_EXTCAL_DATEFORMAT'                        => "m/d/Y",
        'MOD_EXTCAL_TIMEFORMAT'                 => "H:i",
        'MOD_EXTCAL_DATE_SEPARATOR'                => " - ",
        'MOD_EXTCAL_SECTION_START'                => "<div class=\"extcal\">\n",
        'MOD_EXTCAL_DATE_END'                         => "</div>\n",
        'MOD_EXTCAL_SECTION_END'                => "</div>\n",
        'MOD_EXTCAL_DESCRIPTION_END'                => "</div>\n",
        'MOD_EXTCAL_ENTRY_TEMPLATE'                => "<div class=\"extcal-entry\">\n   {DATE} {LOCATION} {TITLE}\n</div>",
        'MOD_EXTCAL_DESCRIPTION_START'             => "\n<div class=\"extcal-description\">",
        'MOD_EXTCAL_LOCATION_START'                => "<div class=\"extcal-location\">",
        'MOD_EXTCAL_LOCATION_END'                => "</div>\n",
        'MOD_EXTCAL_TITLE_START'                => "<div class=\"extcal-title\">",
        'MOD_EXTCAL_TITLE_END'                        => "</div>\n",
        'MOD_EXTCAL_DATE_START'                        => "<div class=\"extcal-date\">",
        'MOD_EXTCAL_CONFIDENTIAL_TEXT'                 => "-",
        'MOD_EXTCAL_DATE_TEMPLATE'                => "{START_DATE} {START_TIME} {DATE_SEPARATOR} {END_DATE}",
        
);

?>

