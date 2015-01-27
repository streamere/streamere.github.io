<div class="col-md-12">
		
			 	<table class="table table-striped table-bordered table-hover" id="tableUsers">
				  <thead>
				    <tr>	
				    	<th></th>			      
				      	<th>Username</th>
				      	<th>Nickname</th>
				      	<th>Role</th>				   
				      	<th>Registered</th>				   				      	
				      	<th></th>				   
				    </tr>
				  </thead>
				  <tbody>
				  <?php
				  $x=0;
				  $admin[0] = "<span class='label label-info'>User</span>";
				  $admin[1] = "<span class='label label-warning'>Admin</span>";
				  foreach ($users->result() as $row) {
				  	$x++;
				  	?>
				  	 <tr>		
				  	  <td class="text-center"> <?php echo $x; ?></td>		  
				      <td class="text-left"><img src="<?php echo $row->avatar; ?>" class="pull-left" style="height:24px;width:24px;margin-right:10px"> <?php echo $row->username; ?></td>
				      <td class="text-left"><?php echo $row->nickname; ?> <small>
				      <a target="_blank" href="<?php echo base_url(); ?>user/<?php echo $row->nickname; ?>"><i class="fa fa-external-link"></i></a></small></td>
				      <td class="text-left"><?php echo $admin[$row->is_admin]; ?></td>				
				      <td class="text-left"><i class="fa fa-calendar"></i> <?php echo $row->registered; ?></td>				
						
				     <td class="text-left">
				     	
				      		<button title="Remove User" onClick="removeUser('<?php echo $row->id; ?>','<?php echo $row->username; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>
				      		<a href="<?php echo base_url(); ?>user/<?php echo $row->nickname; ?>" title="Visit Profile" class="btn btn-xs btn-info"><i class="fa fa-user"></i></a>
				      		  <?php if(intval($row->idfacebook) > 0){
						      	?>
						      	<a  href="http://facebook.com/<?php echo $row->idfacebook; ?>" title="Facebook Profile" class="btn btn-xs btn-primary"><i class="fa fa-facebook"></i>
						      	<?php
						      	} ?>
				      		<!--<a href="<?php echo base_url(); ?>user/<?php echo $row->nickname; ?>" title="Spy Chat" class="btn btn-xs btn-warning"><i class="fa fa-comments"></i></a>-->
				      	
				      </td>				
				    </tr>	
				  	<?php
				  }
				   ?>			   
				  </tbody>
				</table> 
		
	</div>
<script>
function removeUser(id,email)
{

	if (confirm("Remove "+email)) {				
			$.post(base_url+"dashboard/removeUser", {id:id}, function(data, textStatus) {
				location.reload();
			});
		
	}
}
$(function () {
	 $('#tableUsers').dataTable();
});
</script>