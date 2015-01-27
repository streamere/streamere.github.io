<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends MY_Controller {

	public function __construct()
	{		
		parent::__construct();			
	}

	public function login($updated = 0)
	{
	
		if($this->input->post())
		{
			$username 	= addslashes($this->input->post("username",TRUE));
			$password 	= sha1($this->input->post("password",TRUE));
			$user 		= $this->admin->getTable("users",array('username' => $username, 'password' => $password, 'is_admin' => '1'));
			if($user->num_rows > 0)
			{			
				$data = $user->result_array();			
				if(strlen($data[0]['avatar'])>500)
					$data[0]['avatar'] = base_url()."assets/images/default_avatar.jpg";	

				$this->session->set_userdata($data[0]);
				redirect(base_url()."dashboard/website");
			}
			else
			{
				$this->load->view('dashboard/pages/login',array("error" => ___("error_login")));
			}
		}
		else
		{
			if($updated == 1)
				$msg = 'System has been updated! <br>Please login Again.';
			if($updated == 2)
				$msg = 'Module has been updated! <br>Please login Again.';
			$this->load->view('dashboard/pages/login',array("error" => false,"msg" => $msg));
		}
		
	}

	public function admin()
	{
		/* TODO:
		LOGIN REDIRECT
		*/
		redirect(base_url()."dashboard");
	}

	public function lyrics()
	{
		if($this->input->get('remove'))
		{
			$this->admin->deleteTable('lyrics',array("idlyrics" => intval($this->input->get('remove'))));
		}
		$DATA 				= array();				
		$DATA['title'] 		= 'Lyrics - List';
		$DATA['active']		= 'lyrics';				
		$DATA['active2']	= 'lyrics';						
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/lyrics',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function lyric()
	{
		$DATA 				= array();				
		if($this->input->post("artist"))
		{
			$_data['artist'] = $this->input->post('artist');
			$_data['track'] = $this->input->post('track');
			$_data['lyric'] = nl2br($this->input->post('lyric'));
			if(intval($this->input->post("id"))>0)
			{
				$this->admin->updateTable('lyrics',$_data,array('idlyrics' => intval($this->input->post("id"))));
				$DATA['msg'] = 'Updated!';
			}
			else
			{				
				$this->admin->setTable('lyrics',$_data);
				$DATA['msg'] = 'Saved!';
			}
			

		}
		$id = intval($this->input->get("id"));
		
		$DATA['title'] 		= 'Lyrics - Add/Edit';
		$DATA['active']		= 'lyrics';				
		$DATA['active2']	= 'lyric';				
		$DATA['lyric']		= $this->admin->getTable("lyrics",array("idlyrics" => $id),"idlyrics");						
		$DATA['lyric']		= $DATA['lyric']->row();
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/lyric',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function all_lyrics()
	{
		$status['B']['style'] 	= 'default';
		$status['B']['text'] 	= 'BORRADOR';

		$status['P']['style'] 	= 'success';
		$status['P']['text'] 	= 'PUBLICO';


	/*
	* Ordering
	*/	$sOrder = false;
		if ($this->input->get('iSortCol_0') || 1==1)
		{
			$columns[0] = 'idlyrics';
			$columns[1] = 'artist';
			$columns[2] = 'track';						
			$columns[3] = 'idlyrics';						
			$columns[3] = 'lyric';						
			$sOrder = $columns[$this->input->get('iSortCol_0')]." ".$this->input->get('sSortDir_0');			
		}
		$like= false;
		if ($this->input->get('sSearch') != "" )
		{
			foreach ($columns as $key => $value) {
				$like[$value]	= $this->input->get('sSearch');
			}
			
		}
		$lyrics 				= $this->admin->getTable("lyrics",false,$sOrder,'idlyrics,artist,track',$this->input->get('iDisplayLength'),$this->input->get('iDisplayStart'),$like);	
		
		$total 					= $this->admin->getTable("lyrics",false,$sOrder,'idlyrics,artist,track',false,false,$like);	
		$total 					= $total->num_rows();
		$output = array(
		"sEcho" => intval($this->input->get('sEcho')),
		"iTotalRecords" => $total,
		"iTotalDisplayRecords" => $total,
		"aaData" => array()
		);
		foreach ($lyrics->result_array() as $key => $value) {
			$row = array();		
			
			$row[] = $value['artist'];
			$row[] = $value['track'];			
			$row[]	= '<a class="btn btn-warning btn-xs" href="'.base_url().'dashboard/lyric?id='.$value['idlyrics'].'"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger btn-xs" href="?remove='.$value['idlyrics'].'"><i class="fa fa-trash-o"></i></a>';
			
			$output['aaData'][] = $row;
		}
		
		echo json_encode( $output );
	}

	public function index()
	{		
		if($this->input->post("cache"))
		{
			$this->load->helper('file');
			delete_files("./cache/");
			write_file('./cache/.htaccess', 'Deny from all');
			//mkdir("./cache");
			redirect(base_url().'dashboard');
		}

		$DATA 				= array();

		$DATA['database'] 	= getInfoDatabase();
		
		$this->load->helper('file');
		/*$dir 				= get_dir_file_info("./cache/",FALSE);
		

		foreach ($dir as $key => $value) {
			$size += $value['size'];
		}*/

		$DATA['sizeDir']  		= '0';
		$DATA['used']  		= '0';
		if(function_exists('disk_free_space'))
			$DATA['sizeDir'] 	= disk_free_space("./cache/");
		if(function_exists('disk_total_space'))
		$DATA['used']		= disk_total_space("./cache/") - $DATA['sizeDir'];


		$DATA['active']		= 'dashboard';
		$DATA['history']	= $this->admin->getRegisteredUsersByMonth();
		$DATA['users'] 		= $this->admin->getCountTable("users");
		$DATA['playlist'] 	= $this->admin->getCountTable("playlist");
		$DATA['activity'] 	= $this->admin->getCountTable("activity");
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/dashboard',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}




	public function users()
	{		

		$DATA 				= array();
		$DATA['title'] 		= 'Users';
		$DATA['active']		= 'users';
		$DATA['users'] 		= $this->admin->getTable("users",false,"id");			
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/users',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}	

	public function online()
	{		

		$DATA 				= array();
		//$DATA['title'] 		= 'Users Online';
		$DATA['active']		= 'online';		
		$DATA['users'] 		= getUsersOnline();
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/online',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function codecanyon()
	{		

		$DATA 				= array();
		$DATA['title'] 		= 'Youtube Music Engine - Addons';
		$DATA['active']		= 'codecanyon';		
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/codecanyon',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function install()
	{		
		$DATA 				= array();


		if($this->input->post("uploading"))
		{			
			if(!file_exists('./uploads/'))
			{
				mkdir('./uploads/');
			}
			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= 'zip';
			$config['overwrite'] 		=  true;
			$config['remove_spaces']	=  true;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('upload'))
			{
				$DATA['upload'] = array('error' => $this->upload->display_errors());				
			}
			else
			{
				$DATA['upload'] = array('upload_data' => $this->upload->data());
				$this->load->library('unzip');
				$file = './uploads/'.$DATA['upload']['upload_data']['file_name'];
				if(file_exists($file))
				{					
					$this->unzip->extract($file, './');	
					$errorZip = strip_tags($this->unzip->error_string());
					if($errorZip != '')
						$DATA['upload'] = $errorZip;
					@unlink($file);
				}
				else
				{
					$DATA['upload'] = array('error' =>'File '.$file." not exist");	
				}
				
				
			}
		}
		
		$DATA['title'] 		= 'Install Module or Update';
		$DATA['active']		= 'install';		
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/install',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}



	public function website()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/website');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Website';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'website';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/website',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function comments()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/comments');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Comments & Social Network';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'comments';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/comments',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function themes_setting()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/themes_setting');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Current Theme';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes_setting';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes_setting',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function ads()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/ads');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - '. ___("admin_advertising");
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'ads';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/ads',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function smtp()
	{	
		
		$DATA 				= array();
		if($this->input->post())
		{
			if($this->input->post("target"))
			{
			
				$this->email->from($this->config->item("smtp_user"),$this->config->item("title"));
				$this->email->to($this->input->post("target")); 
				$this->email->subject('Email Test');
				$this->email->message('Testing the email config');	
				if($this->email->send())
				{
					$DATA['error'] = '1';
				}
				else
				{
					$DATA['error'] = $this->email->print_debugger();
					

				}
			}
			else
			{
				foreach ($this->input->post() as $key => $value) {
					$value 	= addslashes($value);				
					$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
				}	
				redirect(base_url().'dashboard/smtp');

			}
					
			
		}

	
		$DATA['title'] 		= 'Settings - SMTP Server';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'email';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/email',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function gui()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/gui');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - GUI';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'gui';	
		$DATA['pages']		= $this->admin->getTable("pages",false,"title");			
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/gui',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function themes()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			


			$setting_file = './assets/css/themes/'.$this->input->post("theme").'/'.$this->input->post("theme").'.conf';
			$config = array();
			if(file_exists($setting_file))
			{
				$setting_file = file_get_contents($setting_file);
				$temp = explode("\n", $setting_file );	
				foreach ($temp as $key => $value) {
					$temp2 = explode(":", $value);
					$config[$temp2[0]] = $temp2[1];
				}	
			}

			if($config['setting_theme'] !== 'false')
				redirect(base_url().'dashboard/themes_setting');
			else
				redirect(base_url().'dashboard/themes');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Themes Desktop';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function themes_mobile()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/themes_mobile');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Themes Mobile';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'themes_mobile';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/themes_mobile',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function genres()
	{		
		if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				if(is_array($value))
					$value = implode($value, ",");			
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
				
			}			
			
			redirect(base_url().'dashboard/genres');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Genres';
		$DATA['active']		= 'settings';				
		$DATA['active2']	= 'genres';				
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/genres',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function page_artist()
	{
		if($this->input->post('artist'))
		{
			$this->admin->setTable('top_page_artist',array('cover' => $this->input->post('cover'),'artist' => $this->input->post('artist')));			
		}
		if($this->input->post('idremove'))
		{
			$this->admin->deleteTable('top_page_artist',array('id' => intval($this->input->post('idremove'))));			
		}

		$DATA 				= array();				
		$DATA['title'] 		= 'Page - Top Artist';
		$DATA['active']		= 'pages';						 
		$DATA['active2']	= 'page_artist';						
		$DATA['page']		= $this->admin->getTable('top_page_artist');
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/page_artist',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}

	public function list_pages()
	{
		$DATA 				= array();				
		$DATA['title'] 		= 'Page - List';
		$DATA['active']		= 'pages';				
		$DATA['active2']	= 'list_pages';				
		$DATA['pages']		= $this->admin->getTable("pages",false,"title");
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/list_pages',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}


	public function page( $id= 0)
	{
		$DATA 				= array();	
		if($this->input->post("id") >= 0 && $this->input->post("title",true) != '')
		{
			$title 		= $this->input->post("title",true);
			$content 	= $this->input->post("content",FALSE);					
			if(intval($this->input->post("id")) > 0)
			{
				$this->admin->updateTable("pages",array("title" => $title, "content" => $content),array("idpage" => intval($this->input->post("id") )));
			}
			else
			{
				$this->admin->setTable("pages",array("title" => $title, "content" => $content));
				redirect(base_url().'dashboard/list_pages');
			}
			

		}
		$DATA['editpages'] = false;
		if(intval($id) > 0)
		{
		
				$DATA['editpages']	= $this->admin->getTable("pages",array("idpage" => intval($id)),"title");	
		}

					
		$DATA['title'] 		= 'Page - new Page';
		$DATA['active']		= 'pages';				
		$DATA['active2']	= 'page';				
		$DATA['pages']	= $this->admin->getTable("pages",false,"title");
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/page',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);
	}











	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."dashboard/login");
	}
	public function module($module)
	{		

		// Check Evato
		
		if($module != 'upgrade')
		{
			$data = false;
			if($module == 'dashboard')
			{
				$data['users'] 		= $this->admin->getCountTable("users");
				$data['playlist'] 	= $this->admin->getCountTable("playlist");
				$data['users_today']= $this->admin->usersToday();
				$data['history']	= $this->admin->getRegisteredUsersByMonth();
			}
			if($module == 'users')
			{
				$data['users'] 		= $this->admin->getTable("users",false,"id");	
	
			}
			if($module == 'license')
			{
				
				$data['license'] 	= json_decode(_curl("http://api.andthemusic.net/music/verifyInfo/".$this->config->item("purchase_code")));					 		
	
			}
			if($module == 'pages')
			{
				if($this->input->post("id") >= 0 && $this->input->post("title",true) != '')
				{
					$title 		= $this->input->post("title",true);
					$content 	= $this->input->post("content",FALSE);					
					if(intval($this->input->post("id")) > 0)
					{
						$this->admin->updateTable("pages",array("title" => $title, "content" => $content),array("idpage" => intval($this->input->post("id") )));
					}
					else
					{
						$this->admin->setTable("pages",array("title" => $title, "content" => $content));
					}
					

				}
				$data['editpages'] = false;
				if(intval($this->input->post("id_page")) > 0)
				{
					if($this->input->post("remove") == '1')	
					{
						$this->admin->deleteTable("pages",array("idpage" => intval($this->input->post("id_page"))));
					}
					else
						$data['editpages']	= $this->admin->getTable("pages",array("idpage" => intval($this->input->post("id_page"))),"title");	
				}
				$data['pages']	= $this->admin->getTable("pages",false,"title");
			}

			$temp 	= $this->session->userdata('purchase_code');
			if($temp == '1' || $temp == '')
			{
				$temp 	= _curl("http://api.andthemusic.net/music/verify/".$this->config->item("purchase_code"));		
			}			
			if($temp == '1')
			{		
				$this->session->set_userdata("purchase_code",$temp);
				$this->load->view('dashboard/'.$module,$data);	
			}
			else
			{				
				$data['error'] = $temp;
				$this->load->view('dashboard/purchase',$data);	
			}

		}
		else
		{
			// Upgrade
			if(file_exists("upgrade/upgrade.sql"))
			{
				$MD5 = md5_file("upgrade/upgrade.sql");
				if($this->config->item("md5updated") != $MD5)
				{
					$sql 	= file_get_contents("upgrade/upgrade.sql");
					$sqls 	= explode(";\n",$sql);
					foreach ($sqls as $key => $value) {								
						if($value != '')
						{
							$this->db->query($value);
							echo $this->db->last_query()."<br>";	
						}						
					}				
					$this->db->query("UPDATE settings SET value = '$MD5' WHERE var='md5updated';");					
					$this->session->sess_destroy();					
					//echo $this->db->last_query()."<br>";
				}
				else
				{
					echo "You have the last version!";
				}
				
			}
			else
			{
				echo ":)";
			}			

			echo "<script>location.reload();</script>";
		}
		
	}
	public function purchase()
	{
		$key			 		= addslashes($this->input->post("licence",TRUE));	
		$temp 					= _curl("http://api.andthemusic.net/music/verify/".$key);	
		$data['purchase_code'] 	= $key;			
		if($temp == '1')
		{
			$data['error'] 		= "<div class='alert alert-success'><strong>Thank You!</strong> Purchase Code Valid</div>";
			$this->session->set_userdata("purchase_code",$temp);		
			$this->admin->updateTable("settings",array("value" => $key),array("var" => "purchase_code"));
		}
		else
		{
			$data['error'] = $temp;
		}		
		$this->load->view('dashboard/purchase',$data);	

	}
	public function saveSetting()
	{		
		$target = addslashes($this->input->post("target",TRUE));
		$value 	= str_ireplace("xcript", "script", addslashes(urldecode($this->input->post("value",TRUE))));
		$this->admin->updateTable("settings",array("value" => $value),array("var" => $target));
	}

	public function removeUser()
	{
		$this->admin->deleteTable("users",array("id" => intval($this->input->post("id"))));
	}

	public function updateUser()
	{		
		$password 	= sha1($this->input->post("pwd",TRUE));
		$password2 	= sha1($this->input->post("pwd2",TRUE));
		$passwordC 	= sha1($this->input->post("pwdc",TRUE));
		$email 		= $this->input->post("email",TRUE);
	
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Email not Valid!";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}
		if($password != $password2)
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Password doesn\'t match!";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}

		if(strlen($password) < 4)
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Password need min 5 characters";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}
		$user 		= $this->admin->getTable("users",array('username' => $this->session->userdata('username'), 'password' => $passwordC, 'is_admin' => '1'));
		if($user->num_rows == 0)
		{
			$json['title'] 		= "Error";
			$json['content'] 	= "Current Password doesn\'t match";
			$json['color'] 		= "#8E0000";
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}

		$this->admin->updateTable("users",array("password" => $password,"username" => $email),array("username" => $this->session->userdata('username'),"password" => $passwordC));

		$json['title'] 		= "Update";
		$json['content'] 	= "Account Updated!";		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
		return;
	}

	public function facebook_setting()
	{
			        
    if($this->input->post())
		{
			foreach ($this->input->post() as $key => $value) {
				$value 	= addslashes($value);				
				$this->admin->updateTable("settings",array("value" => $value),array("var" => $key));
			}			
			redirect(base_url().'dashboard/facebook_setting');
		}

		$DATA 				= array();
		$DATA['title'] 		= 'Settings - Facebook Login';
		$DATA['active']		= 'facebook';									
		$DATA['_SIDEBAR'] 	= $this->load->view('dashboard/template/_sidebar',$DATA,TRUE);
		$DATA['_NAVBAR'] 	= $this->load->view('dashboard/template/_navbar',$DATA,TRUE);
		$DATA['_PAGE'] 		= $this->load->view('dashboard/pages/facebook_settings',$DATA,TRUE);
		$this->load->view('dashboard/template/admin',$DATA);   
    
	}



}

