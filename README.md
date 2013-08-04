feed2array
==========

A tiny php function to get a atom/rss feed and create an array with all the content (less than 70 lines)

$content=feed2array($feed,$load);
$feed is the feed's url (if $load=true) or the $feed content (if $load=false): 
If you want to load the feed with your own function, use $load=false and put the loaded content in $feed, like below.
$txtcontent=my_own_file_get_contents('url');
$content=feed2array($txtcontent,false);

But you can simply put the following line:
$content=feed2array('url');
 
Enjoy !


