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


# usage example: 
# $S=WebDAVFetch('http://user:password@www.example.com/path/to/calendar/');
# 

include_once('SabreDAV/vendor/autoload.php');

function WebDAVFetch ($URL,$enable_cache,$cache_time){

        $parts=parse_url($URL);

        $location=$parts['scheme'].'://'.$parts['host'].$parts['path'];

        if(!array_key_exists('host',$parts)){$parts['host']=$parts['path'];$parts['path']='/';};
        if(!array_key_exists('scheme',$parts))$parts['scheme']='http';
        if(!array_key_exists('path',$parts))$parts['path']='/';

        $location=$parts['scheme'].'://'.$parts['host'].$parts['path'];

        $settings = array( 'baseUri' => $location );

        if (array_key_exists('user',$parts)) $settings['userName'] =  $parts['user'];
        if (array_key_exists('pass',$parts)) $settings['password'] =  $parts['pass'];

        $client = new Sabre\DAV\Client($settings);

        $entries=$client->propfind(
                '',
                array(
                        '{DAV:}getetag',
                        '{DAV:}getcontenttype',
                        '{DAV:}getlastmodified'
                ), 
                1
        );

        $RET="";

        foreach ($entries as $ICS => $properties){
                $cachefile=preg_replace('/\.ics\.ics/','.ics',dirname(__FILE__)."/cache/".preg_replace('/\//','_',$ICS).".ics");
                if ( array_key_exists('{DAV:}getcontenttype',$properties)
                && preg_match('/calendar/i',$properties['{DAV:}getcontenttype'])>0){
                        if ($enable_cache
                            && ($cache_time > 0)
                            && file_exists($cachefile) 
                            && (strtotime($properties['{DAV:}getlastmodified']) < filemtime($cachefile))
                            && time() - filemtime($cachefile) < $cache_time ){
                                $entry=file_get_contents($cachefile);
                        } else {
                                $entry=$client->request('GET',$ICS)['body'];
                                if($enable_cache)file_put_contents($cachefile,$entry);
                        }
                        $RET.=$entry."\n\n";
                  }
        }
        // workaround for start dates before 1970
        // $RET = preg_replace("/DTSTART;VALUE=DATE:19[0-6]/","DTSTART;VALUE=DATE:197",$RET);
        return $RET;
}


?>
