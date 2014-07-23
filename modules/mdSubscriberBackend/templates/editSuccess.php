<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdSubscriberBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Suscriptos'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1>Editado Suscripto</h1>

  <?php include_partial('mdSubscriberBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdSubscriberBackend/form_header', array('md_newsletter_subscriber' => $md_newsletter_subscriber, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('mdSubscriberBackend/form', array('md_newsletter_subscriber' => $md_newsletter_subscriber, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdSubscriberBackend/form_footer', array('md_newsletter_subscriber' => $md_newsletter_subscriber, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
