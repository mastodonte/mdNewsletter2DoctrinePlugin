<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@md_newsletter_template') ?>
  <?php echo $form->renderHiddenFields(false) ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <fieldset class="sf_custom_admin_forms">

    <div class="sf_admin_form_row sf_admin_text<?php $form['name']->hasError() and print ' errors' ?>">
      <?php echo $form['name']->renderError() ?>
      <div>
        <?php echo $form['name']->renderLabel() ?>

        <div class="content"><?php echo $form['name']->render(); ?></div>
      </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text<?php $form['subject']->hasError() and print ' errors' ?>">
      <?php echo $form['subject']->renderError() ?>
      <div>
        <?php echo $form['subject']->renderLabel() ?>

        <div class="content"><?php echo $form['subject']->render(); ?></div>
      </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
      <?php echo $form['mdFirstEmbedTemplate']['header']->renderError() ?>
      <div>
        <?php echo $form['mdFirstEmbedTemplate']['header']->renderLabel() ?>
        
        <div class="content"><?php echo $form['mdFirstEmbedTemplate']['header']->render(); ?></div>

        <?php if ($help = $form['mdFirstEmbedTemplate']['header']->renderHelp()): ?>
          <div class="help"><?php echo $help ?></div>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text<?php $form['mdFirstEmbedTemplate']['copete_header']->hasError() and print ' errors' ?>">
      <?php echo $form['mdFirstEmbedTemplate']['copete_header']->renderError() ?>
      <div>
        <?php echo $form['mdFirstEmbedTemplate']['copete_header']->renderLabel() ?>

        <div class="content"><?php echo $form['mdFirstEmbedTemplate']['copete_header']->render(); ?></div>
      </div>
    </div>

    <div class="sf_admin_form_row sf_admin_text">
      <?php echo $form['mdFirstEmbedTemplate']['body']->renderError() ?>
      <div>
        <?php echo $form['mdFirstEmbedTemplate']['body']->renderLabel() ?>
        
        <div class="content"><?php echo $form['mdFirstEmbedTemplate']['body']->render(); ?></div>

        <?php if ($help = $form['mdFirstEmbedTemplate']['body']->renderHelp()): ?>
          <div class="help"><?php echo $help ?></div>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="sf_admin_form_row sf_admin_text<?php $form['mdFirstEmbedTemplate']['copete_footer']->hasError() and print ' errors' ?>">
      <?php echo $form['mdFirstEmbedTemplate']['copete_footer']->renderError() ?>
      <div>
        <?php echo $form['mdFirstEmbedTemplate']['copete_footer']->renderLabel() ?>

        <div class="content"><?php echo $form['mdFirstEmbedTemplate']['copete_footer']->render(); ?></div>
      </div>
    </div>    

    <div class="sf_admin_form_row sf_admin_text">
      <?php echo $form['mdFirstEmbedTemplate']['footer']->renderError() ?>
      <div>
        <?php echo $form['mdFirstEmbedTemplate']['footer']->renderLabel() ?>
        
        <div class="content"><?php echo $form['mdFirstEmbedTemplate']['footer']->render(); ?></div>

        <?php if ($help = $form['mdFirstEmbedTemplate']['footer']->renderHelp()): ?>
          <div class="help"><?php echo $help ?></div>
        <?php endif; ?>
      </div>
    </div>     
     

  </fieldset>

  <input type="submit" value="Guardar" />
</form>
</div>
