<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdSubscriberBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Suscriptos'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('mdNewsletter_List', array(), 'messages') ?></h1>

  <?php include_partial('mdSubscriberBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdSubscriberBackend/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('mdSubscriberBackend/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('md_newsletter_subscriber_collection', array('action' => 'batch')) ?>" method="post">
    <ul class="sf_admin_actions">
      <?php include_partial('mdSubscriberBackend/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('mdSubscriberBackend/list_actions', array('helper' => $helper)) ?>
    </ul>
    <?php include_partial('mdSubscriberBackend/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdSubscriberBackend/list_footer', array('pager' => $pager)) ?>
  </div>

  <?php include_partial('mdSubscriberBackend/import_form') ?>  
</div>

<script type="text/javascript">
  function suscribers_export(obj){
    $(obj).parents('form').attr('action', $(obj).attr('href'));
    $(obj).parents('form').submit();
  }
  
  $(".suscribers_import").fancybox({
    'transitionIn'      : 'none',
    'transitionOut'     : 'none',
    'autoDimensions'    : false,
    'height'            : 180,
    'width'             : 400
  });
</script>
