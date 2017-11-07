<title></title>
<div id='home_block'>
    <span class="UsernameField"><?php echo $user->getUsername();?></span>


    <ul>
        <?php foreach ($newInterventions as $chantier){?>
        <li onmouseout='setLinkBackgroundColor(this,"gainsboro")' 
               onmouseover='setLinkBackgroundColor(this,"<?php echo constant('color');?>")'>
            <a href="<?php echo appConf("urlrootpath")."Mon_Chantier?id=".$chantier->getId(); ?>" >
                <span class="NameField"><?php echo $chantier->getName()?></span>
                <br/><br/>
                <span class="DateField"> <?php echo $chantier->getIdate()?> </span>
                <br/>
                <?php echo 'Statut : '.$chantier->getState()?>
            </a>
        </li>
        <?php }?>
    </ul>


</div>
<footer>
</footer>
