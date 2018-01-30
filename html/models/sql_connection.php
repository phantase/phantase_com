<?php

// Database connection
try
{
    $bdd = new PDO('mysql:host=db;dbname=phantacom;charset=utf8', 'phantacom', 'pH1983');
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}
