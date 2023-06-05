<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Los que más añaden</h5>
        <ul>
            <?php if (isset($datos['aniaden']))
            {
                foreach($datos['aniaden'] as $aniaden)
                {
            ?>
                <li>(<?php echo $aniaden['total_incidentes']?>) <?php echo ' '.$aniaden['nombre'].' '.$aniaden['apellidos']?></li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Los que más opinan</h5>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor, quam nec
        convallis faucibus, mauris turpis gravida lacus, ut congue mi est eu erat.</p>
    </div>
</div>