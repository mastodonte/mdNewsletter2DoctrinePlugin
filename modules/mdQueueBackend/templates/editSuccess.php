<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdQueueBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Queue'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1>Editando Envio</h1>

  <?php include_partial('mdQueueBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdQueueBackend/form_header', array('md_newsletter_queue' => $md_newsletter_queue, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('mdQueueBackend/form', array('md_newsletter_queue' => $md_newsletter_queue, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdQueueBackend/form_footer', array('md_newsletter_queue' => $md_newsletter_queue, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
