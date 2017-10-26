<title></title>
<div id='home_block'>
    <span class="UsernameField"><?php echo $user->getUsername();?></span>
    
        <?php     
                echo '<li>'.'<span class="DateField">'.'date : '.$chantier->getIdate().'</span>'.'</li>'
                    .'<li>'.'<span class="AddressField">'.'Lieu : '.$chantier->getAddress().'</span>'.'</li>';
                    
        ?> 
    
    <nav>
    </nav>
</div>