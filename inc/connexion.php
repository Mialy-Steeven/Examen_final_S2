<?php
function dbconnect()
{
    static $connect = null;
    if ($connect === null) {
        //$connect = mysqli_connect('172.60.255.248', 'ETU004112', 'PxVufPVA', 'db_s2_ETU004112');
        $connect = mysqli_connect('localhost', 'root', '', 'partage_objets');
        if (!$connect) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }
        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}
?>