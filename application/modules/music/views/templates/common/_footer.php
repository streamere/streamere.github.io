
    <div class="modal fade" id="popup_guest"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
              <h4 class="modal-title"><?php echo $this->config->item("title"); ?></h4>           
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                      <img src="<?php echo base_url(); ?>assets/images/guest_register.png" class="img-responsive">
                    </div>
                    <div class="col-md-8">
                    <?php echo ___('msg_guest_dialog'); ?>
                          <div class="clearfix"></div>
                              <div class="row">
                              <br>
                              <?php if($this->config->item("facebook_fanpage")){ ?>
                              <div class="col-md-6">
                                  <div id="fb-root"></div>
                                  <script>(function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=<?php echo $this->config->item("comment_fb_app_id"); ?>&version=v2.0";
                                    fjs.parentNode.insertBefore(js, fjs);
                                  }(document, 'script', 'facebook-jssdk'));</script>      

                                  <div class="fb-like" data-href="<?php echo $this->config->item("facebook_fanpage"); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>      
                                </div>
                              <?php } ?>
                           <?php if($this->config->item("twitter_username")){ ?>
                            <div class="col-md-6">
                                 <a href="https://twitter.com/<?php echo $this->config->item("twitter_username"); ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php echo $this->config->item("twitter_username"); ?></a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
          </div>  
          <div class="modal-footer">
                    <button class="btn btn-primary btn-block btn-md btn-login" data-dismiss="modal"><?php echo ___("label_login"); ?></button>
                    <button class="btn btn-info btn-block btn-md btn-register" data-dismiss="modal"><?php echo ___("label_register"); ?></button>
          </div>        
        </div>
      </div>
    </div>






    <?php if(!is_logged() && $this->config->item("popup_guest") == '1'){ ?>
    <script>

    $(window).load(function() {
      $("#popup_guest").modal({
          "show":true,
          "keyboard":false}
          );
    });
    </script>
    <?php } ?>

    <?php echo $this->config->item("footer_script"); ?>