<?php

function MasjidNowMonthly_getOutput($attrs, $iqamah, $adhan)
{
  $defaults = array(
    'masjid_id' => null,
    'month' => null,
    'title' => null
  );
  extract( shortcode_atts( $defaults, $attrs ) );

  $prayer_names = get_option("masjidnow-prayer-names", array(
    "fajr" => "Fajr",
    "sunrise" => "Sunrise",
    "dhuhr" => "Dhuhr",
    "asr" => "Asr",
    "maghrib" => "Maghrib",
    "isha" => "Isha",
    "adhan" => "Adhan",
    "iqamah" => "Iqamah"
  ));

  if($iqamah && $adhan) {
    if($title == null) {
      $title =  $prayer_names["adhan"] . " & " . $prayer_names["iqamah"] . " Timings";
    }
    $shortcode = "masjidnow_monthly_combined";
    $outputTemplateFile = "monthly-combined-output.php";
  } 
  else if($iqamah) {
    if($title == null) {
      $title = $title . " " . $prayer_names["iqamah"] . " Timings";
    }
    $shortcode = "masjidnow_monthly";
    $outputTemplateFile = "monthly-iqamah-output.php";
  }
  else if($adhan) {
    if($title == null) {
      $title = $title . " " . $prayer_names["adhan"] . " Timings";
    }
    $shortcode = "masjidnow_monthly_adhan";
    $outputTemplateFile = "monthly-adhan-output.php";
  }
  
  $tz_string = get_option('timezone_string');
  if($tz_string == "")
  {
    echo("<h2>!!!!!!!!!!! ERROR !!!!!!!!!!!!!!</h2>");
    echo("MasjidNow requires you to set your timezone to a **named** timezone under your WordPress Admin Panel's Settings menu. (ex. Choose a timezone like \"New York\" instead of UTC -5)");
    echo("<h2>!!!!!!!!!!! END ERROR !!!!!!!!!!!!!!</h2>");

    $tz_string = "America/New_York";
    
  }

  // need to do two seperate initializers because 
  // setting one to the other will make them reference the same object
  $date_time_now = new DateTime("now", new DateTimeZone($tz_string));
  $date_time = new DateTime("now", new DateTimeZone($tz_string));
  
  if(isset($month))
  {
    $month = intval($month);
    if($month != $date_time_now->format("n"))
    {
      $date_time->setDate($date_time_now->format("Y"), $month , 1);
    }
  }
  
  if(!is_null($masjid_id))
  {
    $timings = MasjidNowMonthly_get_timings($masjid_id, $date_time, null, null);
    ob_start();
    include($outputTemplateFile);
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
  }
  else
  {
    return "ERROR! Please set the masjid_id by adding it to the end of the shortcode. (ie. [$shortcode masjid_id=1234])";
  }
}

function MasjidNowMonthly_getCombinedOutput($attrs)
{
  return MasjidNowMonthly_getOutput($attrs, true, true);
}

function MasjidNowMonthly_getIqamahOutput($attrs)
{
  return MasjidNowMonthly_getOutput($attrs, true, false);  
}

function MasjidNowMonthly_getAdhanOutput($attrs)
{
  return MasjidNowMonthly_getOutput($attrs, false, true);
}

function MasjidNowMonthly_get_timings($masjid_id, $date_time)
{
  $api_helper = new MasjidNow_APIHelper($masjid_id, $date_time, null, null);
  $timings = $api_helper->get_monthly_timings($date_time->format("Y"), $date_time->format("n"));
  return $timings["salah_timings"];
}

?>
