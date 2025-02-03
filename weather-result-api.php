<?php
/**
 * Plugin Name:       City Weather Data Plugin
 * Plugin URI:        https://wordpress.org/plugins/city-weather-data-plugin
 * Description:       A simple Weather show plugin for WordPress with Fetches and displays all weather data for a city and country using OpenWeather API.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Sayem Ahmed
 * Author URI:        https://mdsayemahmed.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       city-weather-data-plugin
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Function to fetch weather data
function sa_wp_full_weather_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'city'    => 'London',
            'country' => 'GB',
        ),
        $atts,
        'full_weather'
    );

    $api_key = get_option('full_weather_api_key', '9ff36f310fb1fd747dcc03ebab8c1c1d'); // Retrieve API key from settings
    if (empty($api_key)) {
        return '<p>Please configure the API key in plugin settings.</p>';
    }

    $city = sanitize_text_field($atts['city']);
    $country = sanitize_text_field($atts['country']);
    $location = "{$city},{$country}";
    $url = "https://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$api_key}&units=metric";

    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        return '<p>Unable to retrieve weather data.</p>';
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (empty($data) || (isset($data['cod']) && $data['cod'] !== 200)) {
        return '<p>Invalid response from the weather API.</p>';
    }

    $temp = esc_html($data['main']['temp']);
    $weather = esc_html($data['weather'][0]['description']);

    return "
        <div class='full-weather-container'>
            <h2>Weather in {$city}, {$country}</h2>
            <p><strong>Temperature:</strong> {$temp}°C</p>
            <p><strong>Condition:</strong> {$weather}</p>
        </div>
    ";
}

add_shortcode('full_weather', 'sa_wp_full_weather_shortcode');

// Style added
function full_weather_enqueue_styles() {
    wp_enqueue_style('full-weather-style', plugin_dir_url(__FILE__) . 'style.css');
}

add_action('wp_enqueue_scripts', 'full_weather_enqueue_styles');


// Register plugin settings page
function full_weather_add_admin_menu() {
    add_options_page(
        'Full Weather Settings',   // Page title
        'Weather API Settings',    // Menu title
        'manage_options',          // Capability
        'full_weather',            // Menu slug
        'full_weather_settings_page' // Callback function
    );
}

add_action('admin_menu', 'full_weather_add_admin_menu');

// Settings page content
function full_weather_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Full Weather API Settings</h1>
        <form method="post" action="options.php">
        <h3>How to Use:</h3>
        <p>Use the following shortcode to display weather data:</p>
        <code>[full_weather city="London" country="UK"]</code>
    </div>
    <?php
}

