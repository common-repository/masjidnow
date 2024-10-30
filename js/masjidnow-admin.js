jQuery(function(){
  var $ = jQuery;
  
  var THEMES = {
    "default": {
      "primary": "#666666",
      "secondary": "#555555"
    },
    "blue": {
      "primary": "#333333",
      "secondary": "#E0E6E6"
    }
  }
  
  function initColorPickers(){
    $(".masjidnow-color").wpColorPicker();


    $(".masjidnow-theme").change(function(e){
      var theme = $(this).val();
      var primary = THEMES[theme]["primary"];
      var secondary = THEMES[theme]["secondary"];
      
      var $themeSelect = $(this);
      var $primaryPicker = $themeSelect.parents(".widget").find(".masjidnow-color-primary");
      var $secondaryPicker = $themeSelect.parents(".widget").find(".masjidnow-color-secondary");
      $primaryPicker.val(primary);
      $secondaryPicker.val(secondary);
      
      $primaryPicker.change();
      $secondaryPicker.change();
    });
  }
  
  function initClickListeners()
  {
    $(".masjidnow-show-more").click(function(e){
      $(this).nextAll(".masjidnow-settings-drawer").first().toggle("slide");
    });
  }
    
  initColorPickers();
  initClickListeners();
  
  $(".masjidnow-theme").parents(".widget").find("form input[type='submit']").click(function(e){
      setTimeout(
        function(){
          initColorPickers();
          initClickListeners();
        },
        2000);
  });
  
  
  
  
});
