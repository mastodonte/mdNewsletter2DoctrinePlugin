<?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<div class="sf_admin_action_export">
  <?php echo link_to(__('Exportar', array(), 'messages'), 'mdSubscriberBackend/exportar', array(  'class' => 'suscribers_export btn btn-warning',  'onclick' => 'suscribers_export(this); return false;',)) ?>
</div>
<div class="sf_admin_action_import">
  <a href="#suscribers_import_form" class="suscribers_import btn btn-success">Importar</a>  
</div>
