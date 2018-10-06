<?php

function rupiah($number)
{
   return "Rp. ".number_format($number,2,',','.');
}

function hitungTotal($daftar_nasabah) {
    $total = 0;
    foreach ($daftar_nasabah as $nasabah) {
        $total = $total + $nasabah->tabungan;
    }
    return $total;
}

function hitungBonus($total) {
    $poin = 0;
    if($total > 10000000 && $total <= 50000000) {
        $poin = 5;
    } else if($total > 50000000 && $total <= 150000000) {
        $poin = 25;
    }
    else if($total > 150000000 && $total <= 250000000) {
        $poin = 100;
    }
    else if($total > 250000000 && $total <= 350000000) {
        $poin = 150;
    }
    else if($total > 350000000 && $total <= 450000000) {
        $poin = 200;
    }
    else if($total > 450000000 && $total <= 500000000) {
        $poin = 250;
    }
    else if($total > 500000000 && $total <= 1500000000) {
        $poin = 300;
    }
    else if($total > 1500000000 && $total <= 15000000000) {
        $poin = 350;
    }
    else if($total > 15000000000 && $total <= 100000000000) {
        $poin = 400;
    }
    else if($total > 100000000000) {
        $poin = 450;
    }
    return $poin;
}

function hitungPoin($dana) {
    $poin = 0;
    if($dana > 500000 && $dana <= 3000000) {
        $poin = 1;
    } else if($dana > 3000000 && $dana <= 10000000) {
        $poin = 5;
    }
    else if($dana > 10000000 && $dana <= 20000000) {
        $poin = 10;
    }
    else if($dana > 20000000 && $dana <= 30000000) {
        $poin = 15;
    }
    else if($dana > 30000000 && $dana <= 40000000) {
        $poin = 20;
    }
    else if($dana > 40000000 && $dana <= 50000000) {
        $poin = 25;
    }
    else if($dana > 50000000 && $dana <= 60000000) {
        $poin = 30;
    }
    else if($dana > 60000000 && $dana <= 70000000) {
        $poin = 35;
    }
    else if($dana > 70000000 && $dana <= 80000000) {
        $poin = 40;
    }
    else if($dana > 80000000 && $dana <= 90000000) {
        $poin = 45;
    }
    else if($dana > 90000000 && $dana <= 95000000) {
        $poin = 50;
    }
    else if($dana > 95000000 && $dana <= 100000000) {
        $poin = 55;
    }
    else if($dana > 150000000 && $dana <= 250000000) {
        $poin = 75;
    }
    else if($dana > 250000000 && $dana <= 350000000) {
        $poin = 150;
    }
    else if($dana > 350000000 && $dana <= 450000000) {
        $poin = 225;
    }
    else if($dana > 450000000 && $dana <= 500000000) {
        $poin = 300;
    }
    else if($dana > 500000000 && $dana <= 1500000000) {
        $poin = 500;
    }
    else if($dana > 1500000000 && $dana <= 15000000000) {
        $poin = 750;
    }
    else if($dana > 15000000000 && $dana <= 100000000000) {
        $poin = 1200;
    }
    else if($dana > 100000000000) {
        $poin = 2500;
    }
    return $poin;
}