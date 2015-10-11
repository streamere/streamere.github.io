<?php 
$itemRand = rand(1,count($top->toptracks->track)-1);
$image = $top->toptracks->track[$itemRand]->image[3]->text;
  if($image == '')
    $image = base_url()."assets/images/no-cover.png";



?>
<div >
<?php if($this->config->item("ads_refresh") == '1'){ ?>
  <center class="adsblock"><?php if(!$hide_ads){ echo $this->config->item("ads_block"); } ?></center><br><br>
  <?php } ?>
  <div class="page-header">
    <h1><?php echo decode($title); ?> 
    <div class="clearfix"></div>
    <div class="btn-group pull-right">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-share-square"></i> <?php echo ___("label_share"); ?>
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
              <li><a href="#" onClick="custom_share('fb','<?php echo base_url()."tag/".addslashes($title); ?>');return false;"><i class="fa fa-facebook-square"></i> Facebook</a></li>                              
                  <li><a href="#" onClick="custom_share('tw','<?php echo base_url()."tag/".addslashes($title); ?>');return false;"><i class="fa fa-twitter"></i> Twitter</a></li>                              
                  <li><a href="#" onClick="custom_share('gp','<?php echo base_url()."tag/".addslashes($title); ?>');return false;"><i class="fa fa-google-plus-square"></i> Google Plus</a></li>   
                  <li><a href="#" onClick="custom_share('c','<?php echo base_url()."tag/".addslashes($title); ?>');return false;"><i class="fa fa-link"></i> Copy Link</a></li>   
          </ul>
        </div>
    <button class="btn btn-warning pull-right" onclick="start_radio('<?php echo addslashes($top->toptracks->track[$itemRand]->name); ?>','<?php echo addslashes($top->toptracks->track[$itemRand]->artist->name); ?>','<?php echo $image; ?>')"><i class="fa fa-rss"></i> <?php echo ___("label_start_radio"); ?></button>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default"><?php echo ___("label_genres"); ?></button>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">  
   <?php if($this->config->item("genres") != '')
    {
      $tags = explode(",", $this->config->item("genres"));
      foreach ($tags as $key => $value) 
      {     
        ?>
        <li  onclick="getTopTags('<?php echo encode($value); ?>');" ><a href="#"><?php echo ucwords($value); ?></a></li>
        <?php    
      }
    }
    ?>    
    
  </ul>
</div>

    </h1>
   </div>
   <div class="row">
  <?php

  foreach ($top->toptracks->track as $key => $value) {
    $image = $value->image[3]->text;
      if($image == '')
        $image = base_url()."assets/images/no-cover.png";
    ?>    
    <div class="col-xs-<?php echo  $this->config->item("col_xs"); ?> col-md-<?php echo  $this->config->item("col_md"); ?> col-lg-<?php echo  $this->config->item("col_lg"); ?>"  style="margin-bottom:20px;">
      <div class="thumbnail cursor-pointer" style="background:url('<?php echo $image; ?>') no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
        <div style="height:150px;overflow:hidden;">         
          </div>    
           <p>
            <button class="btn btn-default" style="width:45%" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>');"><i class="fa fa-plus"></i></button>                                         
            <button class="btn btn-default pull-right" style="width:45%" title="<?php echo ___("label_add_playlist"); ?>" onclick="addPlayList('<?php echo addslashes($value->name); ?>','<?php echo addslashes($value->artist->name); ?>','<?php echo $image; ?>',true);"><i class="fa fa-play"></i></button>                                         
          </p>
      </div>
        <div class="caption">
           <div class="caption-main">
          <h4 class="truncate"><?php echo $value->name; ?></h4>              
          <a href="<?php echo base_url(); ?>artist/<?php echo econde($value->artist->name); ?>" class="artistInfo removehref truncate" onClick="getArtistInfo('<?php echo addslashes($value->artist->name); ?>');" title=<?php echo ___("label_get_artist_info"); ?>><?php echo $value->artist->name; ?></a>      
          </div>         
        </div>

    </div>  
  <?php
  }
  ?>
  </div>
</div>
<script>
$(".removehref").attr("href","#");
var stateObj = { foo: "bar" };
history.pushState(stateObj, "", "<?php echo base_url(); ?>tag/<?php echo encode($title); ?>");
</script>