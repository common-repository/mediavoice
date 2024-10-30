<?php
if(!class_exists('MediaVoice_Plugin_Settings'))
{
  class MediaVoice_Plugin_Settings {

    public function __construct() {
      // register actions
      add_action('admin_init', array(&$this, 'admin_init'));
      add_action('admin_menu', array(&$this, 'add_menu'));
      // get layout functions
      require_once(sprintf("%s/templates/template_functions.php", dirname(__FILE__)));
    }

    public function admin_init() {
      // register plugin settings
      register_setting('mediavoice_plugin-group', 'plugin_script');
      register_setting('mediavoice_plugin-group', 'plugin_enabled');

      // add settings section
      add_settings_section(
        'mediavoice_plugin-section',
        'MediaVoice Script Deployment',
        array(&$this, 'settings_section_mediavoice_plugin'),
        'mediavoice_plugin'
      );

      // add settings fields
      add_settings_field(
        'mediavoice_plugin-plugin_enabled',
        'Enable MediaVoice Script:',
        array(&$this, 'settings_field_input_checkbox'),
        'mediavoice_plugin',
        'mediavoice_plugin-section',
        array(
          'field' => 'plugin_enabled'
        )
      );
      add_settings_field(
        'mediavoice_plugin-plugin_script',
        'Ad code:',
        array(&$this, 'settings_field_input_text'),
        'mediavoice_plugin',
        'mediavoice_plugin-section',
        array(
          'field' => 'plugin_script'
        )
      );
    }
    public function settings_section_mediavoice_plugin() {
      echo 'Paste your MediaVoice Script in the box below and Check Enable MediaVoice Script to ensure native ad deployment throughout your website.';
      echo '<br><i>By using this plugin you confirm that MediaVoice may place advertisements, sponsored logos, and external links on your site.</i>';
    }

    public function settings_field_input_text($args) {
      $field = $args['field'];
      $value = get_option($field);
      echo sprintf('<textarea name="%s" id="%s">%s</textarea>', $field, $field, $value);
    }

    public function settings_field_input_checkbox($args) {
      $field = $args['field'];
      $checked = (get_option($field) == 'on') ? 'checked' : '';
      echo sprintf('<input type="checkbox" name="%s" id="%s" %s />', $field, $field, $checked);
    }

    /** add a menu **/
    public function add_menu() {
      // Add a page to manage this plugin's settings
      add_options_page(
        'MediaVoice Plugin Settings',
        'MediaVoice Plugin',
        'manage_options',
        'mediavoice_plugin',
        array(&$this, 'render_plugin_settings_page')
      );
    }

    /** Menu Callback **/
    public function render_plugin_settings_page() {
      if(!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
      }
      // Render the settings template
      include(sprintf("%s/templates/settings_page.php", dirname(__FILE__)));
    }

  }
}
