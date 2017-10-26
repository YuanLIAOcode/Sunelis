<title></title>
<div id='home_block'>
    <span class="UsernameField"><?php echo $user->getUsername();?></span>


    <ul>
        <?php foreach ($newInterventions as $chantier){?>
        <li>
            <a href="<?php echo appConf("urlrootpath")."Mon_Chantier"; ?>">
                <?php echo $chantier->getName()?>
                <br/>
                <span class="DateField"> <?php echo $chantier->getIdate()?> </span>
                <br/>
                <?php echo $chantier->getState()?>
            </a>
        </li>
        <?php }?>
    </ul>


</div>
<footer>
</footer>
