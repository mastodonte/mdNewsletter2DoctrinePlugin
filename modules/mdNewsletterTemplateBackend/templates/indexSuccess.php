<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('../mdNewsletter2DoctrinePlugin/css/skin1.css', 'last'); ?>
<?php use_javascript('../mdNewsletter2DoctrinePlugin/js/jquery.date.min.js', 'last'); ?>

<?php include_partial('mdNewsletterTemplateBackend/assets') ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Templates'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('mdNewsletter_List', array(), 'messages') ?></h1>

  <?php include_partial('mdNewsletterTemplateBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mdNewsletterTemplateBackend/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('mdNewsletterTemplateBackend/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('md_newsletter_template_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('mdNewsletterTemplateBackend/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('mdNewsletterTemplateBackend/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('mdNewsletterTemplateBackend/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mdNewsletterTemplateBackend/list_footer', array('pager' => $pager)) ?>
  </div>
  
  <?php include_component('mdQueueBackend', 'selectorFecha'); ?>
  
  <a href="#template_encolar_div" id="mask_encolar" style="display: none;">&nbsp;</a>
</div>

<script type="text/javascript">
  $(".iframe").fancybox({
    'transitionIn'	: 'none',
    'transitionOut'	: 'none',
    'height'            : 550,
    'width'             : 780
  });
  
  $(document).ready(function(){

    $(".template_encolar").bind('click', function(event){

      event.preventDefault();
      $('#template_encolar_form').attr('action', $(this).attr('href'));
      $('#mask_encolar').trigger('click');
      
    });

  });
  
  $("#mask_encolar").fancybox({
    'transitionIn'      : 'none',
    'transitionOut'     : 'none',
    'autoDimensions'    : false,
    'height'            : 280,
    'width'             : 450
  });  
</script>
