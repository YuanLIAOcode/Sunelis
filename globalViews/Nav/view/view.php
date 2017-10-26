<nav id='nav_block' class='visible' style='background-color:<?php echo constant('color');?>;'>  
    <div id='companies'>        
        <img id='selected_company' src='<?php echo appConf('urlrootpath').'globalViews/images/icons/'.constant('logo');?>' alt='<?php echo $_SESSION['current_company'];?>'/>
    </div>
    <a class='link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urlrootpath');?>Mes_Chantiers' style='border-color:<?php echo constant('color').';'; if($_SESSION['page'] == 'Mes_documents'){echo 'color:'.constant('color').';background-color:white;';}?>'>Mes Chantiers</a>
    <a class='link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urlrootpath');?>Demande_RDV' style='border-color:<?php echo constant('color').';'; if($_SESSION['page'] == 'Agenda'){echo 'color:'.constant('color').';background-color:white;';}?>'>Demande de RDV</a>
</nav>