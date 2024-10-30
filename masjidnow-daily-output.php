<?php

$iqamah_date_str = "";

$masjid_exists = $api_helper->does_masjid_exist();


if($masjid_exists)
{
  $location_name = $response["raw"]->masjid->name;
}
else
{
  if(isset($masjid_id))
  {
    $location_name = "Masjid with id $masjid_id Not Found";
  }
  else
  {
    $location_name = $location["latitude"].", ".$location["longitude"];
  }
}

$iqamah_date_str = "Iqamah timings for ".$api_helper->get_iqamah_date_str("D M j, Y");
$hijri_date_str = "";
if(isset($iqamah_times["hijri_date"]) && $iqamah_times["hijri_date"] != "")
{
  $hijri_date_str = $iqamah_times["hijri_date"];
}


$show_iqamah = $this->should_show_iqamah($api_helper);
$show_adhan = $this->should_show_adhan($instance);
$show_monthly_info = $this->should_show_monthly_info($instance);

$is_timings_old = false;
$iqamah_date_time = $api_helper->get_iqamah_date();
if($iqamah_date_time)
{
  $today_date_time = new DateTime();
  $ms_diff = $today_date_time->format('U') - $iqamah_date_time->format('U');
  $days_diff = $ms_diff / (60*60*24);
  if ($days_diff >= 1) {
      $is_timings_old = true;
  } 
  // ********* THIS WAY REQUIRES PHP 5.3+ ****************
  //$diff = $iqamah_date_time->diff(new DateTime());
  //if ($diff->format('%a') > '0') {
  //    $is_timings_old = true;
  //} 
}

//$iqamah_date_str = $salah_timings->month."/".$salah_timings->day."/".$salah_timings->year; 
?>
<?php 
  if(!empty($title))
  {
    echo($before_title . $title . $after_title);
  }
?>     

<?php include("daily-combined-output.php") ?>
