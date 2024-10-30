=== MasjidNow Prayer Timings for Mosques ===
Contributors: yaj786
Donate link: 
Tags: masjidnow, iqamah, prayer, salah, islam, masjid, mosque, salat
Requires at least: 3.5.1
Tested up to: 4.9.1
Stable tag: 1.6.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Daily and monthly adhan and iqamah timings from MasjidNow.com on your mosque page!

== Description ==

Provides a widget for displaying daily iqamah timings from [MasjidNow.com](https://www.masjidnow.com) for any mosque that has uploaded it's timings there.
The timings are displayed along-side adhan timings which can be adjusted from the plugin's settings if necessary.

Also provides a shortcode for displaying the monthly iqamah timings table.

The daily timings widgets are easily customizable with different colors, and can even be used with different languages.

**Features:**

* Display adhan and iqamah times
* Interactive with ability to click forward and backward to see different day's timings
* View daily or monthly timings
* Show monthly information (ex. Jummah times)
* Choose from different themes or colors
* Usable with any language site

To be able to show timings, you must have [signed up your mosque](https://www.masjidnow.com) at MasjidNow.com.

ATTENTION: You must clear the cache after updating the masjid's salah timings. You can do this by going the MasjidNow Settings page and clicking "Clear Cache".

== Screenshots ==

1. The daily timings widget.

2. The daily timings widget with the blue theme applied, and "show monthly info" setting checked.

3. The daily timings widget with the text color and row alternate color changed. The titles of "Azan" and "Iqamat" were also changed in the MasjidNow Settings.

4. The monthly timings shortcode. The current day is highlighted to help users quickly find the date.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `masjidnow` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

= Daily Timings Sidebar Widget =

1. Place the `MasjidNow Daily Iqamah Timings` widget in the correct area through the `Appearance` > `Widgets` menu in WordPress.
2. Change the widget's settings to your preference, then press save.

= Daily Timings Shortcode =

A shortcode is a small piece of code that you can copy and paste on one of your WordPress pages; The shortcode will output something when it is viewed by a visitor to your website. 

MasjidNow has shortcodes for both daily and monthly timings. When you put one of our shortcodes on your WordPress site, it will output our timings.

To show the daily timings table anywhere on your site:

1. Place the shortcode `[masjidnow_daily masjid_id=XXXX]`, replacing XXXX with your mosque's MasjidNow.com id. This can be found at the end of the MasjidNow.com url for your mosque.
For example, https://www.masjidnow.com/masjids/5312 has a masjid_id of 5312. Simple!

You can customize the daily shortcode by adding more parameters. For example, to set the background color of the table, you can write:

`[masjidnow_daily masjid_id=XXXX bg_color=#FF0000]`

Or to show the monthly information at the bottom of the table:

`[masjidnow_daily masjid_id=XXXX show_monthly_info=true]`

**Accepted Parameters for Daily Timings:**

*All parameters are optional*

* **masjid_id** - *(integer)* This is the masjid id that can be found from the MasjidNow.com masjid page url
* **show_adhan** - *(true or false)* Whether to show the adhan timings from MasjidNow.com
* **show_monthly_info** - *(true or false)* Whether to show the additional monthly info at the bottom of the table (ex. Jummah/Friday Prayer times) 
* **show_name** - *(true or false)* Whether to show the name of the mosque at the bottom of the table
* **bg_color** - *(color code like #FFFF00)* What color to make the background of the table. Leave blank to make the background transparent.
* **primary_color** - *(color code like #FFFF00)* What color to make the text.
* **secondary_color** - *(color code like #FFFF00)* What color to make the alternating rows of the table.
* **extra_info** - *(text)* Any text that you would like to display under the timings. This should be surrounded by quotes. Accepts basic HTML.

= Monthly Timings Table Shortcode =

A shortcode is a small piece of code that you can copy and paste on one of your WordPress pages; The shortcode will output something when it is viewed by a visitor to your website. 

MasjidNow has shortcodes for both daily and monthly timings. When you put one of our shortcodes on your WordPress site, it will output our timings.

To show the monthly timings table anywhere on your site:

0. First, choose either `masjidnow_monthly_combined`, `masjidnow_monthly_adhan`, or `masjidnow_monthly`.  `masjidnow_monthly_combined` will display both adhan and iqamah timings in one table, `masjidnow_monthly_adhan` will show only adhan timings, and `masjidnow_monthly` will show just iqamah timings.

1. Place the shortcode `[masjidnow_monthly masjid_id=XXXX]`, replacing XXXX with your mosque's MasjidNow.com id. This can be found at the end of the MasjidNow.com url for your mosque.
For example, https://www.masjidnow.com/masjids/0-demo-masjid has a masjid_id of 0. Simple!

You can customize the monthly shortcodes by adding more parameters. For example, to set the title of the Monthly Timings (next to the month and year), you can write
`[masjidnow_monthly masjid_id=XXXX title="Our Azan Timings"]`

**Accepted Parameters for Monthly Timings Table:**

* **masjid_id** - *(integer)* This is the masjid id that can be found from the MasjidNow.com masjid page url
* **title** - *(text)* The text that displays at the top of the timings table next to the month and year. Should be surrounded by quotes.


= Using the Widget in a Different Language =

The default language for the widgets and shortcodes is English. 
However, you can change how the plugin displays the names of the prayers and the titles for "Adhan" and "Iqamah" by going to the MasjidNow Settings page, under `Settings` in your WordPress Installation.

For example, if you would prefer 'Isha' be spelled 'Ichaa', then you can change this on the MasjidNow Settings page.

== Frequently Asked Questions ==

= Why is the widget displaying "Please set your website's timezone..." when I have already set it? =

Unfortunately, due to the way that WordPress provides timezone information, you must set the timezone option to a "named" timezone. For example, instead of choosing "UTC-4", you must choose something like "New York". 

= Why is my widget or shortcode showing outdated or old timings? =

The timings that are being displayed have been saved to your WordPress installation (aka "cached") so that it doesn't have to connect to the MasjidNow database everytime that your page is loaded.
This ensures that timings are displayed quickly and don't slow down your website.

To clear these cached timings, go to your WordPress Admin panel, and click Settings > MasjidNow Settings on the left hand side. Then click the button labeled "Clear Cache". Your timings will then be updated
from the MasjidNow website.

= My website is not in English, can I change the language that is displayed? =

No problem. Just go to your WordPress admin page, and click Settings on the left hand side. Once there, click "MasjidNow Settings".

If you scroll down, you will see an area where you can set what text will be displayed for each prayer name, and for "Adhan" and "Iqamah".

For example, French users can enter "Ichaa" instead of "Isha", and all of MasjidNow's timings will display "Ichaa" instead of "Isha".

= I have a question that isn't listed here, what should I do? =

Email me through the contact form at [masjidnow.com](https://www.masjidnow.com)

== Changelog ==

= 1.6.7 =
* Uses locale formatted date in daily widget

= 1.6.6 =
* Adds daily widget reset by clicking date text

= 1.6.5 =
* Fixes widget not working due to some javascript

= 1.6.4 =
* Makes javascript unobtrusive on daily timings widgets

= 1.6.2 =
* Fixes bug where monthly timings didn't show

= 1.6.1 =
* Fixes bug where last years timings were being used from cache

= 1.6.0 =
* Fixes bug where next years timings weren't available through Javascript

= 1.5.9 =
* Switched to using HTTPS for widget's javascript.

= 1.5.7 =
* Made monthly tables take up 100% of width.

= 1.5.7 =
* Made shortcode more robust by adding error checks for timezone. Also added title attribute to mobile icon links.

= 1.5.6 =
* Reduced cache duration to 1 day from 15. Fixed big with "timings from" message showing incorrectly.

= 1.5.5 =
* Fixed bug with December date parsing causing widget crash.

= 1.5.4 =
* Fixed naming collision with plugin add admin page function

= 1.5.3 =
* Fixed issue with missing updates to PrayTime file.

= 1.5.2 =
* Added plugin icons
* Made compatible with WordPress 4.0.
* Fixed conflicts with other plugings using PrayTime library

= 1.5.1 =
* Added support for PHP 5.2.X (fixed error caused by getTimestamp method). 

= 1.5.0 =
* Added support for multiple masajid in one WordPress installation. Now you can have multiple mosques times on the same website. 

= 1.4.1 =
* Added daily timings shortcode and ability to customize the title of the monthly timings tables. 

= 1.4.0 =
* Added custom colors for text and background of widgets.
* Added support for multiple languages. You can change the names of the prayers (ex. Isha => Ichaa) by going to the 'Settings > MasjidNow Settings' page.
* Made previous/next day arrows easier to click.

= 1.3.2 =
* Added hijri date output. You can control whether or not this is shown by changing your mobile settings on MasjidNow.com

= 1.3.1 =
* Fixed bug with mobile app icon links.

= 1.3.0 =
* Added ability to display monthly info underneath the daily timings widget. Be sure to check the correct checkbox on the widget settings.

= 1.2.1 =
* Fixed bug where widget would crash if there was no valid time zone set for the WordPress site.

= 1.2.0 =
* Added caching of timings. Performance should increase by ~1000x, but YOU MUST CLEAR THE PLUGIN CACHE EVERY TIME YOU UPDATE THE TIMINGS ON MASJIDNOW.COM. 

= 1.1.2 =
* Fixed bug where adhan timings table columns were off by one.

= 1.1.1 =
* Added ability to show different months with shortcodes. Add month=XX to the shortcode to have the timings for that month display. For example, [masjidnow_monthly masjid_id=XXXX month=12] for December timings.

= 1.1.0 =
* Added monthly adhan timings shortcode. Just use [masjidnow_monthly_adhan masjid_id=XXXX] to display the adhan timings for your mosque.

= 1.0.6 =
* Fixed bug in monthly timings where the month displayed was always "March 2013"

= 1.0.5 =
* Timings are now available if user clicks to a new month

= 1.0.4 =
* Fixed bug where widget wouldn't display on some servers (used <? on one line vs <?php)

= 1.0.3 =
* Removed additional dependencies on PHP 5.3+ by removing reference to DateTime::diff 

= 1.0.2 =
* Changed style of widget to properly accomodate small sidebars.

= 1.0.1 =
* Switched to using wp_remote_get instead of file_get_contents which may cause issues on some WordPress installations.

= 1.0.0 =
* Added mobile app download links.
* Changed iqamah timings date to only show if timings were old.
* Added support for PHP 5 (previous support was PHP 5.3)

= 0.9.11 =
* Fixed bug where widget couldn't go in the past if a month was incomplete.

= 0.9.10 =
* Included updated file from fix in 0.9.9

= 0.9.9 =
* Fixed bug where iqamah timings date would show "No timings available" regardless of availability.

= 0.9.8 =
* Added ability to display monthly timings table.

= 0.9.7 =
* Added ability to only display iqamah timings, instead of both iqamah and adhan timings.
* Fixed bug where initial iqamah and adhan timings were showing the timings from the last day of the month instead of the correct day's.

= 0.9.6 =
* Added ability to change date.

= 0.9.5 =
* Removed border and changed some stylings.
* Fixed bugs with old adhan timings being shown.

= 0.9.4 =
* Removed width requirement on container. Widget can now fit into smaller areas.
* Added ability to set the header.

= 0.9.3 =
* Upgraded to using masjidnow.com API V2. Adhan timings are now retrieved from the MasjidNow server instead of through calculations, unless necessary.
* Widget can be used without having a masjid connected to it. (Will get around to fixing how it looks when there is no masjid connected.)

= 0.9.2 =
* Fixed incorrect calculated salah times due to wrong lat/lon being used.

= 0.9.1 =
* Added ability to show calculated prayer timings.

= 0.9 =
* No difference, simply a version bump.

= 0.1 =
* Right now, the widget only displays the latest timings.
