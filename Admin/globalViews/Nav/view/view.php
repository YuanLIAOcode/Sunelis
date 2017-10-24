<nav id='nav_block' class='visible' style='background-color:<?php echo constant('color');?>;'>  
    <div id='companies'>
        <a id='selected_company' href='<?php echo $_SERVER['REDIRECT_URL'];?>?company=<?php echo $_SESSION['current_company'];?>'>
            <img src='<?php echo appConf('urlrootpath').'globalViews/images/icons/'.constant('logo');?>' alt='<?php echo $_SESSION['current_company'];?>'/>
        </a>
        <?php
            
        ?>
        <a id='unselected_company' href=''>
            <img src=''/>
        </a>
    </div>
</nav>