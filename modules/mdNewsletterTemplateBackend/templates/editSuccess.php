<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdNewsletterTemplateBackend/assets') ?>
<?php use_javascript('tiny_mce/tiny_mce.js', 'last'); ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Templates'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('mdNewsletter_Edit', array(), 'messages') ?></h1>

  <?php include_partial('mdNewsletterTemplateBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdNewsletterTemplateBackend/form_header', array('md_newsletter_template' => $md_newsletter_template, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('mdNewsletterTemplateBackend/form', array('md_newsletter_template' => $md_newsletter_template, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdNewsletterTemplateBackend/form_footer', array('md_newsletter_template' => $md_newsletter_template, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
