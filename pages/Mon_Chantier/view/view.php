<title></title>
<div id='home_block'>
    <span class="UsernameField"><?php echo $user->getUsername();?></span>

    <?php     
    echo '<li>'.'<span class="NameField">'.'Chantier : '.$intervention->getName().'</span>'.'</li>'
        .'<li>'.'<span class="DateField">'.'Date : '.$intervention->getIdate().'</span>'.'</li>'
        .'<li>'.'<span class="AddressField">'.'Lieu : '.$intervention->getAddress().'</span>'.'</li>';
    ?> 
    <div id='files_block'>
        <?php
            foreach($dir as $file){
                if($file != '.' and $file != '..'){
                    if(is_dir($folder_root_path.$_SESSION['current_dir'].$file)){?>
                        <a class='folder' href='<?php echo $_SERVER['REDIRECT_URL'].'?dir='.$_SESSION['current_dir'].$file;?>' onmouseout='setBackgroundColor(this,"white")' onmouseover='setBackgroundColor(this,"<?php echo constant('color');?>")'>
                            <img src='<?php echo appConf('urlrootpath');?>globalViews/images/icons/folder.png' alt='folder :'/>
                            <?php echo $file;?>
                        </a><?php
                    }else if(is_file($folder_root_path.$_SESSION['current_dir'].$file)){
                        foreach($files as $datafile){
                            if ($datafile->getFilepath()==$_SESSION['current_dir'] and $datafile->getVisibility()==1
                                and $file == $datafile->getFilename()){
                                echo '<span class="file">'.$file.'</span>';
                            }
                        }
                            
                    }else{
                    
                    }
                }
            }
        ?>
    </div>

</div>