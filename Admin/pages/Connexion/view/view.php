<title>Connexion</title>
<div id='connection_block'>
    <form method='post' action='<?php echo $_SERVER['REQUEST_URI'];?>'>
        <h2>Connexion</h2>
        <span class='field'>Nom d'utilisateur</span>
        <input type='text' name='username' spellcheck="false" autofocus='focus'/>
        <span class='field'>Mot de passe</span>
        <input type='password' name='password' spellcheck="false"/>
        <input type='submit' name='submit' value="Se connecter"/>
    </form>
    <a href='<?php echo appConf('urladminpath');?>Forgotten_password_step1'>Mot de passe oublié ?</a>
</div>