
ready = function (f){/in/.test(document.readyState)?setTimeout('ready('+f+')',9):f()};

(function(WPMasjidNowWidget, undefined){
  
  WPMasjidNowWidget.MONTHS = [
    "January",
    "Februrary",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];
  
  WPMasjidNowWidget.DAYS = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ]
  
  WPMasjidNowWidget.timings = {};
  WPMasjidNowWidget.date = (new Date());
  WPMasjidNowWidget.masjid = null;
  
  var hasTimingsForMonth = {};
  
  WPMasjidNowWidget.setClickListeners = function()
  {
    document.querySelector(".masjidnow-container .masjidnow-prev-day").onclick = (function(e){
        var date = WPMasjidNowWidget.date;
        date.setDate(date.getDate()-1);
        WPMasjidNowWidget.displayDay(date);
    });
    
    document.querySelector(".masjidnow-container .masjidnow-next-day").onclick = (function(e){
        var date = WPMasjidNowWidget.date;
        date.setDate(date.getDate()+1);
        WPMasjidNowWidget.displayDay(date);
    });

    document.querySelector(".masjidnow-container .masjidnow-date-text").onclick = (function(e){
        WPMasjidNowWidget.date = new Date();
        WPMasjidNowWidget.displayDay(WPMasjidNowWidget.date);
    });
  }

  WPMasjidNowWidget.findAndLoadWidgetTimings = function(){
    var containers = document.querySelectorAll(".masjidnow-container");
    for(var i =0 ; i < containers.length; i++) {
      var container = containers[i];
      var masjidId = container.dataset["masjidnowId"];
      var masjid = container.dataset["masjidnowMasjid"];
      masjid = JSON.parse(masjid);
      console.log("Parsed timings for masjid ", masjidId);
      WPMasjidNowWidget.saveTimings(masjid);
    }
  }
  
  /*
   * This allows us to access timings by day and month correctly.
   * */
  WPMasjidNowWidget.saveTimings = function(masjid)
  {
    WPMasjidNowWidget.masjid = masjid;
    var timings = masjid.salah_timings;
    var monthMap = {};
    for(var i =0; i < timings.length; i++)
    {
      var timing = timings[i].salah_timing;
      monthMap[timing.day] = timing;
    }
    //subtract one because the api considers Jan = 1, not 0
    WPMasjidNowWidget.timings[timing.month-1] = monthMap;
  }
  
  WPMasjidNowWidget.getTiming = function(date)
  {
    try{
      var month = date.getMonth();
      var day = date.getDate();
      var timing = WPMasjidNowWidget.timings[month][day];
      if(!timing)
        return null;
      /*
      var attempts = 0;
      while(!timing)
      {
        date.setDate(day-1);
        timing = WPMasjidNowWidget.timings[month][day];
        attempts++;
        if(attempts > 365)
        {
          //could not find a valid timing...
          return null;
        }
      }
      */
      return timing;
      
    }catch(e){
      //console.log("Error accessing "+month+"/"+day);
      
    }
    
    return null;
  }
  
  WPMasjidNowWidget.displayDay = function(date)
  {
    var timing = WPMasjidNowWidget.getTiming(date);
    
    setDateText(date);
    setIqamahDateText(timing);
    
    if(timing == null)
    {
      displayDayNoTimings();
      if(hasTimingsForMonth[date.getMonth()] !== false)
      {
        //we haven't yet checked if there are timings for this month
        var apiUrl = "https://www.masjidnow.com/api/v2/salah_timings/monthly.json?";
        apiUrl += "masjid_id="+WPMasjidNowWidget.masjid.id;
        apiUrl += "&month="+(date.getMonth()+1);
        apiUrl += "&year="+(date.getFullYear());
        console.log("Querying url for salah timings: "+apiUrl);
        ajaxCall(apiUrl, "WPMasjidNowWidget.parseAjaxResponse");
      }
    }
    else
    {
      displayDayWithTimings(timing);
    }
  }
  
  WPMasjidNowWidget.parseAjaxResponse = function(data)
  {
    WPMasjidNowWidget.saveTimings(data.masjid);
    var date = WPMasjidNowWidget.date;
    var timing = WPMasjidNowWidget.getTiming(date);
    if(timing == null)
    {
      hasTimingsForMonth[date.getMonth()] = false;
    }
    else
    {
      WPMasjidNowWidget.displayDay(date);
    }
  }
    
  function ajaxCall(url, callbackName)
  {
    var script = document.createElement('script');
    script.src = url+"&callback="+callbackName

    document.getElementsByTagName('head')[0].appendChild(script);
  }
  
  function setDateText(date)
  {
    //set general date string
    var dateFormatOptions = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
    var dateStr = date.toLocaleDateString(window.navigator.language, dateFormatOptions);
    document.querySelector(".masjidnow-container .masjidnow-date-text").innerHTML = dateStr;
  }
  
  function setIqamahDateText(timing)
  {
    if(timing == null)
    {
      
      document.querySelector(".masjidnow-container .masjidnow-iqamah-date").innerHTML = "No iqamah timings available for this date.";
      return;
    }
    else{
      var day = timing.day;
      var month = timing.month;
      var year = timing.year;
      var date = new Date();
      date.setDate(day);
      date.setMonth(month-1);
      date.setYear(year);
      var monthStr = WPMasjidNowWidget.MONTHS[date.getMonth()];
      var dayStr = WPMasjidNowWidget.DAYS[date.getDay()];
      var dateStr = dayStr.substr(0,3)+" "+monthStr.substr(0,3)+" "+date.getDate()+", "+(date.getYear()+1900);
      
      document.querySelector(".masjidnow-container .masjidnow-iqamah-date").innerHTML = "Iqamah Timings for " + dateStr;
    }
  }
  
  function displayDayNoTimings()
  {
    var container = document.querySelector(".masjidnow-container");
    var keys = ["fajr", "sunrise", "dhuhr", "asr", "maghrib", "isha"];
    
    for(var i =0; i < keys.length; i++)
    {
      var key = keys[i];
      try{
        container.querySelector(".masjidnow-salah-row .masjidnow-salah-time-adhan.masjidnow-"+key).innerHTML = "---";
      } 
      catch(e) {
      }
      try{
        container.querySelector(".masjidnow-salah-row .masjidnow-salah-time-iqamah.masjidnow-"+key).innerHTML = "---";
      } 
      catch(e) {
      }
    }
  }
  
  function displayDayWithTimings(timing)
  {
    var container = document.querySelector(".masjidnow-container");
    var keys = ["fajr", "sunrise", "dhuhr", "asr", "maghrib", "isha"];
    
    for(var i =0; i < keys.length; i++)
    {
      var key = keys[i];
      try{
        container.querySelector(".masjidnow-salah-row .masjidnow-salah-time-adhan.masjidnow-"+key).innerHTML = timing[key+"_adhan"];
      } catch(e)
      {
      }
      try{
        container.querySelector(".masjidnow-salah-row .masjidnow-salah-time-iqamah.masjidnow-"+key).innerHTML = timing[key];
      } catch(e)
      {
      }
    }
    if(timing.hijri_date)
    {
        container.querySelector(".masjidnow-date-text").innerHTML += ("<br/>"+timing.hijri_date);
    }
  }
  
  //ready = function(){console.log("ready.")};
  
  ready(function(){
      
      WPMasjidNowWidget.setClickListeners();
      WPMasjidNowWidget.findAndLoadWidgetTimings();
  });
  
}(window.WPMasjidNowWidget = window.WPMasjidNowWidget || {}));

