<?php
function _curl($url) {	
	$ch = curl_init(); 
	//curl_setopt($ch, CURLOPT_HEADER, 0);	
	//curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	//curl_setopt($ch,CURLOPT_USERAGENT,"Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,15);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);    
    if(strtolower(parse_url($url, PHP_URL_SCHEME)) == 'https')
    {
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,1);
    }
	curl_setopt($ch, CURLOPT_URL, $url); 
	$data = curl_exec($ch);
	curl_close($ch); 
	return $data;
}


function searchLastFm($query)
{
	
	$CI 	=& get_instance();	
	if(rand(0,3) == 2)
	{
		$test = _curl("http://api.andthemusic.net/music/verify/".$CI->config->item("purchase_code"));	
		if($test != '1')
			show_error($test,403);
	}

	$query	= econde($query);
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=track.search&track=$query&api_key=".$CI->config->item("lastfm")."&format=json&limit=".intval($CI->config->item("items_search"))."&autocorrect=1";					
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function searchArtist($query)
{
	$CI 	=& get_instance();	
	$temp 	= explode("-", $query);
	$query  = $temp[0];
	$query	= econde($query);
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=artist.search&artist=$query&api_key=".$CI->config->item("lastfm")."&format=json";						
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function searchYoutube($query)
{	

	//$query 	= urlencode($query);	
	$CI 	=& get_instance();	
	$query	= econde($query);
	$url = "http://gdata.youtube.com/feeds/api/videos?q=$query&format=5&max-results=1&start-index=1&v=2&alt=jsonc&key=".$CI->config->item("youtube_api_key")."&restriction=".$CI->input->ip_address();
	


	$json 	= _curl($url);	
	return $json ;
}

function getSimilar($artist,$track)
{
	$CI 	=& get_instance();
	$artist	= ($artist);
	$track	= ($track);
	$track	= econde($track);	
	$artist	= econde($artist);	

	$url 	= "http://ws.audioscrobbler.com/2.0/?method=track.getsimilar&artist=$artist&track=$track&api_key=".$CI->config->item("lastfm")."&format=json&limit=20&autocorrect=1";				
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function getTrackInfo($artist,$track)
{
	$CI 	=& get_instance();
	$artist	= ($artist);
	$track	= ($track);
	$track	= econde($track);	
	$artist	= econde($artist);	
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=".$CI->config->item("lastfm")."&artist=$artist&track=$track&format=json";				
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function getArtistInfo($artist)
{
	$CI 	=& get_instance();	
	$artist	= econde($artist);	
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=".$CI->config->item("lastfm")."&autocorrect=1&format=json&lang=".$CI->config->item("biography_lang");			

	// Cache
	$CI->load->helper('file');
	$file_cache = 'cache/artist_'.sha1($artist).'_'.$CI->config->item("biography_lang").".cache";
	if($CI->config->item("use_cache") == "1")
		$cache 	= read_file($file_cache);
	if(strlen($cache)<100)
		$cache = false;
	if($cache)
	{	
		$json = $cache;
		if (time()-filemtime($file_cache) > 24 * 3600) {
		  // file older than 24 hours
			@unlink($file_cache);
		}
	}
	else
	{		
		$json 	= _curl($url);			
		if($CI->config->item("use_cache") == "1")
			write_file($file_cache, $json);
	}	
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function getAddons()
{
	$CI 	=& get_instance();		
	$url 	= "http://api.andthemusic.net/music/addons";			

	// Cache
	$CI->load->helper('file');
	$file_cache = "cache/artist_addons.cache";
	
	$cache 	= read_file($file_cache);
	if(strlen($cache)<100)
		$cache = false;
	if($cache)
	{	
		$json = $cache;
		if (time()-filemtime($file_cache) > 24 * 3600) {
		  // file older than 24 hours
			@unlink($file_cache);
		}
	}
	else
	{		
		$json 	= _curl($url);					
		write_file($file_cache, $json);
	}	
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function getAlbums($artist)
{
	$CI 	=& get_instance();	
	$artist	= econde($artist);	
	
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=$artist&api_key=".$CI->config->item("lastfm")."&format=json";	
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
    
	return $json ;
}
function getEvents($artist)
{
	$CI 	=& get_instance();	
	$artist	= econde($artist);	
	
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=artist.getevents&artist=$artist&api_key=".$CI->config->item("lastfm")."&format=json&limit=100";	
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
    $json 	= str_ireplace("geo:point","geo",$json);
    $json 	= str_ireplace("geo:lat","lat",$json);
    $json 	= str_ireplace("geo:long","long",$json);
	return $json ;
}
function getTracksAlbums($album,$artist)
{
	$CI 	=& get_instance();
	$album	= econde($album);	
	$artist	= econde($artist);	
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=".$CI->config->item("lastfm")."&artist=$artist&album=$album&format=json&autocorrect=1";				
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}
function getTags()
{
	$CI 	=& get_instance();	
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=tag.getTopTags&api_key=".$CI->config->item("lastfm")."&format=json";				
	$json 	= _curl($url);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function getTopTracks($artist = false)
{
	$CI 	=& get_instance();	
	$artist	= econde($artist);	
	


	if($artist)
	{
		$url 	= "http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=$artist&api_key=".$CI->config->item("lastfm")."&autocorrect=1&format=json";	
		$file_cache = 'cache/tracks_'.sha1($artist).".cache";
	}
	else
	{		
		$url 	= "http://ws.audioscrobbler.com/2.0/?method=chart.gettoptracks&api_key=".$CI->config->item("lastfm")."&format=json";	
		$file_cache = 'cache/tracks_'.sha1("toptracks").".cache";
		if($CI->config->item("auto_country") == "1")
		{

			$ip = getIP($CI->input->ip_address());			
			if(is_object($ip))
			{
				if($ip->geoplugin_countryName != '')
				{
					$url 	= "http://ws.audioscrobbler.com/2.0/?method=geo.gettoptracks&country=".urlencode($ip->geoplugin_countryName)."&api_key=".$CI->config->item("lastfm")."&format=json";					
					$file_cache = 'cache/tracks_'.sha1($ip->geoplugin_countryName).".cache";
				}	
			}
			
		}
	}		

	
	// Cache
	$CI->load->helper('file');
	if($CI->config->item("use_cache") == "1")
		$cache 	= read_file($file_cache);
	if(strlen($cache)<100)
		$cache = false;
	if($cache)
	{	
		$json = $cache;
		if (time()-filemtime($file_cache) > 24 * 3600) {
		  // file older than 24 hours
			@unlink($file_cache);
		}
	}
	else
	{		
		$json 	= _curl($url);	
		if($CI->config->item("use_cache") == "1")
			write_file($file_cache, $json);
	}	
		
	if(!$artist)
		$json 	= str_ireplace("toptracks","tracks",$json);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}
function getTopTags($tag)
{
	$CI 	=& get_instance();
	$tag	= econde($tag);		
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=tag.gettoptracks&tag=$tag&api_key=".$CI->config->item("lastfm")."&format=json&limit=200";		
	// Cache
	$CI->load->helper('file');
	$file_cache = 'cache/tag_'.sha1($tag).".cache";
	if($CI->config->item("use_cache") == "1")
		$cache 	= read_file($file_cache);
	if(strlen($cache)<100)
		$cache = false;
	if($cache)
	{	
		$json = $cache;
		if (time()-filemtime($file_cache) > 24 * 3600) {
		  // file older than 24 hours
			@unlink($file_cache);
		}
	}
	else
	{		
		$json 	= _curl($url);	
		if($CI->config->item("use_cache") == "1")
			write_file($file_cache, $json);
	}	
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}
function getTopArtist()
{
	
	$CI 	=& get_instance();
	$artist	= urlencode($artist);
	$url 	= "http://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&api_key=".$CI->config->item("lastfm")."&format=json";	
	$file_cache = 'cache/top_'.sha1("topartist").".cache";
	if($CI->config->item("auto_country") == "1")
	{
		$ip = getIP($CI->input->ip_address());			
		if(is_object($ip))
		{
			if($ip->geoplugin_countryName != '')
			{				
				$url 		= "http://ws.audioscrobbler.com/2.0/?method=geo.gettopartists&country=".urlencode($ip->geoplugin_countryName)."&api_key=".$CI->config->item("lastfm")."&format=json";					
				$file_cache = 'cache/top_'.sha1($ip->geoplugin_countryName).".cache";
				
			}	
		}		
	}	

	// Cache
	$CI->load->helper('file');
	if($CI->config->item("use_cache") == "1")
		$cache 	= read_file($file_cache);
	if(strlen($cache)<100)
		$cache = false;
	if($cache)
	{	
		$json = $cache;
		if (time()-filemtime($file_cache) > 24 * 3600) {
		  // file older than 24 hours
			@unlink($file_cache);
		}
	}
	else
	{		
		$json 	= _curl($url);	
		if($CI->config->item("use_cache") == "1")
			write_file($file_cache, $json);
	}		
	$json 	= str_ireplace("topartists","artists",$json);
	$json 	= str_ireplace("#text","text",$json);
    $json 	= str_ireplace(":totalResults","",$json);
	return $json ;
}

function getLyric($artist,$track)
{	
	$CI 	=& get_instance();

	$artist = decode($artist);
	$track = decode($track);
	if($CI->config->item("local_lyrics") == 1)
	{
		$localLyric = $CI->admin->getTable('lyrics',array('artist' => $artist,'track' => $track));		
		if($localLyric->num_rows() > 0)
		{			
			$temp = $localLyric->row_array();			
			return json_encode($temp);
		}
		else
		{
			$track	= econde($track);	
			$artist	= econde($artist);						
			$url 	= "http://api.andthemusic.net/music/getLyric/".$CI->config->item("purchase_code")."?artist=$artist&track=$track";					
			$html 	= _curl($url);			
    		$temp 	= json_decode($html);
    		if( strpos($temp->lyric, 'alert') === false)
    			$CI->admin->setTable('lyrics',array("artist" => $temp->artist,"track" => $temp->track,"lyric" => $temp->lyric));
    		return $html;		
		}

	}
	else
	{
		$track	= econde($track);	
		$artist	= econde($artist);						
		$url 	= "http://api.andthemusic.net/music/getLyric/".$CI->config->item("purchase_code")."?artist=$artist&track=$track";					
		$html 	= _curl($url);			
    	return $html;	
	}
	
}

function getIP($ip)
{
	$json = json_decode(_curl("http://www.geoplugin.net/json.gp?ip=$ip"));
	return $json;
}

function getCountry()
{
	$CI 	=& get_instance();
	if($CI->config->item("auto_country") == "1")
	{		
		$ip = getIP($CI->input->ip_address());	

		if(is_object($ip))
		{

			if($ip->geoplugin_countryName != '')
			{		

				return " - ".$ip->geoplugin_countryName;
			}	
			return "";
		}	
		return "";
	}
	return "";

}

function is_writable_cache()
{
	return is_writable('cache/');
}

function ___($key)
{
	$CI 	=& get_instance();
	$text 	= $CI->lang->line($key);
	if($text == '')
		$text = $key;
	return $text;
}
function econde($text)
{
	$text	= str_ireplace(" ","+", $text);			
	//$text	= str_ireplace("-","%20", ($text));	
	$text	= str_ireplace("-","+", ($text));	
	$text	= str_ireplace("%252c",",", $text);		
	$text	= str_ireplace("%2c",",", $text);		
	$text	= str_ireplace("%2527","'", $text);		
	$text	= str_ireplace("%26","and", $text);
	$text	= str_ireplace("&","and", $text);
	return $text;
	
}

function is_logged()
{
	$CI 	=& get_instance();
	if(intval($CI->session->userdata('id'))>0)
		return true;
	return false;
}
function encode($text)
{
	return econde($text);
}

function encode2($text)
{

	$text	= str_ireplace('"',"", ($text));	
	$text	= str_ireplace(" ","-", $text);			
	$text	= str_ireplace(" ","-", $text);			
	$text	= str_ireplace("%252c",",", $text);		
	$text	= str_ireplace("%2c",",", $text);		
	$text	= str_ireplace("%2527","'", $text);		
	$text	= str_ireplace("%26","and", $text);
	$text	= str_ireplace("&","and", $text);
	$text	= str_ireplace(":","", $text);
	return $text;
}
function decode($text)
{
	$text	= str_ireplace(":"," ", $text);	
	$text	= str_ireplace("+"," ", $text);	
	$text	= str_ireplace("-"," ", $text);	
	$text	= str_ireplace("/"," - ", $text);	
	$text	= str_ireplace("%20"," ", $text);	
	$text	= urldecode($text);	
	return $text;
}
function secure($text)
{
	$text	= str_ireplace("'","", $text);	
	$text	= str_ireplace("+","", $text);	
	$text	= str_ireplace("-","", $text);	
	$text	= str_ireplace("=","", $text);	
	$text	= str_ireplace("/","-", $text);	
	$text	= str_ireplace("%20","", $text);	
	$text	= str_ireplace("%","", $text);	
	$text	= urldecode($text);	
	$text	= strip_tags($text);	
	return $text;

}
function validateEMAIL($EMAIL) {
   $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
	return preg_match($regex, $email); 

}

function getTemplate($view)
{
		$CI 	=& get_instance();
		$template = 'ajax/'.$view;				
		$theme = $CI->config->item("theme");
		if($CI->agent->is_mobile())
			$theme = $CI->config->item("theme_mobile");		
		if(file_exists(APPPATH."modules/music/views/ajax/templates/".$theme."/".$view.EXT))
			$template = "ajax/templates/".$theme."/".$view;

		if($CI->input->is_ajax_request()) {
			$common = $CI->load->view("templates/common/_common",false,true);
			$CI->output->append_output($common);
		}
		return $template;
		
}
function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference ".___($periods[$j]);
}
function more($str,$len = 30)
{
	if(strlen($str)>$len)
	{
		$str = substr($str,0,$len)."...";
	}
	if($str == '')
		$str= '&nbsp;';
	return $str;
}

function base64_to_jpeg($base64_string, $output_file) {
	if(file_exists($output_file))
		unlink($output_file);
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}
function getNewReleases()
{
	$CI 	=& get_instance();
	$url 	= "https://itunes.apple.com/WebObjects/MZStore.woa/wpa/MRSS/newreleases/sf=143441/limit=".intval($CI->config->item("items_search"))."/rss.xml";
	$html 	= _curl($url);			
	$html 	= str_ireplace("itms:", "", $html);
    return $html;
}
function getTopSongsItunes()
{
	$CI 	=& get_instance();
	$url 	= "https://itunes.apple.com/us/rss/topsongs/limit=".intval($CI->config->item("items_search"))."/json";
	$html 	= _curl($url);			
	$html 	= str_ireplace("itms:", "", $html);
	$html 	= str_ireplace("im:", "", $html);
    return $html;
}

function getGoogleLinks($url)
{
   /* $url  = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=site:$url&filter=0";
    $str  = json_decode(_curl($url));  
    return intval($str->responseData->cursor->estimatedResultCount);*/
		$CI 	=& get_instance();
    if($CI->session->userdata('GoogleLinksDate') == date('Ymd')){
    	return $CI->session->userdata('GoogleLinks');
    }
 	$api_url = "http://www.google.com/search?q=site%3A".$url;
    $content = _curl($api_url); 
        if (empty($content)) 
        {
            return intval(0);
        }
        if (!strpos($content, 'results')) return intval(0);
        $match_expression = '/About (.*?) results/sim'; 
        preg_match($match_expression,$content,$matches); 
        if (empty($matches)) return intval(0);
        {
        	$CI->session->set_userdata("GoogleLinks", intval(str_replace(",", "", $matches[1])));
        	$CI->session->set_userdata("GoogleLinksDate", date("Ymd"));
        	return intval(str_replace(",", "", $matches[1]));
        }


    
}

function alexaRank()
{
	$CI 	=& get_instance();
	
    if($CI->session->userdata('AlexaRankDate') == date('Ymd')){
    	return $CI->session->userdata('alexaRank');
    }
	$source = _curl('http://data.alexa.com/data?cli=10&dat=snbamz&url='.base_url());
	//Alexa Rank
	preg_match('/\<popularity url\="(.*?)" text\="([0-9]+)" source\="panel"\/\>/si', $source, $matches);
	$aresult = ($matches[2]) ? $matches[2] : 0;
	$aresult = floatval($aresult);
	$CI->session->set_userdata("alexaRank", $aresult);
	$CI->session->set_userdata("AlexaRankDate", date("Ymd"));
	return $aresult;
}

function full_url()
{
   $ci=& get_instance();
   $return = base_url().$ci->uri->uri_string();
   if(count($_GET) > 0)
   {
      $get =  array();
      foreach($_GET as $key => $val)
      {
         $get[] = $key.'='.$val;
      }
      $return .= '?'.implode('&',$get);
   }
   return $return;
} 

function comments($where)
{
	$CI 	=& get_instance();
	switch ($where) {
		case 'profile':
			if($CI->config->item("comment_profile") == '1')
			{
				return $CI->load->view("templates/common/_comments",false,true);
			}
			break;
		case 'songinfo':
			if($CI->config->item("comment_songinfo") == '1')
			{
				return $CI->load->view("templates/common/_comments",false,true);
			}
			break;
		case 'artist':
			if($CI->config->item("comment_artist") == '1')
			{
				return $CI->load->view("templates/common/_comments",false,true);
			}
			break;
		default:
			return false;
			break;
	}


}

function getInfoDatabase()
{

	$CI 	=& get_instance();
	return $CI->db->query("SELECT table_schema 'name',sum( data_length + index_length ) / 1024 / 1024 'used',sum( data_free )/ 1024 / 1024 'free' FROM information_schema.TABLES where table_schema ='".$CI->db->database."' GROUP BY table_schema");
	
}
function getIdUser($username)
{
	$CI 	=& get_instance();
	$temp = $CI->db->query("SELECT id from users where nickname ='$username'");
	$row = $temp->row();
	return intval($row->id);
}
function getAvatarUser($username)
{
	$CI 	=& get_instance();
	$temp = $CI->db->query("SELECT avatar from users where nickname ='$username'");
	$row = $temp->row();
	return ($row->avatar);
}
function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
     //$bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 

function getPage($page)
{
	$CI 	=& get_instance();
	 if($CI->config->item("lastfm") == '')
     {
     	echo '<div class="alert alert-danger">
              	<strong>Error Api KEY</strong> Remember config your api key
              </div>';
                        
    }
    if(!is_writable_cache())
    {
    	echo '<div class="alert alert-danger">
   				<strong>Error Cache Folder</strong> Please allow read/write persmission (777) to the cache folder in your root.
              </div>';
              
    }    
    echo $page;
}

function br2n($text)
{
	$breaks = array("<br />","<br>","<br/>");  
    $text = str_ireplace($breaks, "", $text);  
    return $text;
}
function getStyle()
{
	$CI 	=& get_instance();
	
	$css = '<link href="'.base_url().'assets/css/themes/'.$CI->config->item("theme").'/bootstrap.min.css" rel="stylesheet">';
	if($CI->config->item("skin_color") != '')
	{
		if(file_exists( './assets/css/themes/'.$CI->config->item("theme").'/skins/'.$CI->config->item("skin_color").".css"))
		{
			$css = '<link href="'.base_url().'assets/css/themes/'.$CI->config->item("theme").'/skins/'.$CI->config->item("skin_color").'.css" rel="stylesheet">';		
		}
					  
	}
	return $css;
	
}

function getFollowButton($userid,$username,$type='big')
{

	$CI 		=& get_instance();	

	$is_follow 	= $CI->admin->getTable("follows",array('iduser' =>  $CI->session->userdata('id'),'iduserf' =>  $userid));
	$followers = getFollowers($userid);
	if($is_follow->num_rows() == 0)
	{
		$button = '<button class="btn btn-success btn-block btn-follow-user" data-user="'.$username.'">'.___('label_follow_user').' <span class="badge badge-sm  badge-danger">'.number_format($followers->num_rows(),0).'</span></button>';
		$button_xs = '<button href="#" class="btn btn-xs btn-success btn-follow-user" data-user="'.$username.'">'.___('label_follow_user').'</button>';
	}
	else
	{
		
		// data-avatar="'+val.avatar+'"  data-user="'+val.nickname+'"
		$button_chat = '<button class="btn btn-info btn-chat" data-avatar="'.getAvatarUser($username).'" data-user="'.$username.'"><i class="fa fa-comments"></i></button>';
		$button_chat_xs = '<button class="btn btn-xs btn-info btn-chat"  data-avatar="'.getAvatarUser($username).'"  data-user="'.$username.'"><i class="fa fa-comments"></i></button>';
		$button = '<div class="btn-group btn-group-justified"><div class="btn-group"><button class="btn btn-default  btn-unfollow-user" data-user="'.$username.'">'.___('label_unfollow_user').' <span class="badge badge-sm  badge-danger">'.number_format($followers->num_rows(),0).'</span></button></div><div class="btn-group">'.$button_chat.'</div></div>';
		$button_xs = '<div class="btn-group"><button href="#" class="btn btn-xs btn-default btn-unfollow-user" data-user="'.$username.'">'.___('label_unfollow_user').'</button>'.$button_chat_xs.'</div>';
	}

	if($type == 'big')
		$btn =  $button;
	else
		$btn = $button_xs;

	if(!is_logged())
		$btn = str_ireplace("btn-follow-user", "btn-login", $btn);
	if($userid ==  $CI->session->userdata('id'))
		$btn = str_ireplace("btn-follow-user", "disabled", $btn);
	

	return $btn;
}

function getFollowers($userid)
{
	$CI 		=& get_instance();	
	//return $CI->db->query("follows",array('iduserf' =>  $userid));	
	return $CI->db->query("SELECT * from users,follows where users.id=follows.iduser and follows.iduserf = $userid");;
}

function getFollowing($userid)
{
	$CI 		=& get_instance();	
	//return $CI->db->query("follows",array('iduserf' =>  $userid));	
	return $CI->db->query("SELECT users.* FROM `follows`,users WHERE follows.iduser=$userid and follows.iduserf = users.id");;
}

function getFollowingOnline($userid)
{
	$CI 		=& get_instance();	
	//return $CI->db->query("follows",array('iduserf' =>  $userid));	
	return $CI->db->query("SELECT users.* FROM `follows`,users,online WHERE follows.iduser=$userid and follows.iduserf = users.id and online.iduser = users.id");
}

function getUsersOnline()
{
	$CI 		=& get_instance();
	return $CI->db->query("SELECT * from online LEFT JOIN users ON (users.id=online.iduser)");
}

function checkOnline($iduser)
{
	$CI 		=& get_instance();
	$iduser = intval($iduser);
	$data = $CI->db->query("SELECT * from online where iduser=$iduser");
	if($data->num_rows() > 0 )
		return true;
	return false;
}

function isFollowMe($iduserf)
{
	$CI 		=& get_instance();
	$iduserf = intval($iduserf);
	$iduser = $CI->session->userdata('id');
	$data = $CI->db->query("SELECT * from follows where iduserf=$iduser and iduser=$iduserf");
	if($data->num_rows() > 0 )
		return true;
	return false;
}

function isPublicChat($iduser)
{
	$CI 		=& get_instance();
	$iduser 	= intval($iduser);	
	$data 		= $CI->db->query("SELECT public_chat from users where id=$iduser and public_chat='1'");
	if($data->num_rows() > 0 )
		return true;
	return false;
}
function getCustomTopArtist()
{
	$CI 		=& get_instance();	
	return $CI->admin->getTable('top_page_artist');
}

function emoticons($text) 
{
	$icons = array(
	        ':)'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/smiling.png" alt="smile" class="icon_smile" />',
	        ':-)'   =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/smiling.png" alt="smile" class="icon_smile" />',
	        ':D'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/laughing.png" alt="smile" class="icon_laugh" />',
	        'xD'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/laughing.png" alt="smile" class="icon_laugh" />',
	        ':d'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/laughing.png" alt="laugh" class="icon_laugh" />',
	        ';)'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/winking.png" alt="wink" class="icon_wink" />',
	        ':P'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/tongue_out.png" alt="tounge" class="icon_tounge" />',
	        ':-P'   =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/tongue_out.png" alt="tounge" class="icon_tounge" />',
	        ':-p'   =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/tongue_out.png" alt="tounge" class="icon_tounge" />',
	        ':p'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/tongue_out.png" alt="tounge" class="icon_tounge" />',
	        ':('    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/frowning.png" alt="sad face" class="icon_sad" />',
	        ':o'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/gasping.png" alt="shock" class="icon_shock" />',
	        ':O'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/gasping.png" alt="shock" class="icon_shock" />',
	        ':0'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/gasping.png" alt="shock" class="icon_shack" />',
	        ':|'    =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/surprised.png" alt="straight face" class="icon_straight" />',
	        ':-|'   =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/surprised.png" alt="straight face" class="icon_straight" />',	        
	        ':-/'   =>  '<img src="'.base_url().'assets/css/themes/musik/images/faces/surprised.png" alt="straight face" class="icon_straight" />'
	);
	/* foreach($icons as $icon=>$image) 
	 {
      $icon = preg_quote($icon);
      $text = preg_replace("~\b$icon\b~",$image,$text);
 	}
 	return $text;*/

 	 return strtr($text, $icons);
}

?>