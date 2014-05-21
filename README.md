RecommenTor
===========

Find music torrents (mp3, flac) based on your Last.fm recommendations

Requires:
 - you have and use a last.fm account;
 - PHP Last.fm API (https://github.com/matto1990/PHP-Last.fm-API) by Matt Oakes (http://oakes.ws/)

Configuration
 - The Callback URL can be set to index.php (http://www.last.fm/api/accounts -> RecommenTor -> Authentication -> Callback URL)
 - add torrent sources by adding them to the $source array. Add a title, text for the link, first part of the search url (placed before the artist name + seconr part) and the second part of the search url (placed after the first part + artist name). E.g.: title = "My own torrentsite", link = "ogg", prefix = "http://www.foobar.com/search?q=" and postfix = "&filetype=ogg&sort=seeds".
