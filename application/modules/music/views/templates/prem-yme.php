<!DOCTYPE html>
<html lang="en">
  <head>
<?php echo $this->load->view("templates/common/_header",false,true); ?>

  </head>

  <body>
  <div id="fb-root"></div>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
        

          <?php echo $this->config->item("brand"); ?></a>
          <form class="navbar-form navbar-right" id="frmSearch" role="form" >
            <div class="form-group">
              <input autocomplete="OFF"   type="text" class="form-control" style="width:300px" id="s" placeholder="<?php echo ___("label_listen"); ?>" value="<?php echo $search; ?>">
            </div>         
            <button class="btn btn-primary" id="btnSearch" type="button" title="<?php echo ___("label_search"); ?>"> <i class="fa fa-search"></i></button>
          </form>

        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">     

                        <?php if($this->config->item('random_button') == '1'){ ?>
                          <li id="random" title="<?php echo ___("label_random"); ?>"><a href="#"><i class="fa fa-random"></i></a></li>       
                        <?php } ?>
                        <li class="active" id="stopRadio" style="display:none" onClick="stop_radio();"><a href="#"><img src="<?php echo base_url(); ?>assets/images/bars.gif"> <?php echo ___("label_stop_radio"); ?></a></li>                                                 
                       


                         <li class="dropdown" id="shareMenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo ___("label_share"); ?>"><i class="fa fa-share-square"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="#" onClick="share('fb');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
                              <li><a href="#" onClick="share('tw');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
                              <li><a href="#" onClick="share('gp');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>                              
                              <li><a href="#" onClick="share('c');return false;"><i class="fa fa-link"></i> Copy Link</a></li>                              
                            </ul>
                          </li>


                        
                          <li  id="tagsLink">
                      <a href="<?php echo base_url(); ?>tag/all" class="removehref"><?php echo ___("label_genres"); ?> </a>
                      
                    </li>

                    
                 
                         <li id="nowPlaying" title="<?php echo ___("label_now_playing"); ?>"><a href="#" onClick="return false;"><i class="fa fa-info-circle"></i></a></li>
                          <?php if($this->config->item("user_change_lang") == "1")
                          {?>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ___("label_language"); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu" id="tags">
                              <?php foreach ($this->config->item("langs_available") as $key => $value) {
                                ?>
                                <li><a href="?lang=<?php echo $value; ?>"><?php echo ucfirst($value); ?></a></li>
                                <?php
                              }
                              ?>
                            </ul>
                          </li>
                          <?php } ?>

                            <?php
                            if($this->session->userdata('is_admin') == 1 && $this->config->item("use_database") == 1)
                            {
                              ?>
                              <li id="admin"><a href="<?php echo base_url(); ?>dashboard"><span  class="label label-danger">Admin</span></a></li>
                              <?php

                            }
                            ?>

                             

                          <?php if($pages){if($pages->num_rows()>0){ ?>
                         <li class="dropdown" id="shareMenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><?php echo ___("label_page"); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <?php foreach ($pages->result() as $row) {
                                ?>
                                <li><a href="#" onClick="showPage('<?php echo $row->idpage; ?>');return false;"> <?php echo $row->title; ?></a></li>                                                            
                                <?php
                              }}
                              ?>
                              
                            </ul>
                          </li>
                          <?php } ?>
          </ul>
           
        </div>
      </div>
    </div>

    

    <div id="player-container">
      
        <div class="controls" id="controls">         

            <button class="btn btn-primary" onClick="playBackSong();"><i class="fa fa-step-backward"></i></button>
            <button class="btn btn-primary" id="play" onClick="playNextSong(0)"><i class="fa fa-play"></i></button>            
            <button class="btn btn-primary" id="pause" style="display:none" onClick="pause();"><i class="fa fa-pause"></i></button>            
                <?php if($this->config->item("amazon_afiliate") != '')
            {
              ?><button id="amazon" data-amazon="<?php echo $this->config->item("amazon_afiliate"); ?>" class="btn btn-warning amazon" title="<?php echo ___("label_buy_on_amazon"); ?>"><i class="fa fa-shopping-cart"></i> </button><?php
            }
            ?>

            <button class="btn btn-primary" onClick="playNextSong();"><i class="fa fa-step-forward"></i></button>
            <button class="btn btn-primary" id="playlist-items-btn" onClick="$('#playlist-items').slideToggle(200);"><i id="playlist-items-btn2" class="fa fa-list"></i> <span class="label label-info pull-right" id="numItems"></span></button>
          

        </div>        
        <div class="search" style="padding-top:10px;">
                            
                             
                            <?php if($this->config->item('download_button') == '1'){ ?>
                            <button type="button" id="downloadmp3" title="<?php echo ___("label_mp3_title"); ?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-cloud-download"></i> <?php echo ___("label_mp3"); ?>
                            </button>
                            <?php } ?>
                            <?php if($this->config->item('lyrics_button') == '1'){ ?>
                             <button type="button" id="lyric" title="<?php echo ___("label_lyrics_title"); ?>" class="btn btn-primary btn-xs">
                               <i class="fa fa-align-center"></i> <?php echo ___("label_lyrics"); ?>
                            </button>
                            <?php } ?>
                             <?php if($this->config->item('volume_control') == '1'){ ?>
                            <input type="text" id="volume" class="col-xs-12" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100" data-slider-orientation="horizontal" data-slider-selection="after"data-slider-tooltip="hide">
                            <?php } ?>


               
        </div>
        <div class="display">
          <div class="display-panel">

              <div class="info">
               <div id="thumbnail" class="hidePlayer"  data-html="true" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo ___("msg_play_player"); ?>">
          
              <div id="player">  
                <div id="ytapiplayer">You need flash!</div>
              </div>
               <a href="<?php echo $this->config->item("link_cover_player"); ?>"><img src="<?php echo base_url(); ?>assets/images/no-cover.png"></a>

            </div> 

                  <span  id="trackInfo"></span>
                  <span>-</span>
                  <span id="artistInfo"></span>                  
                  <span  id="loaded">&nbsp;</span>
                  <small>
                    <span class="pull-right" disabled id="tracktime">00:00</span> 
                    <span class="pull-right" disabled>/</span>
                    <span class="pull-right" disabled id="tracktime2">00:00</span> 
                  </small>

              </div>
              <div id="current" class="progress">
                <div class="progress-bar progress-bar-info" style="width:0%"></div>                            
              </div>
              <div id="buffer" class="progress">
                <div class="progress-bar progress-bar-info"></div>
              </div>
          </div>
        </div>
     
    </div>

    <div class="container-fluid">
      <div class="row">
       <div id="playlist-items">
      </div>

        <div class="sidebar" id="sidebar" >
          <div class="sidebar-menu">
            <ul class="nav nav-sidebar">
              <li class="title">
              <a href="#"><i class="fa fa-bookmark-o "></i> <?php echo ___("label_top"); ?></a>
              </li>
                                    <li id="topArtist"><a href="#"><i class="fa fa-star"></i> <?php echo ___("label_artist"); ?></a></li>
                                    <li id="topTrack"><a href="#"><i class="fa fa-music"></i> <?php echo ___("label_track"); ?></a></li>                                                                
                                </ul>

              <ul class="nav nav-sidebar">
               <?php if($this->config->item('registration') == "1" && is_logged()) { ?>          
                <li class="active"><a href="#" ><i class="fa fa-user"></i> <?php echo $this->session->userdata('nickname'); ?> </a></li>
                <li><a href="#" onClick="myPlaylist();"><i class="fa fa-folder-open-o"></i> <?php echo ___("label_music_folder"); ?></a></li>
                <li><a href="#" onClick="changePassword();"><i class="fa fa-lock"></i> <?php echo ___("label_change_password"); ?></a></li>
                <li><a href="#" onClick="profile();"><i class="fa fa-user"></i> <?php echo ___("label_profile"); ?></a></li>
                <li><a  href="<?php echo base_url(); ?>music/logout" id="navLogin"><i class="fa fa-sign-out"></i> <?php echo ___("label_logout"); ?></a></li>
                <?php } ?>

                 <?php if($this->config->item('registration') == "1" && !is_logged()) { ?>
                   
                            <li  id="menuLogin" class="active">
                              <a  href="#" id="navLogin"><?php echo ___("label_login"); ?></a>                         
                            </li>
                     
                          <?php } ?>

              </ul>
            
              <ul class="nav nav-sidebar" id="changePlaylist">
             
                   <li class="title"><a href="#"><i class="fa fa-list"></i> <?php echo ___("label_playlist"); ?></a></li>
                        
                        <?php for($x=1;$x<=intval($this->config->item("nplaylist"));$x++)
                                  {
                                    ?><li  data-playlist="<?php echo $x; ?>" class="playlist_<?php echo $x; ?> text-muted"><a href="#"><?php echo ___("label_load_playlist"); ?> <?php echo $x; ?></a></li><?php
                                  }
                                  if($this->config->item('use_database') == 1 && is_logged())
                                  {
                                    ?>
                                    <li class="divider"></li>                                
                                      <li><a href="#" id="save_as_playlist"><i class="fa fa-save"></i> <?php echo ___("label_save_as_playlist"); ?></a></li>
                                    <?php
                                  }
                                  ?>
                                 <?php if($this->config->item('export_playlist') == "1"){ ?>
                                <li onClick="exportPlayList();"><a href="#"><i class="fa fa-download"></i> <?php echo ___("label_export_playlist"); ?></a></li>
                                <li onClick="importPlayList();"><a href="#"><i class="fa fa-upload"></i> <?php echo ___("label_import_playlist"); ?></a></li>
                                <?php } ?>
                                <li  onClick="clearPlaylist();" ><a href="#"><i class="fa fa-trash-o"></i> <?php echo ___("label_clear_playlist"); ?></a></li>
                      </ul>
                
         
            </div>


         

        </div>
        <div class="main">
            <!-- MAIN -->
            <?php if($this->config->item("ads_refresh") == '0'){ ?>
              <center class="adsblock"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></center><br><br>
            <?php } ?>
            <div class="page-content inset" id="target">            
            <?php if($this->config->item("lastfm") == '')
            {
              ?>
              <div class="alert alert-danger">
                <strong>Error Api KEY</strong> Remember config your api key
              </div>
              <?php 
            }
            ?>

            <?php if(!is_writable_cache())
            {
              ?>
              <div class="alert alert-danger">
                <strong>Error Cache Folder</strong> Please allow read/write persmission (777) to the cache folder in your root.
              </div>
              <?php 
            }
            ?>

            <?php echo $page; ?>
            </div>
            <div class="clearfix"></div>
         
              <center class="adsblock"><?php if(!$hide_ads){ echo $this->config->item("ads_block_footer"); } ?></center><br><br>
       
              <div style="text-align:center;width:100%">
                <?php echo $this->config->item("footer_text"); ?> 
              </div> 
            <!-- /MAIN -->
        </div>
      </div>
    </div>


    <!-- MODALS -->

    <div class="modal" id="popup">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo $this->config->item("title"); ?></h4>           
          </div>
          <div class="modal-body">
                <center>
                    <?php echo $this->config->item("popup_code"); ?>
                </center>
          </div>          
        </div>
      </div>
    </div>

     <div class="modal" id="importPlayList">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("msg_import_playlist"); ?></h4>           
          </div>
          <div class="modal-body">                
                <div class="alert alert-info"><?php echo ___("msg_select_json"); ?><br><strong><?php echo ___("msg_target"); ?>:</strong> <span id="pltrg"></span></div>
                <input type="file" id="files" name="files" />
          </div>          
        </div>
      </div>
    </div>

    <div class="modal" id="customShare">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_share"); ?></h4>           
          </div>
          <div class="modal-body">                     
                <textarea readonly style="width:100%;min-height;100px"></textarea>
                <p>Copy and share link</p>
          </div>          
        </div>
      </div>
    </div>

     <div class="modal" id="savePlaylistModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_new_playlist"); ?></h4>           
          </div>
          <div class="modal-body">   
                <div class="alert alert-info">
                  <?php echo ___("msg_save_playlist"); ?>
                </div>                  
             
                <div class="form-group">
                  <label for="namePlaylist"><?php echo ___("label_name_playlist"); ?></label>
                  <input type="text" class="form-control" id="namePlaylist" placeholder="<?php echo ___("label_name_playlist"); ?>">
                </div>               
                <button type="button" onClick="savePlayListDB()" class="btn btn-default pull-right"><?php echo ___("label_save_playlist"); ?></button>
                <div class="clearfix"></div>
              
          </div>          
        </div>
      </div>
    </div>

    <?php if(!is_logged())
    {
    ?>
    <div class="modal" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_login"); ?></h4>           
          </div>
          <div class="modal-body loginModal">
              <form class="form-signin" role="form">
                <div id="loginForm" >
                  <h3 class="form-signin-heading"><?php echo ___("label_sing_in"); ?></h3>
                  <input type="email" name="email" class="form-control" placeholder="<?php echo ___("label_email"); ?>" required autofocus>
                  <input type="password" name="password1" class="form-control" placeholder="<?php echo ___("label_password"); ?>" required>          
                  <a href="#" onClick="$('#recoveryForm').slideDown();$('#loginForm').slideUp();$('#registerForm').slideUp();">¡<?php echo ___("label_recovery_password"); ?>!</a>
                  <button  onClick="login();" class="btn btn-primary" style="width:100%;margin-top:10px;margin-bottom:10px" type="button"><?php echo ___("label_login"); ?></button>                          
                </div>
                <div id="registerForm" style="display:none" >
                 <?php echo $this->load->view("templates/common/_form_register",false,true); ?>              
                </div>

                <div id="recoveryForm" style="display:none" >
                  <h3 class="form-signin-heading"><?php echo ___("label_recovery_password"); ?></h3>
                  <input type="email" name="email" class="form-control" placeholder="<?php echo ___("label_email"); ?>" required autofocus>                  
                  <button  onClick="recoveryPassword();" class="btn btn-danger" style="width:100%" type="button"><?php echo ___("label_sendme_password"); ?></button>
                  <hr>
                </div>


                <button onClick="$('#recoveryForm').slideUp();$('#loginForm').slideDown();$('#registerForm').slideUp();$('.btnregister').fadeIn(500);$('.btnlogin').fadeOut(500);"  class="btn btn-primary btn-block btnlogin" style="display:none" type="button"><?php echo ___("label_login"); ?></button>
                <button onClick="$('#recoveryForm').slideUp();$('#loginForm').slideUp();$('#registerForm').slideDown();$('.btnregister').fadeOut(500);$('.btnlogin').fadeIn(500);" class="btn btn-info pull-right btn-block btnregister"  type="button"><?php echo ___("label_register"); ?></button>
                <div class="clearfix"></div>
              </form>
              
          </div>          
        </div>
      </div>
    </div>
    <?php }else{
      ?>
       <div class="modal" id="chPasswordModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo ___("label_change_password"); ?></h4>           
          </div>
          <div class="modal-body loginModal">
              <form class="form-signin" role="form">
                <div id="changePasswordForm" >
                  <h3 class="form-signin-heading"><?php echo ___("label_change_password"); ?></h3>                  
                  <input type="password" name="password1" class="form-control" placeholder="<?php echo ___("label_password"); ?>" required>          
                  <input type="password" name="password2" class="form-control" placeholder="<?php echo ___("label_password_repeat"); ?>" required>                            
                  <button  onClick="change();" class="btn btn-primary" style="width:100%;margin-top:10px;margin-bottom:10px" type="button"><?php echo ___("label_change_password_button"); ?></button>                          
                </div>

                
                <div class="clearfix"></div>
              </form>
              
          </div>          
        </div>
      </div>
    </div>
      <?php
      } ?>

  <form method="POST" id="export" action="<?php echo base_url(); ?>music/exportPlayList" class="hide" target="_blank">
        <textarea name="list"></textarea>
        <button type="submit"></button>
    </form>
    <?php echo $this->load->view("templates/common/_footer",false,true); ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-slider.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap3-typeahead.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/notify.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sort.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/menu.js"></script>    
 
    <script src="<?php echo base_url(); ?>assets/js/custom.js?v=2.0-<?php echo date("Ymd"); ?>"></script>

    <script>
 
    $(function() {
        /*if(!$("#s").val() =='')            
            $("#btnSearch").click();*/
          $(document).mouseup(function (e)
          {
              var container = $("#playlist-items");
              if (!container.is(e.target)  && container.has(e.target).length === 0 && $(e.target).attr("id") != 'playlist-items-btn' && $(e.target).attr("id") != 'playlist-items-btn2') // ... nor a descendant of the container
              {
                  container.hide();
              }
          });

       
         <?php
          
          if($this->input->get("playlist",true))
          {
            ?>loadPlayListShare('<?php echo $this->input->get("playlist",true); ?>');<?php
          }
          ?>
    });
    </script>
    <script src="<?php echo base_url(); ?>ga.js"></script>

  </body>
</html>
