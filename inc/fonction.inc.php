<?php
//----------------------------------------------------
function executeRequete($req, $params = [])
{
    global $pdo; // connexion PDO définie dans init.inc.php

    try
    {
        $stmt = $pdo->prepare($req); // prépare la requête
        $stmt->execute($params); // exécute avec les paramètres
    }
    catch(PDOException $e)
    {
        die("🛑 Une erreur est survenue sur la requête SQL.<br>
        Message de l'erreur : " . $e->getMessage() . "<br>
        Code de la requête : " . $req);
    }

    return $stmt; // retourne PDOStatement
}
//----------------------------------------------------
function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px;">';

    $trace = debug_backtrace();
    $trace = array_shift($trace);

    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].";

    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }

    echo '</div>';
}