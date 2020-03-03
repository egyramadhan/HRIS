<?php
    function buatRp($angka){
        $uang = "Rp ". number_format($angka,0,',','.');
        return $uang;
    }
?>