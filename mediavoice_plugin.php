<?php
/**
 * @package MediaVoice_Plugin
 * @version 0.5.1
 */
/*
Plugin Name: MediaVoice
Plugin URI: http://wordpress.org/plugins/mediavoice/
Description: The MediaVoice WordPress Plugin lets you seamlessly deploy your MediaVoice Script on your website, immediately readying and activating your native ad units for content.
Version: 0.5.1
Author: MediaVoice
Author URI: http://polar.me
*/

if(!class_exists('MediaVoice_Plugin')) {
  class MediaVoice_Plugin {

    public function __construct() {
      require_once(sprintf("%s/settings_page.php", dirname(__FILE__)));
      $MediaVoice_Plugin_Settings = new MediaVoice_Plugin_Settings();
    }
    public static function register_css() {
      wp_register_style( 'settings-page-css', plugins_url( '/mediavoice/css/settings.css'), array() );
      wp_enqueue_style( 'settings-page-css' );
    }

    public static function register_js() {
      wp_register_script( 'settings-page-js', plugins_url( '/mediavoice/js/settings.js' ), array( 'jquery' ) );
      wp_enqueue_script( 'settings-page-js' );
    }

    public static function inject_plugin_script() {
      $plugin_script = (get_option('plugin_script'));
      $plugin_enabled = (get_option('plugin_enabled') == 'on') ? true : false;
      if ( $plugin_script && $plugin_enabled )
        echo $plugin_script;
    }

  }
}

if(class_exists('MediaVoice_Plugin')) {
  add_action ( 'wp_footer', array('MediaVoice_Plugin', 'inject_plugin_script'));
  add_action( 'admin_enqueue_scripts', array('MediaVoice_Plugin', 'register_js' ));
  add_action( 'admin_enqueue_scripts', array('MediaVoice_Plugin', 'register_css' ));

  $mediavoice_plugin = new MediaVoice_Plugin();

  if(isset($mediavoice_plugin)) {
    // Add a link to the settings page onto the plugin page
    function plugin_settings_link($links) {
      $settings_link = '<a href="options-general.php?page=mediavoice_plugin">Settings</a>';
      array_unshift($links, $settings_link);
      return $links;
    }

    $plugin = "mediavoice/mediavoice_plugin.php";
    add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
  }

}
