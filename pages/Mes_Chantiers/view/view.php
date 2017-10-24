<title></title>
<div id='home_block'>
    <span class="UsernameField"><?php echo $user->getUsername();?></span>
    
        <?php     
    foreach ($interventions as $chantier){
                echo '<li>'
                    .$chantier->getName()
                    .'<br/>'
                    .'<span class="DateField">'.'date : '.$chantier->getIdate().'</span>'
                    .'<br/>'
                    .$chantier->getState()
                    .'</li>';
                    }
        ?> 
    
    <nav>
    </nav>
</div>
<footer>
</footer>
