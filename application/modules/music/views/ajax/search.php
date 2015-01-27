<div id="search-artist">
    <div id="circleG">
        <div id="circleG_1" class="circleG"></div>
        <div id="circleG_2" class="circleG"></div>
        <div id="circleG_3" class="circleG"></div>
    </div>
    <script type="text/javascript">
        try{
            search_artist('<?php echo decode($query); ?>');
        }catch(e)
        {
            $(function () {
                search_artist('<?php echo decode($query); ?>');
            });
        }
        
    </script>
</div>

<div class="clearfix"></div>
<?php if($this->config->item("ads_refresh") == '1'){ ?>
<center class="adsblock"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></center><br><br>
<?php } ?>

<div class="page-header">
  <h1> <?php echo decode($query); ?> <div class="btn-group pull-right">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-share-square"></i> <?php echo ___("label_share"); ?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#" onClick="custom_share('fb','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
                <li><a href="#" onClick="custom_share('tw','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
                <li><a href="#" onClick="custom_share('gp','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>   
                <li><a href="#" onClick="custom_share('c','<?php echo base_url()."search/".econde(addslashes($query)); ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>   
        </ul>
      </div></h1>
</div>
<div class="row">
    <?php 
    if(count($search->results->trackmatches->track) == 0)
    {
        ?>
        <div class="alert alert-info">
            <strong><?php echo $query ?></strong>  No Found!
        </div>
        <?php
    }   
    if(count($search->results->trackmatches->track)>1)
        $search_a = $search->results->trackmatches->track;
    if(count($search->results->trackmatches->track)==1)
        $search_a[0] = $search->results->trackmatches->track;


    foreach ($search_a as $key => $value) {
        $picture = $value->image[3]->text;
        if($picture == '')
           $picture = base_url()."assets/images/no-cover.png";
       if($value->name != '')
        {
               if($this->config->item("search") == 'Modern')
               {
                $radius = '';
                if($this->config->item("cover_search") == 4)
                    $radius = 'border-radius:50%;';

                
                ?>
                   <div class="col-xs-6 col-md-6 col-lg-4">
                        <div class="jumbotron">
                            <div class="row">
                                <div class="col-md-4" >
                                    <div style="<?php echo $radius; ?>background:url('<?php echo $picture; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
                                        <img  style="width:100%;max-height:100%;;max-widht:100%;" src="<?php echo base_url(); ?>assets/images/bg-cover<?php echo $this->config->item("cover_search"); ?>.png">    
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="pull-right" style="margin:10px">
                                        <button class="btn btn-primary btn-xs" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>');"><i class="fa fa-plus"></i></button>                                         
                                        <button class="btn btn-primary btn-xs" title="<?php echo ___("label_playnow"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>',true);"><i class="fa fa-play"></i></button>                                         
                                        <button class="btn btn-warning btn-xs" title="<?php echo ___("label_start_radio"); ?>" onclick="start_radio('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>')"><i class="fa fa-rss"></i></button>
                                        <?php if($this->config->item("amazon_afiliate") != '')
                                        {
                                            ?><button  onClick="buyOnAmazon('<?php echo addslashes($value->name); ?> - <?php echo addslashes($value->artist); ?>')" class="btn btn-info btn-xs" title="<?php echo ___("label_buy_on_amazon"); ?>"><i class="fa fa-shopping-cart"></i></button><?php
                                        }
                                        ?>
                                    </div>                                        
                                    <h4 class="nowrap" title="<?php echo $value->name; ?>"><a class="link removehref" href="<?php echo base_url(); ?>?artist=<?php echo $value->artist; ?>&track=<?php echo $value->track; ?>" onClick="getSongInfo('<?php echo addslashes($value->artist); ?>','<?php echo addslashes($value->name); ?>')"><?php echo $value->name; ?></h4>
                                    <a class="link removehref" href="<?php echo base_url(); ?>artist/<?php echo econde($value->artist); ?>" class="artistInfo nowrap" onClick="getArtistInfo('<?php echo $value->artist; ?>');" title="<?php echo ___("label_get_artist_info"); ?> <?php echo $value->artist; ?>"><?php echo $value->artist; ?></a>  
                                </div>
                            </div>                          
                        </div>
                    </div>
                <?php
                    
                }
                else
                {

                    ?>
                   <div class="col-xs-12">
                        <div class="jumbotron" style="margin:2px">
                            <div class="row">
                               
                                <div class="col-xs-12">
                                <img  style="width:48px;margin-right:10px" class="pull-left" src="<?php echo $picture; ?>">
                                    <div class="pull-right" style="margin:10px">
                                         <button class="btn btn-primary btn-xs" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>');"><i class="fa fa-plus"></i></button>                                         
                                         <button class="btn btn-primary btn-xs" title="<?php echo ___("label_playnow"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>',true);"><i class="fa fa-play"></i></button>                                         
                                         <button class="btn btn-warning btn-xs" title="<?php echo ___("label_start_radio"); ?>" onclick="start_radio('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist); ?>','<?php echo $picture; ?>')"><i class="fa fa-rss"></i></button>
                                    </div>                                        
                                    <h4><?php echo $value->name; ?> <span class="artistInfo text-muted" onClick="getArtistInfo('<?php echo $value->artist; ?>');" title="<?php echo ___("label_get_artist_info"); ?>">By <?php echo $value->artist; ?></span>  </h4>                            
                                </div>
                            </div>                          
                        </div>
                    </div>
                 <?php
                }
            }
    }
    ?> 
</div>
<script>
$(".removehref").attr("href","#");
</script>