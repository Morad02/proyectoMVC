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
        <ul>
            <?php if (isset($datos['opinan']))
            {
                foreach($datos['opinan'] as $opinan)
                {
            ?>
                <li>(<?php echo $opinan['total_comentarios']?>) <?php echo ' '.$opinan['nombre'].' '.$aniaden['apellidos']?></li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
</div>