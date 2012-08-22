<?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<li class="sf_admin_action_export">
  <?php echo link_to(__('Exportar', array(), 'messages'), 'mdSubscriberBackend/exportar', array(  'class' => 'suscribers_export',  'onclick' => 'suscribers_export(this); return false;',)) ?>
</li>
<li class="sf_admin_action_import">
  <a href="#suscribers_import_form" class="suscribers_import">Importar</a>  
</li>
