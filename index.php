<?php

require_once('Array2feed.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$array=array(
    'infos'=>array(
            'type'=>'rss',
            'description'=>'Ceci est le test ultime de la mort',
            'title'=>'test de création de flux rss',
            'link'=>'http://www.warriordudimanche.net',
        ),
    'items'=>array(
        0=>array(
                'description'=>'Ceci est le premier item du flux',
                'title'=>'item 1 : le titre',
                'link'=>'http://www.warriordudimanche.net',
                'guid'=>'http://www.warriordudimanche.net#1',
                'pubDate'=>@date('r'),// Be carefull, the rss pubDate format is specific ! RFC 2822 (see http://www.faqs.org/rfcs/rfc2822.html)
            ),
        1=>array(
                'description'=>'Ceci est le second item du flux',
                'title'=>'item 2 : le retour',
                'link'=>'http://www.warriordudimanche.net',
                'guid'=>'http://www.warriordudimanche.net#2',
                'pubDate'=>@date('r'),
            ),
        2=>array(
                'description'=>'Ceci est le troisième item du flux',
                'title'=>'item 3 : la revanche',
                'link'=>'http://www.warriordudimanche.net',
                'guid'=>'http://www.warriordudimanche.net#3',
                'pubDate'=>@date('r'),
            ),

        )
    );



echo array2feed($array);

?>