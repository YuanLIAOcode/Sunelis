<title>Comptes Admins</title>
<div id='admin_accounts_block'>
    <form id='addAdmin' method='post' action='<?php echo $_SERVER['REDIRECT_URL'];?>'>
        <table>
            <tr>
                <th style='background-color:<?php echo constant('color');?>'>Nom d'utilisateur</th>
                <th style='background-color:<?php echo constant('color');?>'>Adresse Email</th>
                <th style='background-color:<?php echo constant('color');?>'>Droits</th>
                <th></th>
            </tr>
            <?php
                foreach($admin_accounts as $admin){
                    echo '<tr>';
                        echo '<td>'.$admin->getUsername().'</td>';
                        echo '<td>'.$admin->getEmail().'</td>';
                        echo '<td style="text-align:center;">'.$admin->getRights().'</td>';
                        echo '<td></td>';
                    echo '</tr>';
                }
            ?>
            <tr>
                    <td style='position:relative;'><input type='text' name='username' spellcheck='false' placeholder="Nom d'utilisateur"/></td>
                    <td style='position:relative;'><input type='email' name='email' spellcheck="false" placeholder='Adresse Email'/></td>
                    <td>
                        <select name='rights'>
                            <option selected disabled>Droits</option>
                            <option value='Admin'>Admin</option>
                        </select>
                    </td>
                    <td><input onmouseout='setColor(this,"<?php echo constant('color');?>");setBackgroundColor(this,"white")' onmouseover='setColor(this,"white");setBackgroundColor(this,"<?php echo constant('color');?>")' type='submit' name='submit' value='Ajouter' style='color:<?php echo constant('color');?>;background-color:white;border:solid 1px <?php echo constant('color');?>'/></td>
            </tr>
        </table>
    </form>
</div>