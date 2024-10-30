<?php
  $cache_cleared = false;
  $prayer_keys = array("fajr", "sunrise", "dhuhr", "asr", "maghrib", "isha", "adhan", "iqamah");
  
  $default_names = array(
    "fajr" => "Fajr",
    "sunrise" => "Sunrise",
    "dhuhr" => "Dhuhr",
    "asr" => "Asr",
    "maghrib" => "Maghrib",
    "isha" => "Isha",
    "adhan" => "Adhan",
    "iqamah" => "Iqamah"
  );
  $prayer_names = get_option("masjidnow-prayer-names", $default_names);
  
  //just in case prayer_names is missing some defaults
  $prayer_names = array_merge($prayer_names, $default_names);
  
  
  if(isset($_POST["masjidnow"]) && isset($_POST["masjidnow"]["invalidate-cache"]) && $_POST["masjidnow"]["invalidate-cache"] == true)
  {
    //legacy cache with only one masjid supported.
    for($i =1; $i <= 12; $i++)
    {
      delete_option("masjidnow-cached-api-response-$i");
      delete_option("masjidnow-cached-api-response-$i-timestamp");
    }
    
    // new cache
    delete_option("masjidnow-cached-api-responses");
    
    $cache_cleared = true;
  }
  
  if(isset($_POST["masjidnow"]) && isset($_POST["masjidnow"]["prayer-names"]))
  {
    update_option("masjidnow-prayer-names", $_POST["masjidnow"]["prayer-names"]);
    $prayer_names = $_POST["masjidnow"]["prayer-names"];
  }
  
  

?>


<div>
  <h2>MasjidNow Settings</h2>
  Everytime you update your timings, you should clear the cache.
  
  <?php if($cache_cleared) { ?>
  <p>
    The MasjidNow cache was cleared.
  </p>
  <?php } ?>
    
    
  <form action="options-general.php?page=masjidnow" method="post">
    
    <input name="masjidnow[invalidate-cache]" value="true" type="hidden"/>
    <p>
      <input name="Submit" type="submit" value="Clear Cache" />
    </p>
  </form>
  
  <hr/>
  
  <form action="options-general.php?page=masjidnow" method="post">
    
    <p>
      You can change what names are displayed for each prayer. This is useful if your users speak a language other than English,
      or if you use a different spelling or pronounciation for each prayer. (ex. Isha => Ichaa)
    </p>
    
    <?php for($i = 0; $i < count($prayer_keys); $i++) { ?>
      <p>
        <?php $key = $prayer_keys[$i]; ?>
        <?php $name = $prayer_names[$key]; ?>
        <label for=""><?php echo(ucfirst($key)); ?></label>
        <input type="text" name="masjidnow[prayer-names][<?php echo $key ?>]" value="<?php echo $name?>" />
      </p>
    <?php } ?>
    <input name="Submit" type="submit" value="Save Settings" />
  </form>
</div>
