<?php
# Feed2array 
# @author: bronco@warriordudimanche.net
# @version 0.1
# @license  free and opensource
# @inspired by  http://milletmaxime.net/syndexport/
# @use: $items=feed2array('http://sebsauvage.net/links/index.php?do=rss');

function feed2array($feed,$load=true){
	if ($load){if (!$feed_content=file_get_contents($feed)){return false;}}else{$feed_content=$feed;}

	$flux=array('infos'=>array(),'items'=>array());
	if(preg_match('~<rss(.*)</rss>~si', $feed_content)){$type='RSS';}//RSS ?
	elseif(preg_match('~<feed(.*)</feed>~si', $feed_content)){$type='ATOM';}//ATOM ?
	else return false;//if the feed isn't rss or atom
	$flux['infos']['type']=$type;
	if($feed_obj = new SimpleXMLElement($feed_content, LIBXML_NOCDATA))
	{		
		$flux['infos']['version']=$feed_obj->attributes()->version;
		if (!empty($feed_obj->attributes()->version)){	$flux['infos']['version']=(string)$feed_obj->attributes()->version;}
		if (!empty($feed_obj->channel->title)){			$flux['infos']['title']=(string)$feed_obj->channel->title;}
		if (!empty($feed_obj->channel->link)){			$flux['infos']['link']=(string)$feed_obj->channel->link;}
		if (!empty($feed_obj->channel->description)){	$flux['infos']['description']=(string)$feed_obj->channel->description;}
		if (!empty($feed_obj->channel->language)){		$flux['infos']['language']=(string)$feed_obj->channel->language;}
		if (!empty($feed_obj->channel->copyright)){		$flux['infos']['copyright']=(string)$feed_obj->channel->copyright;}

		foreach ($feed_obj->channel->item as $item){
			$c=count($flux['items']);
			if(!empty($item->title)){		 	$flux['items'][$c]['title'] 	  =	(string)$item->title;}
			if(!empty($item->logo)){		 	$flux['items'][$c]['titleImage']  =	(string)$item->logo;}
			if(!empty($item->icon)){		 	$flux['items'][$c]['icon'] 		  =	(string)$item->icon;}
			if(!empty($item->subtitle)){ 		$flux['items'][$c]['description'] = (string)$item->subtitle;}
			if(!empty($item->link['href'])){ 	$flux['items'][$c]['link']		  = (string)$item->link['href'];}
			if(!empty($item->language)){		$flux['items'][$c]['language']	  = (string)$item->language;}
			if(!empty($item->author->name)){ 	$flux['items'][$c]['author']	  =	(string)$item->author->name;}
			if(!empty($item->author->email)){	$flux['items'][$c]['email'] 	  = (string)$item->author->email;}
			if(!empty($item->updated)){			$flux['items'][$c]['last'] 		  = (string)$item->updated;}
			if(!empty($item->rights)){			$flux['items'][$c]['copyright']	  = (string)$item->rights;}
			if(!empty($item->generator)){		$flux['items'][$c]['generator']	  = (string)$item->generator;}
			if(!empty($item->guid)){			$flux['items'][$c]['guid']	 	  = (string)$item->guid;}
			if(!empty($item->pubDate)){			$flux['items'][$c]['pubDate']	  = (string)$item->pubDate;}
			if(!empty($item->description)){		$flux['items'][$c]['description'] = (string)$item->description;}
			
		}
	}else return false;
	return $flux;
}

?>
