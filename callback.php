<?

// requires PHP lastfmapi
require 'lastfmapi/lastfmapi.php';

$vars = array(
        'apiKey' => 'YOUR_API_KEY',
        'secret' => 'YOUR_API_SECRET',
        'token' => $_GET['token']
);

$auth = new lastfmApiAuth('getsession', $vars);

$vars = array(
        'apiKey'        => $auth->apiKey,
        'secret'        => $auth->secret,
        'username'      => $auth->username,
        'sessionKey'    => $auth->sessionKey,
        'subscriber'    => $auth->subscriber
);

$auth = new lastfmApiAuth('setsession', $vars);

$apiClass = new lastfmApi();
$packageClass = $apiClass->getPackage($auth, 'user');

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Find and Browse Music on Last.fm – Last.fm</title>                
</head>
<body>
<?

// title    = name of the website
// link     = text that will be visible as link
// prefix   = first part of the download url, will be added before the name of the artist
// postfix  = second part of the download url, will be appended to the prefix and artist name

// add/change sources to your liking

$source[0]['title']     = "The Pirate Bay";
$source[0]['link']      = "flac";
$source[0]['prefix']    = "http://thepiratebay.se/search/";
$source[0]['postfix']   = "/0/7/104";

$source[1]['title']     = "The Pirate Bay";
$source[1]['link']      = "mp3";
$source[1]['prefix']    = "http://thepiratebay.se/search/";
$source[1]['postfix']   = "/0/7/101";

$source[2]['title']     = "Mininova";
$source[2]['link']      = "flac";
$source[2]['prefix']    = "http://www.mininova.org/search/?search=flac+";
$source[2]['postfix']   = "&cat=5";

$source[3]['title']     = "Mininova";
$source[3]['link']      = "mp3";
$source[3]['prefix']    = "http://www.mininova.org/search/?search=";
$source[3]['postfix']   = "&cat=5";

if($recommendations = $packageClass->getRecommendedArtists($vars)){

        echo "<table border=1>\n";
        echo "<tr>\n";
        echo "<th>artist</th>\n";
        echo "<th>Last.FM</th>\n";
        
        // show website names
        foreach($source as $val){
                echo "<th>". $val['title'] ."</th>\n";
        }
        echo "</tr>\n";

        foreach($recommendations['artists'] as $artist){

                echo "<tr>\n";
                
                // name of the recommended artist
                echo "<td><a href=\"http://last.fm/music/". urlencode($artist['name']) ."\" target=\"_blank\">". $artist['name'] ."</a></td>\n";
                
                // link to similar artists on last.fm
                echo "<td><a href=\"http://last.fm/music/". urlencode($artist['name']) ."/+similar\" target=\"_blank\">similar</a></td>\n";

                // loop through the sources
                foreach($source as $val){

                        // construct the url: prefix + artist + postfix
                        $url = $val['prefix'] . urlencode($artist['name']) . $val['postfix'];

                        // display the link in a cell
                        echo "<td style=\"text-align: center;\"><a href=\"". $url ."\" target=\"_blank\">". $val['link'] ."</a></td>\n";

                }

                echo "</tr>\n";

        }

        echo "</table>\n";

}
else {

        // Error: show which error and go no further.
        echo '<b>Error '.$packageClass->error['code'].' - </b><i>'.$packageClass->error['desc'].'</i>';
}

?>
</body>
</html>
