=== City Weather Data Plugin ===
Contributors: Sayem Ahmed
Tags: weather, weather API, city weather, OpenWeather
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
City Weather Data Plugin is a simple WordPress plugin that fetches and displays weather data for a city and country using the OpenWeather API. Users can enter a city and country to get real-time weather conditions.

== Features ==

Display current temperature and weather conditions for any city.

Uses OpenWeather API to fetch data.

Customizable API key via plugin settings.

Simple shortcode implementation.

Lightweight and easy to use.

== Installation ==

Upload the plugin folder to the /wp-content/plugins/ directory.

Activate the plugin through the 'Plugins' menu in WordPress.

Go to Settings > Weather API Settings to configure your OpenWeather API key.

Use the shortcode [full_weather city="London" country="UK"] in any post or page to display weather data.

== Usage ==
Place the following shortcode where you want the weather details to appear:

[full_weather city="New York" country="US"]

== Changelog ==
= 1.0.0 =

Initial release.

Fetches real-time weather data using OpenWeather API.

Admin settings page for API key configuration.

== Frequently Asked Questions ==

= How do I get an API key? =
You can obtain an API key by signing up at OpenWeather.

= What if my API key is invalid? =
Check your API key and ensure it's correctly entered in Settings > Weather API Settings.

= Can I use this plugin without an API key? =
No, an API key is required to fetch weather data from OpenWeather.

== Support ==
For support or feature requests, contact Sayem Ahmed via mdsayemahmed.com.