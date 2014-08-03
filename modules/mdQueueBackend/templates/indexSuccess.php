<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdQueueBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Queue'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1>Envios</h1>

  <?php include_partial('mdQueueBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdQueueBackend/list_header', array('pager' => $pager)) ?>
  </div>


  <div id="sf_admin_content">
    <form action="<?php echo url_for('md_newsletter_queue_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('mdQueueBackend/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('mdQueueBackend/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('mdQueueBackend/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdQueueBackend/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<script type="text/javascript">
  $(".iframe").fancybox({
    'transitionIn'	: 'none',
    'transitionOut'	: 'none',
    'height'            : 550,
    'width'             : 780
  });
</script>
