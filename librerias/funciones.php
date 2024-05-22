<?php

function sesion_consultar()
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../../index.php");
        exit();
    }
    return $_SESSION['user'];
}


function sesion_rol()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        return $_SESSION['rol'];
    }
    
    
}
?>