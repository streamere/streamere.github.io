<?php 
if($this->config->item("comment_type") == 'facebook')
{
	if($this->config->item("comment_fb_app_id") != '')
	{
		?>
		
		<script>
		  //facebook comments
		  <?php if($this->input->is_ajax_request()){ ?>
		  setTimeout(function() {
		  	try{
		  		$('.nav-tabs a[href="#comments"]').tab('show');
		  		var oComments = document.querySelector("#commentFB");
				oComments.innerHTML =    '<div class="fb-comments" data-colorscheme="<?php echo $this->config->item("comment_facebook_colors"); ?>" data-href="' + document.location.href + '" data-num-posts="5" data-width="100%"></fb:comments>';  
				console.log("Facebook => "+oComments.innerHTML);
				FB.XFBML.parse(oComments);            	
     		}catch(e)
     		{}

		  }, 250);
     	<?php }else{
     		?>
     		$(function () {
     			$('.nav-tabs a[href="#comments"]').tab('show');
		  		var oComments = document.querySelector("#commentFB");
				oComments.innerHTML =    '<div class="fb-comments" data-colorscheme="<?php echo $this->config->item("comment_facebook_colors"); ?>" data-href="' + document.location.href + '" data-num-posts="5" data-width="100%"></fb:comments>';  
				console.log("Facebook => "+oComments.innerHTML);
				FB.XFBML.parse(oComments);            	
     		});
     			
     		<?php
     	} ?>
            
                              
          

		</script>
		<div id="commentFB">
		</div>
		<br>
		<!--<div class="fb-comments" data-width="100%"  data-numposts="5" data-colorscheme="<?php echo $this->config->item("comment_facebook_colors"); ?>"></div>-->
		<?php
	}
	else
	{
		?>
		<div class="alert alert-danger">Please setting your Facebook Application ID</div>
		<?php
	}
}
if($this->config->item("comment_type") == 'disqus')
{
	if($this->config->item("comment_disqus_id") != '')
	{
		?>
		
		    <div id="disqus_thread"></div>
		    <script type="text/javascript">
		        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		        var disqus_shortname = '<?php echo $this->config->item("comment_disqus_id"); ?>'; // required: replace example with your forum shortname

		        /* * * DON'T EDIT BELOW THIS LINE * * */
		        (function() {
		            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
		            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		        })();
		    </script>
		    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
		    
		<?php
	}
	else
	{
		?>
		<div class="alert alert-danger">Please setting your Disqus Shorcode</div>
		<?php
	}
}
?>
