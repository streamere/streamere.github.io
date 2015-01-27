<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Youtube Music Engine [Admin] | <?php echo $title; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Ionicons -->
        <link href="<?php echo base_url(); ?>assets/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>assets/admin/css/main.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/admin/css/morris/morris.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/admin/js/plugins/tagsinput/bootstrap-tagsinput.css" media="all" rel="stylesheet" type="text/css" />               
        <link href="<?php echo base_url(); ?>assets/admin/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />    

        <script>
        var base_url = '<?php echo base_url(); ?>';
        </script>

        

    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Youtube Music Engine
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <?php echo $_NAVBAR; ?>


            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
               <?php echo $_SIDEBAR; ?>
                <!-- /.sidebar -->
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                       <?php echo $title; ?>
                        
                    </h1>
                 
                </section>

                <!-- Main content -->
                <section class="content">
                <?php echo $_PAGE; ?>
                </section>
                </aside>
           
        </div><!-- ./wrapper -->


     
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
          <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/core/app.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugins/tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>        
        tinymce.init({
            selector:'.tinymce',
            plugins: [
                        "advlist autolink lists link image charmap preview anchor",
                        "searchreplace visualblocks code",
                        "insertdatetime media table contextmenu paste"
                    ]
        });
        </script>

    </body>
</html>