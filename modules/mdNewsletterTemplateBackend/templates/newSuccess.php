<?php 
$templates = sfConfig::get('app_mdNewsletter2DoctrinePlugin_templates');
?>
<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mdNewsletterTemplateBackend/assets') ?>
<?php use_javascript('tinymce40/tinymce.min.js', 'last'); ?>

<?php slot('newsletter'); ?>
<?php slot('nav') ?><?php echo __('mdNewsletter_Newsletter'); ?> > <?php echo __('mdNewsletter_Templates'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('mdNewsletter_New', array(), 'messages') ?></h1>

  <?php include_partial('mdNewsletterTemplateBackend/flashes') ?>

  <div id="sf_admin_content">
    
   <fieldset>
     <legend><?php echo __('mdNewsletter_Templates'); ?></legend>
     <p><?php echo __('mdNewsletter_Seleccione el template para el newsletter'); ?></p>

     <form id="md_selector_templates" action="<?php echo url_for('@getForms'); ?>" method="POST">
       <ul class="md_templates_ul">
         <?php foreach($templates as $name => $template): ?>
         <li>
           <label><?php echo $name ?></label>
           <input class="selector" type="radio" name="template" value="<?php echo $template ?>" />        
         </li>
         <?php endforeach; ?>
       </ul>
     </form>
     <p id="md_nl_loading" style="display: none;"><?php echo __('mdNewsletter_loading...'); ?></p>
   </fieldset>

   <br />

<?php
foreach($templates as $nombre => $template): 
  $params = array();
  if(isset($form) && get_class($form) == $template . 'Form'):
    $params['form'] = $form;
  endif;
  $params['template'] = $template;
?>
   <fieldset <?php if(!isset($params['form'])): ?>style="display: none;"<?php endif; ?> ref="<?php echo $template ?>">
     <legend>Formulario <?php echo $nombre ?></legend>
     <p></p>
     <div id="md_template_forms">
       <?php include_component('mdNewsletterTemplateBackend', 'getForm', $params); ?>
     </div>
   </fieldset>
<?php endforeach; ?>

   <script type="text/javascript">

   $(document).ready(function(){
     $('.selector').change(function(){
       getForms();
     });
   });

   function getForms(){
     $('#md_nl_loading').show();
     $('fieldset[ref]').hide();
     
     $radio = $('input[type="radio"]:checked');
     $fieldset = $('fieldset[ref="' + $radio.attr('value') + '"]');
     $fieldset.show();
     $('#md_nl_loading').hide();
     
     return false;

   }

   </script>

    
  </div>
</div>


 