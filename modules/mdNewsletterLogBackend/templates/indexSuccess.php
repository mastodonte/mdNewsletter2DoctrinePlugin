<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdNewsletterLogBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Logs'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1>Logs</h1>

  <?php include_partial('mdNewsletterLogBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdNewsletterLogBackend/list_header', array('pager' => $pager)) ?>
  </div>


  <div id="sf_admin_content">
    <form action="<?php echo url_for('md_newsletter_log_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('mdNewsletterLogBackend/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('mdNewsletterLogBackend/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('mdNewsletterLogBackend/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdNewsletterLogBackend/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
