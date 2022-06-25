<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('format_tanggal'))

{

    function format_tanggal($tgl)

    {
	    $date = new DateTime($tgl);
      //echo $date;
      $year = $date -> format('Y');
      $bln = $date -> format('m');
      $month = $date -> format('m');
      $day = $date -> format('d');
	  if($bln=='01'){
      $bln="Januari";
	   }

	   else if ($bln=='02'){
		   $bln="Februari";
	   }
     else if ($bln=='03'){
 		  $bln="Maret";
 	   }
	   else if ($bln=='04'){
	   		$bln="April";
	   }
	   else if ($bln=='05'){
	   		$bln="Mei";
	   }
	   else if ($bln=='06'){
	   		$bln="Juni";
	   }
	   else if ($bln=='07'){
	   		$bln="Juli";
	   }
	   else if ($bln=='08'){
	   		$bln="Agustus";
	   }
	   else if ($bln=='09'){
	   		$bln="September";
	   }
	   else if ($bln=='10'){
	   		$bln="Oktober";
	   }
	   else if ($bln=='11'){
	   		$bln="November";
	   }
	   else if ($bln=='12'){
	   		$bln="Desember";
	   }


      //return ' '.$day.' '.$bln.' '.$year;
      //return $day.' '.$bln.' '.$year;
      return $day.' '.$bln.' '.$year;

    }





}
