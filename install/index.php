<?php
$error = 0;
if (isset($_POST['btn-install'])) {    
    // validation
    if ($_POST['inputDBhost'] == '' || $_POST['inputDBusername'] == '' || 
            $_POST['inputDBname'] == '') {
        $error = 1;
    } else {
        
        $con            = new mysqli($_POST['inputDBhost'], $_POST['inputDBusername'], $_POST['inputDBpassword']);                
        $db_selected    = mysqli_select_db($con, $_POST['inputDBname']);

        if (!$con) {
            $error = 1;
        } else if (!$db_selected) {  
            $error = 1;
        } else {                       


            require_once("../application/config/custom.php");            
            // setting database
            $file_db = "../application/config/database.php";
            $content_db = file_get_contents($file_db);
            $content_db = str_ireplace("#hostname#", $_POST['inputDBhost'],  $content_db);
            $content_db = str_ireplace("#username#", $_POST['inputDBusername'],  $content_db);
            $content_db = str_ireplace("#password#", $_POST['inputDBpassword'],  $content_db);
            $content_db = str_ireplace("#database#", $_POST['inputDBname'],  $content_db);     
            file_put_contents($file_db, $content_db);      

            // TABLES
            $_QUERY = "CREATE TABLE IF NOT EXISTS `users` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(250) NOT NULL,
                        `names` varchar(250) NOT NULL,
                        `is_admin` int(11) NOT NULL DEFAULT '0',
                        `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `password` varchar(250) NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `username` (`username`),
                        KEY `username_2` (`username`),
                        KEY `password` (`password`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";       

            $con->query($_QUERY); 

            $_QUERY = "INSERT IGNORE INTO users (username,names,password,is_admin) VALUES ('".$_POST['username']."','Administrator','".sha1($_POST['password'])."','1'); ";

            $con->query($_QUERY);   

            $_QUERY = "UPDATE users SET password = '".sha1($_POST['password'])."' WHERE username = '".$_POST['username']."';";

            $con->query($_QUERY);  


            $_QUERY = "CREATE TABLE IF NOT EXISTS `settings` (
                        `var` varchar(50) NOT NULL,
                        `value` text NOT NULL,
                        PRIMARY KEY (`var`),
                        UNIQUE KEY `var` (`var`),
                        KEY `var_2` (`var`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";       

            $con->query($_QUERY);

            foreach ($config as $key => $value) { 
                if(is_array($value)) 
                    $value = implode(",", $value);
                $value = $con->real_escape_string($value);
                $value = $value;
                $con->query("INSERT IGNORE INTO settings (var,value) VALUES ('$key','$value');");                
            }
            header('location:../');
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>
   <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
   <style>
   @import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic);
   body{
    font-family: 'Roboto Condensed', sans-serif;
    background-color: #EAEAEA;
   }
   </style>

</head>
<body>
 <div style="text-align:center;margin-top:20px;"><h4>Install Database Module Youtube Music Enginer</h4></div>
<div class="container" style="background-color:#FFFFFF;margin-top:20px;border-radius:5px">
    <div class="row" style="padding:10px">    

    <form  action="" method="post" role="form" style="margin-top:30px;">

        <?php if ($error == 1): ?>
        <div class="alert alert-error" style="font-size:11px;">               
            <b>Opps error ... </b> please check: 
            <br/> - <i>Each fields cannot be blank</i>            
            <br/> - <i>Database name must exist on your MySQL</i>
        </div>
        <?php endif; ?>
        <div class="col-md-6">
          <legend><i class="fa fa-gears"></i> Setup Requirements</legend>
          <div class="row" style="color:#757575">
                <div class="col-xs-12">
                    MYSQL 5.0 +
                    <span class="label label-<?php if (extension_loaded('mysql')) { echo "success"; } else { echo "danger"; } ?> pull-right">Required</span>
                </div>
                <div class="col-xs-12">
                    CURL
                    <span class="label label-<?php if (extension_loaded('curl')) { echo "success"; } else { echo "danger"; } ?> pull-right">Required</span>
                </div>
                <div class="col-xs-12">
                    MYSQLi Extension
                    <span class="label label-<?php if (extension_loaded('mysqli')) { echo "success"; } else { echo "danger"; } ?> pull-right">Required</span>
                </div> 
                <div class="col-xs-12">
                   Allow Url Fopen
                    <span class="label label-<?php if (ini_get('allow_url_fopen')) { echo "success"; } else { echo "danger"; } ?> pull-right">Required</span>
                </div>   
                <?php if(function_exists('apache_get_modules')){ ?>
                 <div class="col-xs-12">
                   Mod Rewrite Module
                    <span class="label label-<?php if (in_array('mod_rewrite', apache_get_modules())) { echo "success"; } else { echo "danger"; } ?> pull-right">Required</span>
                </div>     
                <?php } ?>
                <div class="col-xs-12">
                   Linux Server
                    <span class="label label-<?php if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') { echo "success"; } else { echo "danger"; } ?> pull-right">Required</span>
                </div>   

          </div>
          <br>
            <legend><i class="fa fa-folder-open"></i> Directory & Permissions</legend>
            <div class="row" style="color:#757575">
               <div class="col-xs-12">
                    Config Folder (applications/config/)
                    <span class="label label-<?php if(is_writable("../application/config/")) { echo "success"; } else { echo "danger"; } ?> pull-right"><?php if(is_writable("../application/config/")) { echo "Writable"; } else { echo "Not Writable"; } ?></span>
                </div>
                 <div class="col-xs-12">
                    Install Folder (install/)
                    <span class="label label-<?php if(is_writable("../install/")) { echo "success"; } else { echo "danger"; } ?> pull-right"><?php if(is_writable("../install/")) { echo "Writable"; } else { echo "Not Writable"; } ?></span>
                </div>
                <div class="col-xs-12">
                    Cache Folder (cache/)
                    <span class="label label-<?php if(is_writable("../cache/")) { echo "success"; } else { echo "danger"; } ?> pull-right"><?php if(is_writable("../cache/")) { echo "Writable"; } else { echo "Not Writable"; } ?></span>
                </div>
                  <div class="col-xs-12">
                    Avatars Folder (cache/)
                    <span class="label label-<?php if(is_writable("../avatars/")) { echo "success"; } else { echo "danger"; } ?> pull-right"><?php if(is_writable("../avatars/")) { echo "Writable"; } else { echo "Not Writable"; } ?></span>
                </div>
                <div class="col-xs-12">
                    Htaccess File (.htaccess)
                    <span class="label label-<?php if(file_exists("../.htaccess")) { echo "success"; } else { echo "danger"; } ?> pull-right"><?php if(file_exists("../.htaccess")) { echo "Found in Server"; } else { echo "Not Found"; } ?></span>
                </div>
                <div class="col-xs-12">
                <br>
                <hr>
                   <div class="text-center">
                    Don't worry if all is <span class="label label-success">green</span> :)
                </div>

                  
                </div>
            </div>

        </div>
        <div class="col-md-6">
        <legend><i class="fa fa-database"></i> Database Settings</legend>
            <div class="form-group">                
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input required type="text" class="form-control" placeholder="DB Host" value="localhost" name="inputDBhost">
                </div>
            </div>
            <div class="form-group">                
                <div class="input-group">      
                    <span class="input-group-addon"><i class="fa fa-th-list"></i></span>              
                    <input required type="text" placeholder="DB Name" class="form-control" name="inputDBname">
                </div>
            </div>
            <div class="form-group">                
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>              
                    <input required type="text" placeholder="Username Database" class="form-control" name="inputDBusername">
                </div>
            </div>
            <div class="form-group">                
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>              
                    <input required type="password" placeholder="Password Database" class="form-control" name="inputDBpassword">
                </div>
            </div>

            <legend><i class="fa fa-lock"></i> Administrator Settings</legend>
            <div class="form-group">                
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>              
                    <input required type="email" class="form-control" placeholder="Email Administrator" name="username">
                </div>
            </div>
            <div class="form-group">                
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>              
                    <input required type="password" placeholder="Password Administrator" class="form-control" name="password">
                </div>
            </div>
          
            <div class="form-group">
                <div class="controls">                    
                    <button type="submit" class="btn btn-primary" style="width:100%" name="btn-install" /><i class="fa fa-check-circle"></i> Install</div>
                </div>
            </div>

            <div class="col-xs-12">
            <br>
                <div class="text-muted text-center">
                    Copyright &copy; <?php echo date('Y'); ?> <a href="http://jodacame.com">Jodacame.com</a><br>
                    Only on <a href="http://codecanyon.net/item/youtube-music-engine/7490975?ref=jodacame">codecanyon.net</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
</body>
</html>