<title></title>
<div id='home_block'>
    <span class="UsernameField"><?php echo $user->getUsername();?></span>
    
        <?php     
                echo '<li>'.'<span class="NameField">'.'Chantier : '.$intervention->getName().'</span>'.'</li>'
                    .'<li>'.'<span class="DateField">'.'Date : '.$intervention->getIdate().'</span>'.'</li>'
                    .'<li>'.'<span class="AddressField">'.'Lieu : '.$intervention->getAddress().'</span>'.'</li>';
                    
        ?> 
    
    <nav>
    </nav>
</div>