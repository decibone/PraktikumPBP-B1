<?php
// Nama: Laurentius Lucky Andriawan Bagaskara
// NIM: 24060122130100
// Lab B1

// Fungsi menghitung rata-rata
function hitung_rata($array) {
    return array_sum($array) / count($array);
}

function print_mhs($array_mhs) {

    //Handle tabel
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-rata</th></tr>";
    
    $nama1 = array_keys($array_mhs);
    for ($i = 0; $i < count($array_mhs); $i++) {
        $nama = $nama1[$i];
        $nilai = $array_mhs[$nama];
        
        echo "<tr>";
        echo "<td>$nama</td>";
        for ($j = 0; $j < count($nilai); $j++) {
            echo "<td>{$nilai[$j]}</td>";
        }
        $rata = hitung_rata($nilai);
        echo "<td>" . number_format($rata, 2) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

$array_mhs = array(
    'Abdul' => array(89, 90, 54),
    'Budi' => array(98, 65, 74),
    'Nina' => array(67, 56, 84)
);

print_mhs($array_mhs);

?>