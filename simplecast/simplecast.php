<?php
/**
 * Plugin Name: Simplecast Embed
 * Plugin URI: https://www.simplecast.com
 * Description: Display content using a shortcode to insert in a page or post. eg: [simplecast-embed src="[simplecast/episode/share/url]"]
 * Version: 0.1
 * Text Domain: simplecast-embed
 * Author: Simplecast
 * Author URI: https://www.simplecast.com
 */

function simplecast_embed($atts) {
  $curlSession = curl_init();
  curl_setopt($curlSession, CURLOPT_URL, 'https://api.simplecast.com/oembed?url=' . $atts["src"]);
  curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
  curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

  $jsonData = json_decode(curl_exec($curlSession));
  curl_close($curlSession);

  return $jsonData->html;
}

add_shortcode('simplecast-embed', 'simplecast_embed');
