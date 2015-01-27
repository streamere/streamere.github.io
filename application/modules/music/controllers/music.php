<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Music extends MY_Controller {

	public function index($type= '',$query = '')
	{
		//$this->output->enable_profiler(TRUE);
		
		//$this->output->cache(1);		

		if($this->input->get("s") != '')
		{
			$data['search'] = $this->input->get("s");	
			$query 			= $this->input->get("s");
			$type 			= "search";
		}

		if($this->input->get("artist") != '' && $this->input->get("artist") != '')
		{
			$data['search'] = $this->input->get("artist")."-".$this->input->get("track");	
			$query 			= $this->input->get("artist")."-".$this->input->get("track");	
			$type 			= "songInfo";
		}

		

		$data['search'] 		= decode(urldecode($data['search']));
		$data['page'] 			= null;
		$data['title2'] 		= '';		
		$data['description2'] 	= '';	


		if($this->input->get("playlist") != '')
		{

			$playlist = $this->admin->getTable("playlist",array("sha1(CONCAT('".$this->config->item("encryption_key")."',idplaylist))" => $this->input->get("playlist")));		

			$temp = $playlist->result();

			$data['title2'] = "Playlist ".$temp[0]->name. " |";
			
			$temp2 = json_decode($temp[0]->json);

			foreach ($temp2 as $key => $value) {
				if($key == 0)
					$data['picture'] = $value->cover;
				if($key < 10)
					$data['description2'] .= $value->track." - ".$value->artist." | ";
			}
			
			
		}


		switch ($type) {
			case 'artist':
				$data['page'] 			= $this->getArtistInfo($query,true);
				$data['title2'] 		=  $query. " | ";
				$temp 					= json_decode(getArtistInfo($query));											
				$data['picture']		= $temp->artist->image[4]->text;				
				$data['description2']	= ltrim(strip_tags($temp->artist->bio->content));			
				if($data['picture'] == '')
					$data['picture']= $temp->artist->image[3]->text;				
				break;		
			case 'tag':
				$data['page'] 	= $this->getTopTags($query,true);
				$data['title2'] = $query . " | ";
				break;	
			case 'search':
				$data['search']	= decode(urldecode($query));
				$data['title2'] = ___("label_search")." ".decode($query) . " | ";
				$data['page'] 			= $this->search(decode($query),true);
				break;		
			case 'user':				
				$data['title2'] = "Profile ".decode(urldecode($query))." | ";
				$data['page'] 			= $this->profile(decode($query),true);
				break;		
			case 'page':				
				$tmp 					= explode("-",$query);
				unset($tmp[0]);				
				$data['title2'] 		= implode(" ",$tmp) . " | ";
				$temp_id 				= explode("-", $query);
				$data['page'] 			= $this->getPage(intval($temp_id[0]),true);
				break;	
			case 'songInfo':
				$data['search']			= decode(urldecode($query));
				$data['title2'] 		= $this->input->get("artist")." - ".$this->input->get("track") . " | ";
				$temp 					= json_decode(getArtistInfo($this->input->get("artist")));															
				$data['picture']		= $temp->artist->image[4]->text;				
				$data['description2']	= ltrim(strip_tags($temp->artist->bio->content));			
				if($data['picture'] == '')
					$data['picture'] = $temp->artist->image[3]->text;		

				$data['page'] 	= $this->getSongInfo($this->input->get("artist"),$this->input->get("track"),true,$temp);
				break;	
			case 'admin':
				$data['hide_ads'] 		= TRUE;
				$data['page'] 			= $this->admin();
				break;	
			default:
				$trg = explode("::",$this->config->item("start"));
				if($this->config->item("start") == "newReleases")
					$data['page'] = $this->getNewReleases(true);
				if($this->config->item("start") == "TopArtist")
					$data['page'] = $this->getTopArtist(true);
				if($this->config->item("start") == "TopArtistCustom")
					$data['page'] = $this->getTopArtistCustom(true);
				if($this->config->item("start") == "TopTracks" || $this->config->item("start") == "TopTracksItunes" || $this->config->item("start") == "TopTracksActivity")
					$data['page'] = $this->getTopTracks(true);	
				if($this->config->item("start") == "Activity")
					$data['page'] = $this->getActivity(true);
				if($this->config->item("start") == "SearchBox")
					$data['page'] = $this->getSearchBox(true);
				if($trg[0] == "page")
				{
					$data['page'] = $this->getPage($trg[1],true);
				}	
				if($trg[0] == "genres")
				{
					$data['page'] = $this->getTopTags($trg[1],true);
				}


				break;
		}
		if($this->config->item("use_database") == 1)
		{	
			$data['pages']	= $this->admin->getTable("pages",false,"title");
		}


		$template = 'templates/music';
		
		if(file_exists(APPPATH."modules/music/views/templates/".$this->config->item("theme").EXT))
			$template = "templates/".$this->config->item("theme");
		$this->load->view($template,$data);
	}


	/* AJAX */
	public function search($query,$return = false)
	{
		//$this->output->enable_profiler(TRUE);
		if(strlen($this->config->item("purchase_code")) < 30)
		{
			echo '<div class="alert alert-danger">You must enter valid purchase code to use this software | <strong>© Copyright <a href="http://jodacame.com">Jodacame.com</a></strong><br><br>Go to <a href="'.base_url().'admin/">'.base_url().'admin</a> and add your purchase code</div>';
			exit;	
		}

		if(!$return)	
			$query = $this->input->get("query");		
		$data['search'] = json_decode(searchLastFm($query));		
		$data['query'] = $query;		
		return $this->load->view(getTemplate('search'),$data,$return);
	}
	public function searchArtist($query)
	{

		$query = $this->input->get("query");		
		$data['search'] = json_decode(searchArtist($query));		
		$data['query'] = $query;		
		$this->load->view(getTemplate('searchArtist'),$data);
	}
	public function getActivity($return = false)
	{	
		//$this->output->enable_profiler(TRUE);
	 	if($this->config->item('registration') == "1"){
			$data['icon']['1']['icon'] = "fa-user";
			$data['icon']['1']['color'] = "orange";
			$data['activity'] 	= $this->admin->getActivityUser(false,$this->config->item("limit_activity_page"));				
			if($this->input->post("json") == '1')
			{
				if($this->config->item("activity_module") != '1')
					show_404();
				$x=0;
				foreach ($data['activity']->result_array() as $row) 
				{
					//if($x==0)
					//{
						$row['date'] = ago(strtotime($row['date']));
						$json[] = $row;	
						$x++;
					//}
					
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
			}
			else
			{
				if($this->config->item("activity_module") == '1')
					return $this->load->view(getTemplate('activity'),$data,$return);	
				else
				{					
					return $this->getTopTracks();
				}
			}
			
			
		}	
		else
		{
				$trg = explode("-",$this->config->item("start"));
				if($this->config->item("start") == "TopArtist")
					return $this->getTopArtist($return);
				if($this->config->item("start") == "topArtistCustom")
					return $this->getTopArtistCustom($return);
				if($this->config->item("start") == "TopTracks")
					return $this->getTopTracks($return);	
				if($this->config->item("start") == "Activity")
					return $this->getActivity($return);
				if($this->config->item("start") == "SearchBox")
					return $this->getSearchBox($return);
				if($trg[0] == "page")
				{
					return $this->getPage($trg[1],$return);
				}			

				
		}
	}

	function getBrandPage()
	{
			$trg = explode("::",$this->config->item("brand_link"));
			if($this->config->item("brand_link") == "newReleases")
				$data['page'] = $this->getNewReleases(true);
			if($this->config->item("brand_link") == "TopArtist")
				$data['page'] = $this->getTopArtist(true);
			if($this->config->item("brand_link") == "TopArtistCustom")
				$data['page'] = $this->getTopArtistCustom(true);
			if($this->config->item("brand_link") == "TopTracks" || $this->config->item("brand_link") == "TopTracksItunes" || $this->config->item("brand_link") == "TopTracksActivity")
				$data['page'] = $this->getTopTracks(true);	
			if($this->config->item("brand_link") == "Activity")
				$data['page'] = $this->getActivity(true);
			if($this->config->item("brand_link") == "SearchBox")
				$data['page'] = $this->getSearchBox(true);
			if($trg[0] == "page")
			{
				$data['page'] = $this->getPage($trg[1],true);
			}	
			if($trg[0] == "genres")
			{
				$data['page'] = $this->getTopTags($trg[1],true);
			}			
			echo $data['page'];

	}

	public function SaveDataUser()
	{
		if($this->session->userdata('username') == 'demo@jodacame.com')
		{
			echo "Demo Account don't have permission for this action";
			return false;
		}
		if($this->input->post("nickname"))
		{
			$nickname = $this->input->post("nickname",true);
			$nickname  = str_replace($this->config->item("badwords"), "***", $nickname);
			$nickname  = str_replace(" ", "_", $nickname);
			$nickname  = trim($nickname);
			
			$temp = $this->admin->getTable("users",array("nickname" => $nickname));
			if($temp->num_rows() > 0)
			{
				echo ___("nickname_already_registered");
			}
			else
			{
				if(strlen($nickname)<5)
				{
					echo ___("error_nickname_min");
				}
				else
				{
					if (!in_array($nickname, $this->config->item("badwords")) && strpos($nickname, "***") === FALSE) 
					{
						if($this->admin->updateTable("users",array("nickname" => $nickname),array("id" => $this->session->userdata('id'))))
						{
							$this->session->set_userdata("nickname",$nickname);
							echo "1";
						}
						else
							echo ___("msg_error_500");	
					}
					else
					{
						echo ___("msg_error_bad_words");		
					}
					
				}
			}
		}
		if($this->input->post("bio"))
		{
			$bio = $this->input->post("bio",true);	
			$bio  = str_replace($this->config->item("badwords"), "***", $bio);
			if (!in_array($bio, $this->config->item("badwords"))) 
			{	
				if($this->admin->updateTable("users",array("bio" => $bio),array("id" => $this->session->userdata('id'))))			{
					$this->session->set_userdata("bio",$bio);
					echo "1";
				}
				else
				echo ___("msg_error_500");
			}
			else
			{
				echo ___("msg_error_bad_words");	
			}
		}
		if($this->input->post("publicST")== '1')
		{
			$publicS = intval($this->input->post("publicS",true));		
			if($this->admin->updateTable("users",array("activity_global" => $publicS),array("id" => $this->session->userdata('id'))))			{
				$this->session->set_userdata("publicS",$publicS);
				echo "1";
			}
			else
			echo ___("msg_error_500");
		}

		if($this->input->post("public_chat_save"))
		{
			$public_chat = intval($this->input->post("public_chat",true));		
			if($this->admin->updateTable("users",array("public_chat" => $public_chat),array("id" => $this->session->userdata('id'))))			{
				$this->session->set_userdata("public_chat",$public_chat);				
				echo "1";
			}
			else
			echo ___("msg_error_500");
		}


	}
	public function profile($nickname = 'fake',$return = false)
	{

			if($this->config->item("use_database") == "0")
					show_404();
			if($nickname == "fake" || $nickname == '0')
				$nickname = $this->session->userdata('nickname');
			$temp = $this->admin->getTable("users",array("nickname" => decode($nickname)))  ;			
			if($temp->num_rows() == 0)
				show_404();
			$temp = $temp->result();
			$temp = $temp[0];
			$data['user'] = $temp;
			$data['icon']['1']['icon'] = "fa-user";
			$data['icon']['1']['color'] = "orange";
			$data['activity'] 	= $this->admin->getActivityUser($temp->id,$this->config->item("limit_activity_profile"));	

			$data['playlist'] 	= $this->admin->getTable("playlist",array("iduser" => $temp->id));

	
		return $this->load->view(getTemplate('profile'),$data,$return);
	}


	public function getYoutube($track,$artist)
	{
		$json['ads']  = '';
		$adsActive = false;
		$ads = explode(",", $this->config->item("audio_ads"));
		if(count($ads)>0)
		{
			$json['rand'] = rand(0,4);
			if($json['rand'] == '1')
			{				
				$json['ads'] = $ads[rand(0,count($ads)-1)];						
				
			}
		}
	
			$track 				= $this->input->get("track");	
			$artist 			= $this->input->get("artist");
			$picture 			= $this->input->get("picture");
			$replace = array('http://','https://','ftp://','ftps://','smtp://','sftp;//');
			$picture 			= str_ireplace($replace, "", $picture);
			$picture 			= "http://".$picture;

			$track = urlencode(ltrim(($track)));
			$artist = urlencode(ltrim(($artist)));
			$data = json_decode(searchYoutube($track."  ".$artist));		
			$json['id'] = $data->data->items[0]->id;
			if($json['id'] == ''  || $json['id'] == 'null')
			{
				$json['id'] = $this->config->item("custom_video_error");			
				sleep(1);
			}
			else
			{
				if($this->session->userdata('activity') != date("Y-m-d H:i") && is_logged() && $this->config->item("activity_module") == '1')
				{
						$this->session->set_userdata("activity",date("Y-m-d H:i"));
						if($this->config->item("use_database") == "1")
						{
							$this->admin->setTable("activity",array("picture" => $picture,"youtube"=>$json['id'],"track"=>decode($track),"artist" => decode($artist),"date"=> date("Y-m-d H:i:s"),"action" => "1","iduser" => $this->session->userdata('id')));						
						}
						
				}
				
			}
	

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function getRelated($track,$artist,$index = 0)
	{
		sleep(3); // Wait 3 seconds
		$track 				= $this->input->get("track");	
		$artist 			= $this->input->get("artist");	
		$track = urlencode(ltrim(($track)));
		$artist = urlencode(ltrim(($artist)));
		$data = json_decode(getSimilar($artist,$track));				
		$index = $index +3;
		/*if($index == 1)
			$index = rand(5,8);
		if($index == 2)
			$index = rand(0,4);
		if($index == 3)
			$index = rand(13,16);
		if($index == 4)
			$index = rand(9,12);		
		if($index == 5)
			$index = rand(14,20);
		if($index > 6)
			$index = rand(0,20);*/
		$data 	 = $data->similartracks->track[$index];				
		$output['track'] 	= $data->name;
		$output['artist'] 	= $data->artist->name;
		$image = $data->image[3]->text;
		$output['source'] ="Related Track";
		if($output['track'] == '')	
		{
			$index = $index-3;
			$top = json_decode(getTopTracks($artist));						
			$output['track'] 	= $top->toptracks->track[$index]->name;
			$output['artist'] 	= $top->toptracks->track[$index]->artist->name;
			$image =  $top->tracks->toptracks[$index]->image[3]->text;
			if($output['track'] != '')
			{				
				$track = ltrim($output['track']);
				$artist = ltrim($output['artist']);
				$data = json_decode(getSimilar($artist,$track));
				$data 	 = $data->similartracks->track[$index];				
				$output['track'] 	= $data->name;
				$output['artist'] 	= $data->artist->name;
				$image = $data->image[3]->text;
				$output['source'] ="Related Track 2";
			}

			if($output['track'] == '')	
			{
				sleep(3);
				$index = $index+3;
				$top = json_decode(getTopTracks($artist));						
				$output['track'] 	= $top->toptracks->track[$index]->name;
				$output['artist'] 	= $top->toptracks->track[$index]->artist->name;
				$image =  $top->tracks->toptracks[$index]->image[3]->text;		
				$output['source'] ="Top Artist";		
			}
		}

		if($image == '')
			$image = base_url()."assets/images/no-cover.png";
		$output['cover'] 	=$image;
		$output['key2'] 	= sha1($output['track'].$output['artist']);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function getTopArtist($return = false)
	{		
		$data['top'] = json_decode(getTopArtist());
		if(count($data['top']->artists->artist) <=1)
		{
			$this->config->set_item("auto_country", '0');		
			$data['top'] = json_decode(getTopArtist());
		}
		return $this->load->view(getTemplate('topArtist'),$data,$return);
	}

	public function getTopArtistCustom($return)
	{
		$data['top'] 	= getCustomTopArtist();
		return $this->load->view(getTemplate('topArtistCustom'),$data,$return);	
	}
	public function getNewReleases($return = false)
	{
		$data['releases'] = simplexml_load_string(getNewReleases(),null, LIBXML_NOCDATA);

		return $this->load->view(getTemplate('newReleases'),$data,$return);
	}
	public function getTopTracks($return = false)
	{
		if($this->config->item("top_tracks_link") == "TopTracksItunes")
		{			
			$data['top'] =  json_decode(getTopSongsItunes());
			return $this->load->view(getTemplate('topTracksItunes'),$data,$return);	
		}
		else
		{
			if($this->config->item("top_tracks_link") == "TopTracksActivity")
			{	
				$data['top'] = $this->admin->getTopTrackActivity();
				return $this->load->view(getTemplate('topTracksActivity'),$data,$return);	
			}
			else
			{
				$data['top'] = json_decode(getTopTracks());
				if(count($data['top']->tracks->track) <=1)
				{					
					$this->config->set_item("auto_country", '0');		
					$data['top'] = json_decode(getTopTracks());
				}
				return $this->load->view(getTemplate('topTracks'),$data,$return);		
			}
		}
		
		
	}
	public function getTopTags($tag,$return = false)
	{
		if($tag != "" && $tag != 'all')
		{
			$data['top'] 	= json_decode(getTopTags($tag));
			$data['title'] 	= ucwords(urldecode($tag));
			return $this->load->view(getTemplate('topTags'),$data,$return);	
		}
		else
		{
			return $this->load->view(getTemplate('topTagsList'),$data,$return);		
		}
		
	}
	public function getArtistInfo($artist,$return = false)
	{
		
		if($this->input->get("artist") != '')
			$artist 			= $this->input->get("artist");		
		$data['artist'] 	= json_decode(getArtistInfo($artist));
		$data['toptracks'] 	= json_decode(getTopTracks($artist));
		return $this->load->view(getTemplate('artistInfo'),$data,$return);
	}
	public function getSongInfo($artist = false,$track = false,$return = false,$extra = false)
	{
		
		if($this->input->post("artist") != '')
		{
			$artist 			= $this->input->post("artist");		
		}
		if($this->input->post("track") != '')
		{
			$track 			= $this->input->post("track");		
		}
		$data['song'] 	= json_decode(getTrackInfo($artist,$track));		
		$data['lyrics'] 	= json_decode(getLyric($artist,$track));		
		if($extra)
		{
			$data['artist'] 	= $extra;	
		}
		else
		{			
			$data['artist']		= json_decode(getArtistInfo($artist));
		}
		$data['toptracks'] 	= json_decode(getTopTracks($artist));			
		return $this->load->view(getTemplate('songInfo'),$data,$return);
	}
	public function getAlbums($artist)
	{
		$artist 			= $this->input->get("artist");	
		$data['artist'] 	= json_decode(getArtistInfo($artist));
		$data['albums'] 	= json_decode(getAlbums($artist));		
		$this->load->view(getTemplate('albums'),$data);
	}
	public function getEvents($artist)
	{
		
		$artist 			= $this->input->get("artist");			
		$data['events'] 	= json_decode(getEvents($artist));		
		$data['artist'] 	= $artist;		
		$this->load->view(getTemplate('events'),$data);
	}
	public function getTracksAlbums($artist,$album)
	{		
		if (!$this->input->is_ajax_request()) {
   			show_404();
			exit;
		}
		$artist 			= $this->input->get("artist");	
		$album 				= $this->input->get("album");	
		$data['album'] 		= json_decode(getTracksAlbums($album,$artist));		
		$this->load->view(getTemplate('TracksAlbum'),$data);
	}	
	public function getSearchBox($return = false)
	{			
		
		
		return $this->load->view(getTemplate('searchBox'),$data,$return);
	}	
		
	public function getLyric()
	{		
		if (!$this->input->is_ajax_request()) {
   			show_404();
			exit;
		}

		$artist 			= $this->input->get("artist");	
		$track 				= $this->input->get("track");	
		$data['lyrics'] 	= json_decode(getLyric($artist,$track));				
		$data['title'] 		= $artist ." - ".$track;				
		$this->load->view(getTemplate('lyrics'),$data);
	}	

	public function getPage($id,$return = false)
	{				
		$data['page'] 	= $this->admin->getTable("pages",array("idpage" => intval($id)),"title");		
		if($data['page']->num_rows() == 0)
			show_404();
		return $this->load->view(getTemplate('page'),$data,$return);
	}	

	public function likeActivity()
	{
		$id = intval($this->input->post("id"));
		$this->session->set_userdata('like_'.$id, "1");
		$t = $this->admin->setLike($id);
		$t = $t->result();
		$t = $t[0];
		echo number_format($t->likes);

	}

	public function myPlaylist($json = false)
	{		

		if(!is_logged())
		{
			show_404();
			exit;
		}	
		$data['myplaylist'] 	= $this->admin->getTable("playlist",array("iduser" => $this->session->userdata('id')));
		if(!$json)	
		{			
			$this->load->view(getTemplate('myPlaylist'),$data);	
		}
		else
		{

			foreach ($data['myplaylist']->result() as $row)
	   		{
	   			echo "<li ><a data-action='addto' data-id='{$row->idplaylist}' href='#'>{$row->name}</a></li>";	   			
	   		}
	   		   		

		}
		
	}
	public function saveAvatar()
	{	

		if(!file_exists("avatars"))
		{
			mkdir("avatars");
		}
		
		$avatar = addslashes($this->input->post("avatar",false));
		$file = "avatars/".sha1($this->config->item("encryption_key").$this->session->userdata('id')).".jpg";
		base64_to_jpeg($avatar,$file);
		$config['image_library'] = 'gd2';
		$config['source_image']	= $file;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	 = 360;
		$config['height']	= 360;
		$this->load->library('image_lib', $config); 
		$this->image_lib->resize();
		$this->admin->updateTable("users",array("avatar" => base_url().$file),array("id" => $this->session->userdata('id')));				

	}
	public function savePlayList()
	{
		
		if(!is_logged())
		{
			show_404();
			exit;
		}
		
		
		$action 	= intval($this->input->post("action"));
		

		// New
		if($action == 1)
		{
				$name 		= $this->input->post("name",TRUE);				
				$playlist 	= $this->input->post("playlist",TRUE);
				$playlist2 	= json_decode($playlist);
				
				if(count($playlist2)>0 || 1==1)
				{
					$data['name'] 	= $name;
					$data['iduser'] = $this->session->userdata('id');
					$data['json'] 	= $playlist;
					$json['error'] 	= "0";
					$json['msg'] 	= ___("msg_playlist_saved");
					$this->admin->setTable("playlist",$data);
					if($this->session->userdata('activity') != date("Y-m-d H:i") && is_logged())
					{
							//$this->session->set_userdata("activity",date("Y-m-d H:i"));
							//$this->admin->setTable("activity",array("date"=> date("Y-m-d H:i:s"),"action" => "2","iduser" => $this->session->userdata('id')));
					}
				}
				else
				{
					$json['error'] 	= "1";
					$json['msg'] 	= ___("error_playlist_empty");
				}
		}

		// Update
		if($action == 2)
		{
				$id 		= intval($this->input->post("id",TRUE));
				$playlista 	= json_decode($this->input->post("playlist",TRUE));
				

				$playlist 	= $this->admin->getTable("playlist",array("iduser" => $this->session->userdata('id'),"idplaylist" => $id));				
				$playlist 	= $playlist->result_array();
				$playlist2 	= json_decode($playlist[0]['json']);
				$playlistok = array_merge($playlist2,$playlista);			

				if(intval(count($playlist2) + count($playlista)) <= 500)
				{
					if(count($playlistok)>0)
					{
						
						
						$data['json'] 	= json_encode($playlistok);					
						$json['error'] 	= "0";
						$json['msg'] 	= ___("msg_playlist_saved");
						$json['title'] 	= ___("label_playlist");
						$json['content']= ___("msg_playlist_saved");
						$json['image'] 	= $playlista[0]->cover;
						$this->admin->updateTable("playlist",$data,array("iduser" => $this->session->userdata('id'),"idplaylist" => $id));
					}
					else
					{
						$json['error'] 	= "1";
						$json['msg'] 	= ___("error_playlist_empty");
					}

					}
				else
				{
					$json['error'] 	= "1";
					$json['msg'] 	= ___("error_folder_max");
				}
				
		}

		// Update
		if($action == 3)
		{
			$id 		= intval($this->input->post("id",TRUE));			
				
			if(count($id)>0)
			{	
				$json['error'] 	= "0";
				$json['msg'] 	= ___("msg_playlist_saved");								
				$this->admin->deleteTable("playlist",array("iduser" => $this->session->userdata('id'),"idplaylist" => $id));
			}
			else
			{
				$json['error'] 	= "1";
				$json['msg'] 	= ___("error_500");
			}

			
				
				
		}


		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));	

	}


	public function admin()
	{					
		if($this->config->item("use_database") == 0)
		{
			show_404();	
			exit;
		}

		if($this->session->userdata('is_admin') == 1)
		{
			return $this->load->view('dashboard/admin',NULL,true);
		}
		else
		{
			if(!is_logged())
				return $this->load->view('dashboard/login',NULL,true);	
			else
			{
				show_404();	
			}
		}
	}

	

	public function exportPlayList()
	{
		$this->load->helper('download');
		$list = $this->input->post("list");
	
		force_download("playlist.json", $list);
	}

	public function typeahead()
	{		
		$query = $this->input->get("query",true);
		$json = json_decode(searchLastFm($query));
		$x=0;
		foreach ($json->results->trackmatches->track as $key => $value) {
			if($value->image[0]->text != '')
			{
				$data[$x]['image'] 	= $value->image[0]->text;
				$data[$x]['artist'] = $value->artist;
				$data[$x]['name'] 	= $value->name;
				$data[$x]['value'] 	= $value->name.' - '.$value->artist;
				$x++;	
			}			
		}	
		$this->output->set_content_type('application/json')->set_output(json_encode($data));		
	}

	public function registerUser()
	{
			
		$email 		= addslashes($this->input->post("email",TRUE));
		$pwd1 		= $this->input->post("pwd1",TRUE);
		$pwd2 		= $this->input->post("pwd2",TRUE);
		$nickname 	= $this->input->post("nick",TRUE);
		$nickname  = str_replace($this->config->item("badwords"), "_REMOVED_", $nickname);
		$nickname  = str_replace(" ", "_", $nickname);
		$nickname  = trim($nickname);

		$temp = $this->admin->getTable("users",array("nickname" => $nickname));
		if($temp->num_rows() > 0)
		{
			$json["error"] 	= 1;
			$json["msg"] 	= ___("nickname_already_registered"). " ($nickname)";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;			
		}
		else
		{
			if(strlen($nickname)<5)
			{
				$json["error"] 	= 1;
				$json["msg"] 	= ___("error_nickname_min"). " ($nickname)";
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return false;							
			}			
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{

			$json["error"] 	= 1;
			$json["msg"] 	= ___("msg_email_not_valid"). " ($email)";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;
		}

		if($pwd1 != $pwd2)
		{
			$json["error"] 	= 1;
			$json["msg"] 	= ___("msg_password_doesnt_match");
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;
		}

		if(strlen(trim($pwd1)) <4)
		{
			$json["error"] 	= 1;
			$json["msg"] 	= ___("msg_password_min_characters");
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;
		}

		$user 				= $this->admin->getTable("users",array('username' => $email));
		if($user->num_rows > 0)
		{			
			$json["error"] 	= 1;
			$json["msg"] 	= ___("msg_email_already_registered");
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;
		}

		$data['password']	= sha1($pwd1);
		$data['username']	= $email;
		$temp 				= explode("@",$email);
		$data['names']		= $temp[0];
		//$nickname 			= $temp[0].strtoupper(random_string('alnum', 5));
		//$data['nickname']	= strtolower($nickname);
		$data['avatar']		= base_url()."assets/images/default_avatar.jpg";
		$data['nickname']	= $nickname;
		$id 				= $this->admin->setTable("users",$data);
		$user 				= $this->admin->getTable("users",array('id' => $id, 'password' => $data['password'],'username' => $data['username']));
		if($user->num_rows > 0)
		{	
			
			$data = $user->result_array();
			$this->session->set_userdata($data[0]);
			$json["error"] 		= 0;	
			$json["target"] 	= base_url()."user/".$nickname;	
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;		
			
		}
		else
		{
			$json["error"] 	= 1;
			$json["msg"] 	= ___("msg_error_500");
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return false;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));

	}

	public function login()
	{
		
		$username 	= addslashes($this->input->post("email",TRUE));
		$password 	= sha1($this->input->post("pwd1",TRUE));
		$user 		= $this->admin->getTable("users",array('username' => $username, 'password' => $password));
		if($user->num_rows > 0)
		{			
			$data = $user->result_array();
			//unset($data[0]['avatar']);
			if(strlen($data[0]['avatar'])>500)
				$data[0]['avatar'] = base_url()."assets/images/default_avatar.jpg";	
			$this->session->set_userdata($data[0]);
			$json["error"] 	= 0;	
			
		}
		else
		{
			$json["error"] 	= 1;
			$json["msg"] 	= ___("error_login");
		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}


	function logout()
	{
		$this->admin->deleteTable('online',array('iduser' => $this->session->userdata('id')));
		$this->session->unset_userdata('id');
		$this->session->sess_destroy();
		if( $this->session->userdata('facebook') == '1')
			redirect(base_url(),"music/facebook/logout");
		else
			redirect(base_url(),"refresh");
	}

	function recovery($sha1 = '')
	{

		if($this->session->userdata('username') == 'demo@jodacame.com')
		{
			return false;
		}
		
		if($sha1 !='')
		{
			if(strlen($sha1)>40 || strlen($sha1)<38 || $sha1 == sha1(''))
			{
				show_404();
				exit;
			}	
		}

		
		if($sha1 == '')
		{

			$email 				= addslashes($this->input->post("email",TRUE));				        
	        $user 				= $this->admin->getTable("users",array('username' => $email));
			if($user->num_rows > 0)
			{
				$this->load->helper('string');				
				$data['password'] 	= random_string('alnum', 10);		
				$data['link'] 		= base_url()."music/recovery/".sha1($data['password']);		      	
		        $this->email->from($this->email->smtp_user);
		        $this->email->to($email);
		        $this->email->subject(___('email_subject')." - ".$this->config->item("title"));
		        $emailTemplate		= $this->load->view('email/email',$data,true);
		        $this->email->message($emailTemplate);
		        if($this->email->send())
		        {
		        	$dataBD['recovery']= sha1($data['password']);
					$this->admin->updateTable("users",$dataBD,array("username" => $email));
					$json["error"] 	= 0;
					$json["msg"] 	= ___("email_check_email");					
		        }
		        else
		        {
		        	$json["error"] 	= 1;
					$json["msg"] 	= ___("msg_error_500");
		        }
				
			}
			else
			{
				$json["error"] 	= 1;
				$json["msg"] 	= ___("error_email_nofound");
			}
		}
		else
		{
			$user 				= $this->admin->getTable("users",array('recovery' => $sha1));
			if($user->num_rows > 0)
			{
				$data = $user->result_array();
				if($data[0]['recovery'] == '')
				{
					show_404();
					exit;
				}
				else
				{
					$dataBD['password'] = $sha1;
					$dataBD['recovery'] = '';
					$this->admin->updateTable("users",$dataBD,array("recovery" => $sha1));
					redirect(base_url()."#!/login","refresh");
				}

			}
			else
			{
				show_404();
				exit;
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));		
	}

	public function updatePassword()
	{
	
		if($this->session->userdata('username') == 'demo@jodacame.com')
		{
			return false;
		}
		$password1 	= sha1($this->input->post("password1",TRUE));
		$password2 	= sha1($this->input->post("password2",TRUE));		
	
		
		if($password1 != $password2)
		{
			$json['error'] 		= "1";
			$json['msg'] 	= ___("error_password_match");			
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}

		if(strlen($password1) < 4)
		{
			$json['error'] 		= "1";
			$json['msg'] 	= ___("error_password_min");			
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}	

		$this->admin->updateTable("users",array("password" => $password1),array("username" => $this->session->userdata('username')));

		$json['error'] 		= "0";
		$json['msg'] 		=  ___("msg_password_updated");		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
		return;

		
	}

	function getPlayList($hash = "fake")
	{
		$data['myplaylist'] 	= $this->admin->getTable("playlist",array("sha1(CONCAT('".$this->config->item("encryption_key")."',idplaylist))" => $hash));		
		$json = json_encode(array());
		if($data['myplaylist']->num_rows > 0)
		{

			$temp = $data['myplaylist']->result_array();
			$json = $temp[0]['json'];
		}
		

		$this->output->set_content_type('application/json')->set_output($json);
	}


}
