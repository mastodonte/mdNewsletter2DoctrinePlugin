<?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
  <?php echo link_to(__('Exportar', array(), 'messages'), 'mdSubscriberBackend/exportar', array(  'class' => 'suscribers_export btn btn-warning',  'onclick' => 'suscribers_export(this); return false;',)) ?>
  <a href="#suscribers_import_form" class="suscribers_import btn btn-success">Importar</a>  
