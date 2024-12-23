<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "burgerchain";

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

if(!$conn)
{
    die("Connessione al database fallita:".mysqli_connect_error());
}