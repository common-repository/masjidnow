<?php

require_once("libs/PrayTime.php");

class MasjidNow_PrayTimeHelper{
  
  static function get_pray_time($settings)
  {
    $pray_time = new MasjidNow_PrayTime($settings["calc_method"]);
    $pray_time->setAsrMethod($settings["asr_juristic"]);
    $pray_time->setHighLatsMethod($settings["high_lats"]);
    $pray_time->setTimeFormat($settings["time_format"]);
    return $pray_time;
  }
  
  static function get_pray_time_settings_from_widget($instance)
  {
    $pray_time_calc_method = empty($instance['pray-time-calc-method']) ? 2 : $instance['pray-time-calc-method']; 
    $pray_time_asr_juristic = empty($instance['pray-time-asr-juristic']) ? 2 : $instance['pray-time-asr-juristic']; 
    $pray_time_high_lats_method = 1; //Midnight
    $pray_time_time_format = 1; //time12
    $settings = array(
      "asr_juristic" => $pray_time_asr_juristic,
      "calc_method" => $pray_time_calc_method,
      "high_lats" => $pray_time_high_lats_method,
      "time_format" => $pray_time_time_format,
    );
    return $settings;
  }
  
  static function get_location($instance)
  {
    $latitude = empty($instance['latitude']) ? 2 : $instance['latitude']; 
    $longitude = empty($instance['longitude']) ? 2 : $instance['longitude'];
    $time_zone_id = empty($instance['time-zone-id']) ? "America/New_York" : $instance['time-zone-id'];
    return array(
      "latitude" => $latitude,
      "longitude" => $longitude,
      "time_zone_id" => $time_zone_id,
    ); 
  }
  
}

?>
