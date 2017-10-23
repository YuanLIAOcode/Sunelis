<div id='mydocs_block'>
    <?php
        foreach($dir as $file){
            if($file != '.' and $file != '..'){
                if(is_dir($folder_path.$file)){
                    echo '<a class="folder" href="'.$_SERVER['REDIRECT_URL'].'?dir='.$file.'/">'.$file.'</a>';
                }else if(is_file($folder_path.$file)){
                    
                }else{
                    
                }
            }
        }
    ?>
</div>