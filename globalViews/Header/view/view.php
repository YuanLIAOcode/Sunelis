<header id='horizontal_header' class='visible'>
    <a href='<?php echo appConf('urladminpath');?>Connexion?stat=disc'><img onmouseout='setPowerImageSrc(this,"<?php echo appConf('urlrootpath');?>globalViews/images/icons/<?php echo constant('power_r_button');?>")' onmouseover='setPowerImageSrc(this,"<?php echo appConf('urlrootpath');?>globalViews/images/icons/<?php echo constant('power_button');?>")' src='<?php echo appConf('urlrootpath');?>globalViews/images/icons/<?php echo constant('power_r_button');?>'/></a>
</header>
<header id='vertical_header' class='invisible' style='background-color:<?php echo constant('color');?>;'>
    <div id='companies'>
        <img id='selected_company' src='<?php echo appConf('urlrootpath').'globalViews/images/icons/'.constant('logo');?>' alt='<?php echo $_SESSION['current_company'];?>'/>
    </div>
    <div id='links'>
        <a class='link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urlrootpath');?>Mes_Chantiers' style='border-color:<?php echo constant('color').';'; if($_SESSION['page'] == 'Mes_Chantiers'){echo 'color:'.constant('color').';background-color:white;';}?>'>Mes Chantiers</a>
    <a class='link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urlrootpath');?>Demande_RDV' style='border-color:<?php echo constant('color').';'; if($_SESSION['page'] == 'Agenda'){echo 'color:'.constant('color').';background-color:white;';}?>'>Demande de RDV</a>
    <a class='power_link' onmouseout='setLinkBorderColor(this,"<?php echo constant('color');?>")' onmouseover='setLinkBorderColor(this,"white")' href='<?php echo appConf('urladminpath');?>Connexion?stat=disc' style='border-color:<?php echo constant('color').';';?>'><img src='<?php echo appConf('urlrootpath');?>globalViews/images/icons/<?php echo constant('power_button');?>'/></a>
    </div>
</header>