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
      
      <div class="sf_admin_form_row sf_admin_text<?php $form['content']->hasError() and print ' errors' ?>">
        <?php echo $form['content']->renderError() ?>
        <div>
          <?php echo $form['content']->renderLabel() ?>

          <div class="content"><?php echo $form['content']->render(); ?></div>
        </div>
      </div>
      
    </fieldset>
  
    <input type="submit" value="Guardar" />
  </form>
</div>
