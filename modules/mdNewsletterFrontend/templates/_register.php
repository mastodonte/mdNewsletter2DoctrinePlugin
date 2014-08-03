<div class="newsletter">
  <?php echo __('mdNewsletter_Boletin de noticias'); ?><br />
  
  <div id="newsletter_container">  
    
    <form action="<?php echo url_for('@mdNewsletterSuscribe'); ?>" method="POST" onsubmit="return newsletter_execute(this);">

      <?php echo $form->renderHiddenFields(); ?>

      <div id="newsletter_message" class="newsletter-error" style="display: none;"></div>
      
      <?php echo $form['email']->render(array("value"=> __("mdNewsletter_escriba su correo electrónico"), "store"=>__("mdNewsletter_escriba su correo electrónico"), "class" => "active-focus")); ?>

      <input id="newsletter_submit" type="submit" class="sobre" value="" />

    </form>
    
  </div>
</div>
<!--SUSCRIB NEWS-->
<?php use_javascript('../mdNewsletter2DoctrinePlugin/js/registerFrontend.js', 'last'); ?>
