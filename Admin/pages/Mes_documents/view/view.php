<title>Mes Documents</title>
<div id='mydocs_block'>
    <?php
        foreach($dir as $file){
            if($file != '.' and $file != '..'){
                if(is_dir($folder_root_path.$_SESSION['current_dir'].$file)){?>
                    <a class='folder' href='<?php echo $_SERVER['REDIRECT_URL'].'?dir='.$_SESSION['current_dir'].$file;?>' onmouseout='setBackgroundColor(this,"white")' onmouseover='setBackgroundColor(this,"<?php echo constant('color');?>")'>
                        <img src='<?php echo appConf('urlrootpath');?>globalViews/images/icons/folder.png' alt='folder :'/>
                        <?php echo $file;?>
                    </a><?php
                }else if(is_file($folder_root_path.$_SESSION['current_dir'].$file)){
                    var_dump($file);
                    $ext = getExtension($file);
                    var_dump(isImage($file));
                }else{
                    
                }
            }
        }
    ?>
</div>