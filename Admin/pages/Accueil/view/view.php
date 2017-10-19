<div id='home_block'>
    <div id='counter'>
        <h2>Compteurs Visiteurs</h2>
        <span class='field'>Total des connexions :<span class='value'><?php echo counAllConnection();?></span></span>
        <span class='field'>Client distincts : <span class='value'><?php echo countDistinctClient();?></span></span>
    </div>
    <div id='proposals'>
        <?php 
            if(!empty($proposals)){?>
                <h2>Propostions des utilisateurs pour les capsules inconnues</h2>
                <table cellspacing='0'>
                    <tr>
                        <th width='50px' style='border-right:solid 2px var(--yellow);'>ID capsule</th>
                        <th width='350px'>Proposition de Marque</th>
                    </tr>
                    <?php
                        foreach($proposals as $capsule_id=>$brands){
                            $first = true;
                            foreach($brands as $brand){
                                if($first){
                                    $first = false;?>
                                    <tr>        
                                        <td style='border-right:solid 2px var(--yellow);'><?php echo $capsule_id;?></td>
                                        <td><?php echo $brand;?></td>
                                    </tr><?php
                                }else{?>
                                    <tr>
                                        <td style='border-right:solid 2px var(--yellow);'></td>
                                        <td><?php echo $brand;?></td>
                                    </tr><?php
                                }
                            }
                        }
                    ?>
                </table><?php
            }
        ?>
    </div>
</div>