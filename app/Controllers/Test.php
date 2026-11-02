<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT 1 + 1 AS hasil, NOW() AS waktu_sekarang');
        $result = $query->getRow();

        echo "Controller CI4 berhasil jalan!";

        echo "<h3>Koneksi Database Berhasil!</h3>";
        echo "Hasil query 1+1: " . $result->hasil . "<br>";
        echo "Waktu server: " . $result->waktu_sekarang;
    }
}
