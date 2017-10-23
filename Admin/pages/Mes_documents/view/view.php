<div id='mydocs_block'>
    <?php
        foreach($dir as $file){
            if($file != '.' and $file != '..'){
                if(is_dir($folder_root_path.$_SESSION['current_dir'].$file)){
                    echo '<a class="folder" href="'.$_SERVER['REDIRECT_URL'].'?dir='.$_SESSION['current_dir'].$file.'/">'.$file.'</a>';
                }else if(is_file($folder_root_path.$_SESSION['current_dir'].$file)){
                    
                }else{
                    
                }
            }
        }
    ?>
</div>