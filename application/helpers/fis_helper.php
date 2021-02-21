<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_tgl_indo')) {

  function format_tgl_indo($time = NULL, $format = '%d %M %Y')
  {
    if (!$time) {
      $time = time();
    } else {
      $time = strtotime($time);
    }

    $date_obj = getdate($time);

    $bulan = array(
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $bulan_short = array(
      'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    );

    $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

    $format_search = array('%d', '%D', '%m', '%M', '%S', '%y', '%Y', '%H', '%i', '%s');
    $format_replace = array(
      $date_obj['mday'], $hari[$date_obj['wday']], $date_obj['mon'], $bulan[$date_obj['mon'] - 1],
      $bulan_short[$date_obj['mon'] - 1], $date_obj['year'], $date_obj['year'], $date_obj['hours'],
      $date_obj['minutes'], $date_obj['seconds']
    );
    $str = str_replace($format_search, $format_replace, $format);

    return $str;
  }
}

if (!function_exists('dateToSql')) {

  // dd/mm/yyyy -> yyyy-mm-dd
  function dateToSql($date)
  {
    $date = str_replace('/', '-', $date);
    return date('Y-m-d', strtotime($date));
  }
}

/*
 * asdsa
 */

if (!function_exists('dateRangeToSql')) {

  // dd/mm/yyyy -> yyyy-mm-dd
  function dateRangeToSql($daterange)
  {
    $daterange = explode(' - ', $daterange);

    $datestart = explode('/', $daterange[0]);
    $dateend = explode('/', $daterange[1]);

    $finalDate['start'] = $datestart[2] . '-' . $datestart[0] . '-' . $datestart[1];
    $finalDate['end'] = $dateend[2] . '-' . $dateend[0] . '-' . $dateend[1];


    return $finalDate;
  }
}



if (!function_exists('bulanIndo')) {

  function bulanIndo($bulan)
  {
    $BulanIndo = array(
      "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
      "November", "Desember"
    );
    echo $BulanIndo[(int) $bulan - 1];
  }
}

/**
 * Format Currency Rupiah   Rp. ---.---,--
 * Exp : 250.000,00
 */
if (!function_exists('rupiah')) {

  function rupiah($value, $step = 0)
  {
    $rupiah = "Rp. " . number_format($value, $step, ',', '.') . "";
    return $rupiah;
  }
}

/**
 * Currency 
 * 
 * @return ---.---,--
 * @example 250.000,00
 */
if (!function_exists('currency')) {

  function currency($value)
  {
    $rupiah = number_format($value, 0, ',', '.') . ",00";
    return $rupiah;
  }
}

/* * *
 *  Romawi
 */
if (!function_exists('romanic_number')) {

  function romanic_number($integer)
  {
    $table = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $return = '';
    while ($integer > 0) {
      foreach ($table as $rom => $arb) {
        if ($integer >= $arb) {
          $integer -= $arb;
          $return .= $rom;
          break;
        }
      }
    }

    return $return;
  }
}


/* * *
 *  Fungsi Konvert ke alfabert excel
 */
if (!function_exists('columnLetter')) {

  function columnLetter($c)
  {
    $c = intval($c);
    if ($c <= 0) {
      return '';
    }
    $letter = '';

    while ($c != 0) {
      $p = ($c - 1) % 26;
      $c = intval(($c - $p) / 26);
      $letter = chr(65 + $p) . $letter;
    }

    return $letter;
  }
}

/**
 * Fungsi Terbilang
 */
if (!function_exists('terbilang')) {

  function terbilang($x, $style = 4)
  {

    $nx = round($x, 0);

    if ($x < 0) {
      $hasil = "minus " . trim(kekata($nx));
    } else {
      $hasil = trim(kekata($nx));
    }
    switch ($style) {
      case 1:
        $hasil = strtoupper($hasil);
        break;
      case 2:
        $hasil = strtolower($hasil);
        break;
      case 3:
        $hasil = ucwords($hasil);
        break;
      default:
        $hasil = ucfirst($hasil);
        break;
    }
    return $hasil;
  }
}

if (!function_exists('kekata')) {

  function kekata($x)
  {
    $x = abs($x);
    $angka = array(
      "", "satu", "dua", "tiga", "empat", "lima",
      "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
    );
    $temp = "";
    if ($x < 12) {
      $temp = " " . $angka[$x];
    } else if ($x < 20) {
      $temp = kekata($x - 10) . " belas";
    } else if ($x < 100) {
      $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
    } else if ($x < 200) {
      $temp = " seratus" . kekata($x - 100);
    } else if ($x < 1000) {
      $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
    } else if ($x < 2000) {
      $temp = " seribu" . kekata($x - 1000);
    } else if ($x < 1000000) {
      $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
    } else if ($x < 1000000000) {
      $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
    } else if ($x < 1000000000000) {
      $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
    } else if ($x < 1000000000000000) {
      $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
    }
    return $temp;
  }
}

// ------------------------------------------------------------------------

/* End of file fis_helper.php */
/* Location: ./application/helpers/fis_helper.php */
