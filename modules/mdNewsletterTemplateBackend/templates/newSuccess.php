<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdNewsletterTemplateBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Templates'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('mdNewsletter_New', array(), 'messages') ?></h1>

  <?php include_partial('mdNewsletterTemplateBackend/flashes') ?>

  <div id="sf_admin_content">
    
    <?php include_partial('mdNewsletterTemplateBackend/selector_templates'); ?>

    <fieldset style="display: none;">
      <legend>Formulario</legend>
      <p></p>
      <div id="md_template_forms"></div>
    </fieldset>
    
  </div>
</div>


