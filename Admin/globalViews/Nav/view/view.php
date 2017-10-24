<nav id='nav_block' class='visible' style='background-color:<?php echo constant('color');?>;'>  
    <div id='companies'>
        <a id='selected_company' href='Mes_documents?company=<?php echo $_SESSION['current_company'];?>'>
            <img src='<?php echo appConf('urlrootpath').'globalViews/images/icons/'.constant('logo');?>' alt='<?php echo $_SESSION['current_company'];?>'/>
        </a>
        <?php /*
            <a id='unselected_company' href=''>
            <img src='<?php echo appConf('urlrootpath').'globalViews/images/icons/'.constant('logo');?>'/>
        </a>*/
        ?>
        
    </div>
    <a class='link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urladminpath');?>Agenda' style='border-color:<?php echo constant('color').';'; if($_SESSION['page'] == 'Agenda'){echo 'color:'.constant('color').';background-color:white;';}?>'>Mon agenda</a>
    <?php
        if($user->getRights() == 'admin'){?>
            <a class='link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urladminpath');?>Compte_admin' style='border-color:<?php echo constant('color').';'; if($_SESSION['page'] == 'Compte_admin'){echo 'color:'.constant('color').';background-color:white;';}?>'>Comptes Admins</a><?php      
        }
    ?>
</nav>