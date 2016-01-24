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


# usage example: 
# $S=WebDAVFetch('http://user:password@www.example.com/path/to/calendar/');
# 

include_once('SabreDAV/vendor/autoload.php');

function WebDAVFetch ($URL,$enable_cache,$cache_time,$verify_peer){

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

        if(!$verify_peer)$client->addCurlSetting(CURLOPT_SSL_VERIFYPEER, FALSE);
        if(array_key_exists('HTTP_USER_AGENT', $_SERVER))
                $client->addCurlSetting(CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                else $client->addCurlSetting(CURLOPT_USERAGENT, 'Curl');
        
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
