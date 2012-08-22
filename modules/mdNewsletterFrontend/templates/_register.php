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

<script type="text/javascript">
  var cssText =
    '.newsletter { border: 1px solid #000; color: #072C44; float: right; font-size: 16px; padding: 10px; width: 100%; }' + 
    '.newsletter-error{ font-size: 12px; color: red }' +
    '.newsletter input { background: none repeat scroll 0 0 #FFFFFF; border: 1px medium none; color: #323131; float: left; font-size: 11px; height: 20px; margin: 10px 5px 0 0; padding-left: 5px; width: 180px; }' + 
    '.newsletter input.sobre { background: url("/mdNewsletter2DoctrinePlugin/images/sobre.png") no-repeat scroll left top transparent; border: none; cursor: pointer; float: left; height: 23px; width: 26px; }';

  var newsletterCssNode = document.getElementById('newsletter_css');
  if (!newsletterCssNode) {
    newsletterCssNode = document.createElement('style');
    newsletterCssNode.type = 'text/css';
    newsletterCssNode.id = 'newsletter_css';
    document.getElementsByTagName('head')[0].appendChild(newsletterCssNode);
    if (newsletterCssNode.styleSheet) {
      newsletterCssNode.styleSheet.cssText = cssText;
    } else {
      cssText = document.createTextNode(cssText);
      newsletterCssNode.appendChild(cssText);
    }
  }
    
  function newsletter_execute(form){
    mdShowLoading();
    $("#newsletter_submit").hide();
    $.ajax({
      url: $(form).attr('action'),
      data: $(form).serialize(),
      type: 'POST',
      dataType: 'json',
      success: function(json) {
        if(json.response == 'OK'){
          $("#newsLetter_mail").val("");
          $("#newsLetter_mail").trigger('click');
        }
        mdHideLoading();
        $('#newsletter_message').html(json.options.message).show();        
        setTimeout("$('#newsletter_message').fadeOut();", 5000);
      },
      complete: function(){
        $("#newsletter_submit").show();
      }
    });
    return false;
  }
  
  $(document).ready(function() {
    $('.active-focus').live('focusin', function(){
      if($(this).val() == $(this).attr('store')) $(this).val('');
    });

    $('.active-focus').live('focusout', function(){
      if($(this).val() == "") $(this).val($(this).attr('store'));
    });

  });  
</script>
