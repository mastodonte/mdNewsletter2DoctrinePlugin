<div style="display:none">
  <div id="template_encolar_div">
    <h1><?php echo __('mdNewsletter_Crear Envio de Newsletter'); ?></h1>
    <hr />
    <p><?php echo __('mdNewsletter_Seleccione la fecha y hora en la cual se comenzara a enviar el newsletter.'); ?></p><br />
    <p><?php echo __('mdNewsletter_Importante! Recuerde que los mails no llegaran a todos los usuarios inmediatamente. Se enviaran en lotes de 100 mails cada 30 minutos.'); ?></p>
    
    <form id="template_encolar_form" method="POST" action="<?php echo url_for('mdNewsletterTemplateBackend/encolar'); ?>">
      <?php echo $form->renderHiddenFields(); ?>
      <br />
      
      <div style="width:220px;margin:0 auto;">
        <div>
          <label>Día:</label>
          <?php echo $form['day']->render(array('class' => 'encolar_date', 'type' => 'date', 'data-orig-type' => 'date')); ?>
        </div>

        <div class="hora" style="margin:10px 0;">
          <label>Hora:</label>
          <ul style="padding:0px">
            <li style="padding:0px;"><?php echo $form['time']->render(); ?> </li>       
          </ul>
        </div>      
      </div>
      
      <br />
      
      <div style="clear: both"></div>
      <div style="text-align:center;margin:20px;">
        <button type="submit" class="btn btn-success"><?php echo __('mdNewsletter_Guardar'); ?></button>
      </div>
    </form>
    <br />
    <hr />
  </div>
</div>

<script>
  $(":date").dateinput(
    {
      format: 'dd/mm/yyyy' // the format displayed for the user
    }
  );
</script>
