<style>
  .md_templates_ul li{
    width: 100px;
  }
  #md_selector_templates{
    overflow: hidden;
  }
</style>

<fieldset>
  <legend><?php echo __('mdNewsletter_Templates'); ?></legend>
  <p><?php echo __('mdNewsletter_Seleccione el template para el newsletter'); ?></p>

  <form id="md_selector_templates" action="<?php echo url_for('@getForms'); ?>" method="POST">
    <ul class="md_templates_ul">
      <li>
        <label>Normal</label>
        <input class="selector" type="radio" name="template" value="mdNewsletterTemplate" />        
      </li>
      
      <li>      
        <label>Campaña</label>
        <input class="selector" type="radio" name="template" value="mdFirstTemplate" />      
      </li>      
    </ul>
  </form>
  <p id="md_nl_loading" style="display: none;"><?php echo __('mdNewsletter_loading...'); ?></p>
</fieldset>

<br />

<script type="text/javascript">

$(document).ready(function(){
  $('.selector').change(function(){
    getForms();
  });
});

function getForms(){
  var form = $('#md_selector_templates');
  $('#md_nl_loading').show();
  $.ajax({
    url: $(form).attr('action'),
    data: $(form).serialize(),
    type: 'post',
    dataType: 'json',
    success: function(json){
      if(json.response == "OK"){
        $('#md_template_forms').html(json.options.form);
        $('#md_nl_loading').hide();
        $('#md_template_forms').parent().show();
      }else {
        mdShowMessage(json.options.message);
      }
    },
    error: function(){}
  });
}

</script>
