<?php
    
    require_once 'configuracion/config.php';
    require_once 'bibliotecas/DataBase.php';
    require_once 'bibliotecas/Request.php';
    //AutoLoad

    spl_autoload_register(function($clase)
    {
        require_once 'bibliotecas/'.$clase.'.php';

        
    });


?>