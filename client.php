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
    $client->addCurlSetting(CURLOPT_USERAGENT, 'Extcal');

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


function curl_get_copy($URL='',$target_file='',$verify_peer=TRUE){

    $parts=parse_url($URL);

    $location=$parts['scheme'].'://'.$parts['host'].$parts['path'];

    if(!array_key_exists('host',$parts)){$parts['host']=$parts['path'];$parts['path']='/';};
    if(!array_key_exists('scheme',$parts))$parts['scheme']='http';
    if(!array_key_exists('path',$parts))$parts['path']='';

    $location=$parts['scheme'].'://'.$parts['host'].$parts['path'];

    $userpwd='';

    if (array_key_exists('user',$parts)) $userpwd =  $parts['user'];
    if (array_key_exists('pass',$parts)) $userpwd =  $userpwd.":".$parts['pass'];

    $ch = curl_init();

    $fp = fopen($target_file, "w");
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);


    if(!$verify_peer)  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_URL,$location);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Extcal');
    curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
    $contents=curl_exec($ch);

    fwrite($fp, $contents);

    curl_close($ch);
    fclose($fp);
    return TRUE;
}



function get_copy($fURI='', $target_file='',$verify_peer=TRUE)
{
// $fURI:     URL to a file located on a web server
// $target_file:    Path to a local file

if ( file_exists( $target_file ) ) {
    $ifmodhdr = 'If-Modified-Since: '.date( "r", filemtime( $target_file ) )."\r\n";
}
else {
    $ifmodhdr = '';
}

// set request header for GET with referrer for modified files, that follows redirects
$arrRequestHeaders = array(
    'http'=>array(
    'method'    =>'GET',
    'protocol_version'    =>1.1,
    'follow_location'    =>1,
    'header'=>    "User-Agent: Extcal\r\n" .
        $ifmodhdr
        )
    );
if((strpos($fURI,'https')===0)&&(!$verify_peer))
    $arrRequestHeaders['ssl']=array('verify_peer'   => FALSE);

$rc = copy( $fURI, $target_file, stream_context_create($arrRequestHeaders) );

// HTTP request completed, preserve system error, if any
if( $rc ) {
    if ( fclose( $rc ) ) {
    unset( $err );
    }
    else {
    $err = error_get_last();
    }
}
else {
    $err = error_get_last();
}

// Parse HTTP Response Headers for  HTTP Status, as well filename, type, date information
// Need to start from rear, to get last set of headers after possible sets of redirection headers
if ( $http_response_header ) {
    for ( $i = sizeof($http_response_header) - 1; $i >= 0; $i-- ) {
    if ( preg_match('@^http/\S+ (\S{3,}) (.+)$@i', $http_response_header[$i], $http_status) > 0 ) {
        // HTTP Status header means we have reached beginning of response headers for last request
        break;
    }
    elseif ( preg_match('@^(\S+):\s*(.+)\s*$@', $http_response_header[$i], $arrHeader) > 0 ) {
        switch ( $arrHeader[1] ) {
        case 'Last-Modified':
            if ( !isset($http_content_modtime) ) {
            $http_content_modtime = strtotime( $arrHeader[2] );
            }
            break;
        case 'Content-Type':
            // skip type checking - maybe we include it later
            break;
        case 'Content-Disposition':
            if ( !isset($http_content_filename) && preg_match('@filename\\s*=\\s*(?|"([^"]+)"|([\\S]+));?@ims', $arrHeader[2], $arrTokens) > 0 ) {
            $http_content_filename = basename($arrTokens[1]);
            }
            break;
        }
    }
    }
}

if ( $http_status ) {
    // Make sure we have good HTTP Status
    switch ( $http_status[1] ) {
    case '200':
        // SUCCESS: HTTP Status is "200 OK"
        break;
    case '304':
        // throw new Exception( "Remote file not newer: $fURI", $http_status[1] );
        return "Remote file not newer: $fURI $http_status[1]";
        break;
    case '404':
        // throw new Exception( "Remote file not found: $fURI", $http_status[1] );
        return "Remote file not found: $fURI $http_status[1]";
        break;
    default:
        // throw new Exception( "HTTP Error, $http_status[2], accessing $fURI", $http_status[1] );
        return "HTTP Error, $http_status[2], accessing $fURI, $http_status[1]";
        break;
    }
}
elseif ( $err ) {
    // Protocol / Communication error
    // throw new Exception( $err['message']/*."; Remote file: $fURI"*/, $err['type'] );
    return $err['message']/*."; Remote file: $fURI"*/ . $err['type'];
} else {
    // No HTTP status and no error
    // throw new customException( "Unknown HTTP response accessing $fURI: $http_response_header[0]", -1 );
    return "Unknown HTTP response accessing $fURI: $http_response_header[0]";
}
return TRUE;
}
