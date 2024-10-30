<div class="wrapper">
    
    <p>
      <strong>General Settings</strong>
    </p>
    
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title</label><br/>
    <input class="widefat" 
      id="<?php echo $this->get_field_id('title'); ?>"
      name="<?php echo $this->get_field_name('title'); ?>"
      type="text"
      value="<?php echo esc_attr($title); ?>" />
    </p>
    
    <p>
    <label for="<?php echo $this->get_field_id('masjid-id'); ?>">Masjid ID:</label> <br/>
    <input class="widefat" 
      id="<?php echo $this->get_field_id('masjid-id'); ?>" 
      name="<?php echo $this->get_field_name('masjid-id'); ?>" 
      type="text" 
      value="<?php echo esc_attr($masjid_id); ?>" />
    </p>
      
      
    <p style="font-size:11px;">The masjid id can be found by looking at the end of the masjid's URL from masjidnow.com. 
    <br/> ex. http://masjidnow.com/masjids/0-demo-masjid has a masjid id of 0.</p>
    
    <p>
      <strong>Display Settings</strong>
    </p>
    
    <p>
    <input 
      id="<?php echo $this->get_field_id('show-adhan'); ?>" 
      name="<?php echo $this->get_field_name('show-adhan'); ?>" 
      type="checkbox"
      <?php echo($user_show_adhan ? "checked" : ""); ?> 
    />
    <label for="<?php echo $this->get_field_id('show-adhan'); ?>">Show Adhan Column</label>
    
    </p>
    
    <p>
    <input 
      id="<?php echo $this->get_field_id('show-monthly-info'); ?>" 
      name="<?php echo $this->get_field_name('show-monthly-info'); ?>" 
      type="checkbox"
      <?php echo($user_show_monthly_info ? "checked" : ""); ?> 
    />
    <label for="<?php echo $this->get_field_id('show-monthly-info'); ?>">Show Monthly Info (ex. Jummah times)</label>
    
    </p>
        
    <p>
      <label for="<?php echo $this->get_field_id('show-monthly-info'); ?>">Extra Info (optional)</label> <br/>
      <span style="font-size:11px;">Displayed at the bottom of the table. If you have monthly info being shown, this is probably unnecessary.</span> <br/>
      <textarea
        id="<?php echo $this->get_field_id('extra-info'); ?>" 
        name="<?php echo $this->get_field_name('extra-info'); ?>" 
        style="width:100%;"
      ><?php echo(trim($extra_info)); ?></textarea>
    </p>
        
    <p>
    <input 
      id="<?php echo $this->get_field_id('show-name'); ?>" 
      name="<?php echo $this->get_field_name('show-name'); ?>" 
      type="checkbox"
      <?php echo($show_name ? "checked" : ""); ?> 
    />
    <label for="<?php echo $this->get_field_id('show-name'); ?>">Display Masjid Name</label>
    
    </p>
      
    <p>  
    <label for="<?php echo $this->get_field_id('bg-color'); ?>">Background Color:</label> 
    <input class="widefat masjidnow-color" 
      id="<?php echo $this->get_field_id('bg-color'); ?>" 
      name="<?php echo $this->get_field_name('bg-color'); ?>" 
      type="text" 
      value="<?php echo esc_attr($bg_color);?>" />
    </p>
    
    <p>  
    <label for="<?php echo $this->get_field_id('primary-color'); ?>">Primary Color:</label> 
    <input class="widefat masjidnow-color masjidnow-color-primary" 
      id="<?php echo $this->get_field_id('primary-color'); ?>" 
      name="<?php echo $this->get_field_name('primary-color'); ?>" 
      type="text" 
      value="<?php echo esc_attr($primary_color);?>" />
    </p>
    
    <p>  
    <label for="<?php echo $this->get_field_id('secondary-color'); ?>">Secondary Color:</label> 
    <input class="widefat masjidnow-color masjidnow-color-secondary" 
      id="<?php echo $this->get_field_id('secondary-color'); ?>" 
      name="<?php echo $this->get_field_name('secondary-color'); ?>" 
      type="text" 
      value="<?php echo esc_attr($secondary_color);?>" />
    </p>
      
    <p style="font-size:11px;">Selecting a theme will change the colors above.</p>
    <p>  
    <label for="<?php echo $this->get_field_id('theme'); ?>">Widget Theme:</label> <br/>
    <select class="widefat masjidnow-theme" 
      id="<?php echo $this->get_field_id('theme'); ?>" 
      name="<?php echo $this->get_field_name('theme'); ?>" 
      type="text" 
      value="<?php echo esc_attr($masjid_id);?>">
      <option></option>
      <?php 
      for($i = 0; $i < count(MasjidNow_Widget::$THEME_NAMES); $i++){ ?>
        <option value="<?php echo(MasjidNow_Widget::$THEME_NAMES[$i]); ?>">
          <?php echo(MasjidNow_Widget::$THEME_DESCS[$i]);?>
        </option>
      <?php 
      }
      ?>
    </select>
    </p>
    
    <hr style="margin-top:20px; margin-bottom:20px;"/>
    
    <strong>Salah Times Calculations</strong>
    <p style="font-size:11px;">
      These settings only take effect if you don't have salah timings uploaded to MasjidNow.com.<br/>
      If you have timings uploaded, you must change your settings from our website.
    </p>
    
    <a class='masjidnow-show-more' style='display:block; margin:20px 0px;'>Show Settings...</a>
    
    <div class='masjidnow-settings-drawer' style='margin-bottom:20px; display:none;'>
      <p>
      <label for="<?php echo $this->get_field_id('latitude'); ?>">Latitude, Longitude</label> <br/>
      <input class="widefat" style="width:100px" 
        id="<?php echo $this->get_field_id('latitude'); ?>" 
        name="<?php echo $this->get_field_name('latitude'); ?>" 
        type="text"
        placeholder="Latitude (ex. 42.123123)"
        value="<?php echo esc_attr($latitude); ?>" />
      <input class="widefat" style="width:100px" 
        id="<?php echo $this->get_field_id('longitude'); ?>" 
        name="<?php echo $this->get_field_name('longitude'); ?>" 
        type="text"
        placeholder="Longitude (ex. -82.123123)"
        value="<?php echo esc_attr($longitude); ?>" />
      
      </p>
      
      <p>
      <label for="<?php echo $this->get_field_id('time-zone-id'); ?>">Time Zone:</label> <br/>
      <select class="widefat" 
        id="<?php echo $this->get_field_id('time-zone-id'); ?>" 
        name="<?php echo $this->get_field_name('time-zone-id'); ?>" 
        type="text">
        <?php 
        foreach(MasjidNowTimeZoneNames::$TIME_ZONES as $timeZoneKey => $timeZoneVal){ ?>
          <option value="<?php echo($timeZoneVal); ?>"
            <?= ($timeZoneVal == $time_zone_id) ? "selected": ""?>>
            <?= $timeZoneKey ?>
          </option>
        <?php
        }
        ?>
      </select>
      
      </p>
      
      <p>
      <label for="<?php echo $this->get_field_id('pray-time-calc-method'); ?>">Calculation Method:</label> <br/>
      <select class="widefat" 
        id="<?php echo $this->get_field_id('pray-time-calc-method'); ?>" 
        name="<?php echo $this->get_field_name('pray-time-calc-method'); ?>" 
        type="text">
        <?php 
        foreach(MasjidNow_PrayTime::$CALC_METHODS as $methodKey => $methodVal){ ?>
          <option value="<?= $methodVal?>"
            <?= ($methodVal == $pray_time_calc_method) ? "selected": ""?>>
            <?= $methodKey ?>
          </option>
        <?php
        }
        ?>
      </select>
      </p>
      
      <p>
      <label for="<?php echo $this->get_field_id('pray-time-asr-juristic'); ?>">Calculation Method:</label> <br/>
      <select class="widefat" 
        id="<?php echo $this->get_field_id('pray-time-asr-juristic'); ?>" 
        name="<?php echo $this->get_field_name('pray-time-asr-juristic'); ?>" 
        type="text">
        <?php 
        foreach(MasjidNow_PrayTime::$ASR_JURISTICS as $juristicKey => $juristicVal){ ?>
          <option value="<?php echo($juristicVal); ?>"
            <?= ($juristicVal == $pray_time_asr_juristic) ? "selected": ""?>>
            <?= $juristicKey ?>
          </option>
        <?php
        }
        ?>
      </select>
      
      </p>
    </div>
    
    
    
 
</div>
