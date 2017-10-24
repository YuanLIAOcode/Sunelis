<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
    <?php
        include_once('services/session.php');
        sessionInit();
        include_once('services/includeGlobals.php');
        includeGlobals();
        chdir(appConf('rootpath'));
    ?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="image/jpg" href="<?php echo appConf('urlrootpath');?>globalViews/images/icons/logo.png">
	</head>
	<body>
        <?php
            $admin = false;
            if(isset($_GET['url'])){
                if(strpos($_GET['url'],'Admin') === 0){
                    $url = substr($_GET['url'],5,strlen($_GET['url'])-5);
                    if($url != '/'){
                        $url = 'Admin/pages'.$url;   
                    }else{
                        $url = 'Admin'.$url;
                    }
                    $admin = true;
                }else{
                    $url = 'pages/'.$_GET['url'];
                }
            }else{
                $url = 'pages/Mes_Chantiers/';
            }
            if(substr($url,-1,1) != '/'){
                $url .= '/';
            }
            if(is_dir($url)){
                deleteFormConfirmation();
                if(empty($_SESSION['errors'])){
                    $database = new Database();
                    createModels($database);
                    chdir(appConf('rootpath'));
                    includeFiles('models/',array('Database.php','Table.php','Column.php'));
                }
            }else{
                $admin = false;
                $url = 'globalViews/Error/';
                $_GET = array('err_code'=>404);
            }
            displaySessionLogs();
            if($admin){
                chdir(appConf('rootpath').'Admin/');
                $_GET['url'] = $url;
                require_once('index.php');
            }else{
                if(file_exists($url.'controller.php')){
                    chdir(appConf('rootpath').$url);
                    require_once('controller.php');
                    if($url != 'globalViews/Error/'){
                        chdir(appConf('rootpath'));
                        if(file_exists('globalViews/Header/controller.php')){
                            chdir(appConf('rootpath').'globalViews/Header/');
                            require_once('controller.php');
                        }
                        chdir(appConf('rootpath'));
                        if(file_exists('globalViews/Nav/controller.php')){
                            chdir(appConf('rootpath').'globalViews/Nav/');
                            require_once('controller.php');
                        }   
                        chdir(appConf('rootpath'));
                        if(file_exists('globalViews/Footer/controller.php')){
                            chdir(appConf('rootpath').'globalViews/Footer/');
                            require_once('controller.php');
                        }
                    }
                }else{
                    $url = 'globalViews/Error/';
                    $_GET = array('err_code'=>500);
                    require_once($url.'controller.php');
                }
            }
        ?>
    </body>