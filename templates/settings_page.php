<div class="wrap mediavoice">
  <div class="mediavoice-logo"></div>
  <h2>MediaVoice WordPress Plugin</h2>
  <form method="post" action="options.php">
    <?php @settings_fields('mediavoice_plugin-group'); ?>
    <?php @mediavoice_do_settings_sections('mediavoice_plugin'); ?>
    <?php @submit_button(); ?>
  </form>
</div>
