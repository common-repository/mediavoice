<?php
function mediavoice_do_settings_sections($page) {
  global $wp_settings_sections, $wp_settings_fields;

  if ( !isset($wp_settings_sections) || !isset($wp_settings_sections[$page]) )
    return;

  foreach( (array) $wp_settings_sections[$page] as $section ) {
    echo "<h3>{$section['title']}</h3>\n";
    call_user_func($section['callback'], $section);
    if ( !isset($wp_settings_fields) ||
      !isset($wp_settings_fields[$page]) ||
      !isset($wp_settings_fields[$page][$section['id']]) )
      continue;
    echo '<div class="settings-form-wrapper">';
    mediavoice_do_settings_fields($page, $section['id']);
    echo '</div>';
  }
}

function mediavoice_do_settings_fields($page, $section) {
  global $wp_settings_fields;

  if ( !isset($wp_settings_fields) ||
    !isset($wp_settings_fields[$page]) ||
    !isset($wp_settings_fields[$page][$section]) )
    return;

  foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
    echo '<div class="settings-form-row">';
    if ( !empty($field['args']['label_for']) )
      echo '<div><p><label for="' . $field['args']['label_for'] . '">' .
      $field['title'] . '</label></p>';
    else
      echo '<div><h4>' . $field['title'] . '</h4>';
    call_user_func($field['callback'], $field['args']);
    echo '</div></div>';
  }
}
?>
