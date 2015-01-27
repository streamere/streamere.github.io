
 <div class="row">
 	<div class="col-xs-12">
 	<?php if(!is_writable("./uploads/")){ ?>
    <div class="alert alert-danger">
  	  <strong>Error: </strong> uploads folder is not writable
    </div>
    <?php } ?>
    <?php if(!extension_loaded('zlib')){ ?>
    <div class="alert alert-danger">
  	  <strong>Error: </strong> ZLib extension is Required
    </div>
    <?php } ?>
    <?php if($upload['error']){ ?>
    <div class="alert alert-danger">
  	  <strong>Error: </strong> <?php echo $upload['error']; ?>
    </div>

    <?php } ?>
     <?php if($upload['upload_data']){ ?>
    <div class="alert alert-success">
  	  <strong><?php echo str_ireplace("_", " ",$upload['upload_data']['raw_name']); ?> </strong> Installed!
    </div>

    <?php } ?>


	 	<div class="box box-primary">
	 	 	<form method="post"  enctype="multipart/form-data" />          
	 	 	 		<div style="padding:50px;padding-top:50px;padding-bottom:100px" class="text-center">
	 	 	 			<i class="fa fa-cloud-upload" style="color:#676767;font-size:10em"></i>
	 	 	 			<h2>Install Updates and New Modules</h2>
		                <div class="form-group">
		                    <input id="input-1a" type="file" class="file" data-show-preview="false" name="upload" value="" >
		                    <input type="hidden" name="uploading" value="1">
		                </div> 
		                <span class="inline-help">
		                Search your <strong>zip</strong> file and upload it!
		                </span>      
		                <div class="clearfix"></div>
		                <span class="inline-help text-warning">
		                Please make <strong>backup</strong> of all files before to upload new module or update
		                </span>      
		                
		             </div>

               
            </form>
		</div>	
	</div>
</div>
