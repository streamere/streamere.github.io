<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{		
		parent::__construct();		

		
		if($this->config->item("use_database") == 1)
		{			
			$this->load->database();
			$this->load->model("dashboard/admin");								
			$this->set_config();	
			if($this->config->item("module_user_online") == 1 )
			{		
				$this->set_online();		
			}

		}
		$this->set_lang();
		$this->clean_cache();

		if($this->router->fetch_module() == 'dashboard')
		{
			$this->__dashboard();
		}
		
		
	}
	protected function set_lang()
	{		
		if($this->config->item("user_change_lang") == "1")
        {
    	   	if($this->input->get("lang"))
	        {	        	
	        	if(in_array($this->input->get("lang"),$this->config->item("langs_available")))
	        	{	        		
	        		$this->config->set_item("lang",$this->input->get("lang"));
	        		$this->session->set_userdata('lang', $this->input->get("lang"));
	        	}
	        }
	        else
	        {
	        	if($this->session->userdata('lang') != '')
	        		$this->config->set_item("lang",$this->session->userdata('lang'));
	        }	        
        }
        $this->lang->load($this->config->item("lang"),$this->config->item("lang"));     	

	}

	protected function clean_cache()
	{
		if(exec('echo EXEC') == 'EXEC')
		{
			if($this->config->item("clean_cache") != '0')
			{				
				exec("find  ".getcwd()." -type f -name '*.cache' -mtime +".$this->config->item("clean_cache")." -exec rm {} \;");					
			}
			
		}
	}

	protected function set_online()
	{
		$this->admin->setUsuarioOnline(intval($this->session->userdata('id')));
	}
	protected function set_config()
	{		

		$config 	= $this->admin->getTable("settings");		
		if($config->num_rows() == 0)
		{
			show_error("No settings founds in your database",400);
		}
		foreach ($config->result_array() as $row)
		{
			
			if($row['var'] != 'use_database')
			{
				if($row['var'] == 'langs_available')
				{

				    $this->load->helper('directory');
				    $langs = directory_map('./application/language');
				    foreach ($langs as $key => $value) {
				    	 $temp[] = $key;				    	
				    }				    
					$row['value'] = $temp;					 
				}								
				if($row['var'] == 'theme')
				{
					if($_GET['skin'])
					{
						$row['value'] = $_GET['skin'];
					}
				}
				if(!is_array($row['value']))
				{
					//$row['value'] = str_ireplace('"', "'",$row['value']);
					$row['value'] = str_ireplace('\"', '"',$row['value']);
					$row['value'] = str_ireplace("\'", "'",$row['value']);
					$row['value'] = html_entity_decode($row['value']);	
					
				}
				
				$this->config->set_item($row['var'], $row['value']);	

				
				if($this->agent->is_mobile())
					$this->config->set_item("theme", $this->config->item("theme_mobile"));									
			}
			
		}

		

		   $config = Array(
        		'protocol' => 'smtp',
        		'smtp_host' => $this->config->item("smtp_host"),
        		'smtp_port' => $this->config->item("smtp_port"),
        		'smtp_user' => $this->config->item("smtp_user"), // change it to yours
        		'smtp_pass' => $this->config->item("smtp_pass"), // change it to yours
        		'mailtype' => 'html',
        		'charset' => 'utf-8',
        		'wordwrap' => TRUE
    	);
		$this->load->library('email',$config);	
	}

	protected function __dashboard()
	{
		if($this->config->item("use_database") == 0)
		{
			show_404();	
		}
		if(!is_logged() && $this->router->method != 'login'  && $this->router->method != 'logout' )
		{
			redirect(base_url()."dashboard/login");
		}			
		if($this->session->userdata('is_admin') != 1 && $this->router->method != 'login')
		{
			//redirect(base_url(),"refresh");
			redirect(base_url()."dashboard/login");
		}
		else{
			if($this->session->userdata('username') == 'demo@jodacame.com' && $this->router->method != 'login')
			{
				if($this->router->method == 'website')
				{
					$this->config->set_item("lastfm", 'lastfmdemomodeapikey');			
				}
				if($_POST || $this->router->method == 'smtp' || $this->router->method == 'license' || $this->router->method =='users'  || $this->router->method =='lyrics'  )
				{
					show_error("Demo Account don't have permission for this action",403);
				}
					
			}
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
							//echo $this->db->last_query()."<br>";	
						}						
					}				
					$this->db->query("UPDATE settings SET value = '$MD5' WHERE var='md5updated';");					
					$this->session->sess_destroy();					
					//echo $this->db->last_query()."<br>";
					redirect(base_url()."dashboard/login/1");
				}				
				
			}

			if(file_exists("install.sql"))
			{
				$sql 	= file_get_contents("install.sql");
				$sqls 	= explode(";\n",$sql);
				foreach ($sqls as $key => $value) {								
					if($value != '')
					{
						$this->db->query($value);
						//echo $this->db->last_query()."<br>";	
					}						
				}			
				unlink("install.sql");
				redirect(base_url()."dashboard/login/2");
			}								
			


			// Check install modules


			
		}

		if($this->config->item("purchase_code") == '' or strlen($this->config->item("purchase_code"))<20)
		{
			if($this->session->userdata('is_admin') == 1 && $this->router->method != 'login' && $this->router->method != 'license' && $this->router->method != 'logout' && is_logged())
			{			
				redirect(base_url()."dashboard/license");
			}

		}				
		
	}
}

