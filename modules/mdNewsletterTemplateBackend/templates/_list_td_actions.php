<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToDelete($md_newsletter_template, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php echo $helper->linkToEdit($md_newsletter_template, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_encolar">
      <a href="<?php echo url_for('@mdNewsletterEncolar?id='.$md_newsletter_template->getId()); ?>" class="template_encolar">Encolar</a>
    </li>
    <li class="sf_admin_action_preview">
      <?php echo link_to(__('Preview', array(), 'messages'), 'mdNewsletterTemplateBackend/preview?id='.$md_newsletter_template->getId(), array(  'class' => 'iframe',)) ?>
    </li>
  </ul>
</td>
