<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToDelete($md_newsletter_template, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
      <a href="<?php echo url_for('md_newsletter_template_edit', $md_newsletter_template) ?>" class="btn btn-info pull-right"> Editar </a>
      <a href="<?php echo url_for('@mdNewsletterEncolar?id='.$md_newsletter_template->getId()); ?>" class="template_encolar btn btn-success pull-right">Encolar</a>
      <?php echo link_to(__('Preview', array(), 'messages'), 'mdNewsletterTemplateBackend/preview?id='.$md_newsletter_template->getId(), array(  'class' => 'iframe btn btn-primary pull-right',)) ?>

  </ul>
</td>
