<?php
/*
Plugin Name: MasjidNow
Plugin URI: http://wordpress.org/extend/plugins/masjidnow/
Description: Widgets and shortcodes to display your daily and monthly adhan and iqamah timings from MasjidNow.com. Calculated adhan times available too!
Version: 1.6.7
Author: MasjidNow
Author URI: http://masjidnow.com
License: GPL2
*/

$GLOBALS["MASJIDNOW_PLUGIN_VERSION"] = "1.6.7";

require_once("libs/PrayTime.php");
include("libs/MasjidNowTimeZoneNames.php");
include("class-praytime-helper.php");
include("class-api-helper.php");
include("monthly.php");
include("daily.php");


class MasjidNow_Widget extends WP_Widget
{
  
  const THEME_PREFIX = "masjidnow-theme-";
  
  /** @const */
  private static $THEME_NAMES = array("default", "blue");
  /** @const */
  private static $THEME_DESCS = array("Default (gray)", "Blue");
  
  function __construct()
  {
    $widget_ops = array('classname' => 'MasjidNow_Widget', 'description' => 'MasjidNow Daily Iqamah Timings');
    parent::__construct('MasjidNow_Widget', 'MasjidNow Daily Iqamah Timings', $widget_ops);
    $this->add_stylesheet();
    $this->add_javascript();
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 
        'title' => '',
        'masjid-id' => '',
        'show-adhan' => false,
        'show-monthly-info' => false,
        'extra-info' => '',
        'show-name' => 'on',
        'bg-color' => null,
        'primary-color' => '',
        'secondary-color' => '',
        'theme' => 'default',
        'time-zone-id' => "America/New_York",
        'pray-time-calc-method' => 2,
        'latitude' => 42.5,
        'longitude' => -83,
        'pray-time-asr-juristic' => 0
      )
    );
    $title = $instance['title'];
    $masjid_id = $instance['masjid-id'];
    $user_show_adhan = $instance['show-adhan'];
    $user_show_monthly_info = $instance['show-monthly-info'];
    $extra_info = $instance['extra-info'];
    $show_name = $instance['show-name'];
    $bg_color = $instance['bg-color'];
    $primary_color = $instance['primary-color'];
    $secondary_color = $instance['secondary-color'];
    $theme = $instance['theme'];
    $time_zone_id = $instance['time-zone-id'];
    $latitude = $instance['latitude'];
    $longitude = $instance['longitude'];
    $pray_time_calc_method = $instance['pray-time-calc-method'];
    $pray_time_asr_juristic = $instance['pray-time-asr-juristic'];
    
    // Css rules for Color Picker
    wp_enqueue_style( 'wp-color-picker' );
    // Register javascript
  
    wp_register_script( 'masjidnow-admin-js', plugins_url('js/masjidnow-admin.js', __FILE__), array( 'jquery', 'wp-color-picker' ), '', true);
    wp_enqueue_script('masjidnow-admin-js');
    
    include 'masjidnow-admin.php';
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    
    $instance['title'] = $new_instance['title'];
    $instance['masjid-id'] = $new_instance['masjid-id'];
    $instance['show-adhan'] = $new_instance['show-adhan'];
    $instance['show-monthly-info'] = $new_instance['show-monthly-info'];
    $instance['extra-info'] = $new_instance['extra-info'];
    $instance['show-name'] = $new_instance['show-name'];
    $instance['bg-color'] = $new_instance['bg-color'];
    $instance['primary-color'] = $new_instance['primary-color'];
    $instance['secondary-color'] = $new_instance['secondary-color'];
    $instance['theme'] = $new_instance['theme'];
    $instance['time-zone-id'] = $new_instance['time-zone-id'];
    $instance['latitude'] = $new_instance['latitude'];
    $instance['longitude'] = $new_instance['longitude'];
    $instance['pray-time-calc-method'] = $new_instance['pray-time-calc-method'];
    $instance['pray-time-asr-juristic'] = $new_instance['pray-time-asr-juristic'];
    
    
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    add_action( 'wp_enqueue_scripts', 'add_stylesheet' );
  
    echo $before_widget;
    $title = empty($instance['title']) ? NULL : apply_filters('widget_title', $instance['title']); 
    $masjid_id = empty($instance['masjid-id']) ? NULL : $instance['masjid-id'];    
    $show_name = empty($instance['show-name']) ? 'off' : $instance['show-name'];  
    $extra_info = empty($instance['extra-info']) ? '' : $instance['extra-info'];  
    $bg_color = empty($instance['bg-color']) ? '' : $instance['bg-color']; 
    $primary_color = empty($instance['primary-color']) ? '' : $instance['primary-color']; 
    $secondary_color = empty($instance['secondary-color']) ? '' : $instance['secondary-color'];  
       
    $location = MasjidNow_PrayTimeHelper::get_location($instance);

    //wordpress changes this elsewhere, so save it and reset it at the end of the function.
    $original_time_zone_id = date_default_timezone_get();
    $time_zone_id = $location["time_zone_id"];
    date_default_timezone_set($time_zone_id);
    $date_time_zone = new DateTimeZone($time_zone_id);
    $date_time_now = new DateTime("now", $date_time_zone);

    $pray_time_settings = MasjidNow_PrayTimeHelper::get_pray_time_settings_from_widget($instance); 
    $api_helper = new MasjidNow_ApiHelper($masjid_id, $date_time_now, $pray_time_settings, $location);
    $response = $api_helper->get_timings();
    $adhan_times = $response["adhan_timings"];
    $iqamah_times = $response["iqamah_timings"];
    $monthly_info = $response["monthly_info"];
    $masjid_url = $response["url"];
    
    
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
    
    include("masjidnow-daily-output.php");
    
    date_default_timezone_set($original_time_zone_id);
    
    echo $after_widget;
  }
  
  function should_show_iqamah($api_helper)
  {
    return $api_helper->does_masjid_exist();
  }
  
  function should_show_adhan($instance)
  {
    return empty($instance['show-adhan']) ? false : $instance['show-adhan'];
  }
  
  function should_show_monthly_info($instance)
  {
    return empty($instance['show-monthly-info']) ? false : $instance['show-monthly-info'];
  }
  
  function add_stylesheet() {
      // Respects SSL, Style.css is relative to the current file
      wp_register_style( 'masjidnow-style', plugins_url('masjidnow.css', __FILE__) );
      wp_enqueue_style( 'masjidnow-style' );
  }
  
  function add_javascript() {
      // Respects SSL, Style.css is relative to the current file
      wp_register_script( 'masjidnow-js', plugins_url('js/WPMasjidNowWidget.js', __FILE__) );
      wp_enqueue_script('masjidnow-js');
  }
  
  function get_theme_names()
  {
    return self::THEME_NAMES;
  }
  
  function get_theme_descs()
  {
    return self::THEME_DESCS;
  }
  
  function get_salah_row_start_tag($num, $alt_color)
  {
    if($num % 2 == 1)
    {
      return "<tr class='masjidnow-salah-row' style='background-color: $alt_color ;'>";
    }
    else
    {
      return "<tr class='masjidnow-salah-row'>";
    }
  }
  
}

function MasjidNow_plugin_options_page()
{
  include("masjidnow-plugin-options.php");
}

add_action( 'widgets_init', create_function('', 'return register_widget("MasjidNow_Widget");') );


add_shortcode("masjidnow_daily", "MasjidNowDaily_getCombinedOutput");

add_shortcode("masjidnow_monthly", "MasjidNowMonthly_getIqamahOutput");
add_shortcode("masjidnow_monthly_adhan", "MasjidNowMonthly_getAdhanOutput");
add_shortcode("masjidnow_monthly_combined", "MasjidNowMonthly_getCombinedOutput");

// Add Clear Cache link on plugin page
function your_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=masjidnow">Clear Cache!</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'your_plugin_settings_link' );

//Add Settings page
add_action('admin_menu', 'masjidnow_admin_add_page');
function masjidnow_admin_add_page() {
  add_options_page('MasjidNow Settings', 'MasjidNow Settings', 'manage_options', 'masjidnow', 'MasjidNow_plugin_options_page');
}

?>
