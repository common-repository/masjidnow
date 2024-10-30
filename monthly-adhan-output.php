<div class='masjidnow-monthly-container'>

  <div class='masjidnow-month'><?php echo(date_i18n("F Y", date_timestamp_get($date_time))) ?> | <?php echo $title ?></div>

  <table class='masjidnow-adhan-timings'>
    <tr>
      <th><?php echo(date_i18n("M", date_timestamp_get($date_time))) ?>/Day</th>
      <th><?php echo($prayer_names["fajr"]) ?></th>
      <th><?php echo($prayer_names["sunrise"]) ?></th>
      <th><?php echo($prayer_names["dhuhr"]) ?></th>
      <th><?php echo($prayer_names["asr"]) ?></th>
      <th><?php echo($prayer_names["maghrib"]) ?></th>
      <th><?php echo($prayer_names["isha"]) ?></th>
    </tr>
    
    <?php for($i =0; $i < count($timings); $i++) {
      $timing = $timings[$i]->salah_timing;
      $classes = "";
      $date_str = $timing->year."-".$timing->month."-".$timing->day;
      if($timing->day == $date_time_now->format("d") &&
          $timing->month == $date_time_now->format("m"))
      {
        $classes .= " masjidnow-active";
      }
      $date_out_obj = new DateTime($date_str);
      $date_out = date_i18n("d D", date_timestamp_get($date_out_obj));
    ?>
      <tr class="<?php echo($classes) ?>">
        <td><?php echo($date_out); ?></td>
        <td><?php echo($timing->fajr_adhan); ?></td>
        <td><?php echo($timing->sunrise_adhan); ?></td>
        <td><?php echo($timing->dhuhr_adhan); ?></td>
        <td><?php echo($timing->asr_adhan); ?></td>
        <td><?php echo($timing->maghrib_adhan); ?></td>
        <td><?php echo($timing->isha_adhan); ?></td>
      </tr>
    <?php } ?>
    
  </table>
  
</div>
