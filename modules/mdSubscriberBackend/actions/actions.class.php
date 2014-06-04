<?php

require_once dirname(__FILE__).'/../lib/mdSubscriberBackendGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mdSubscriberBackendGeneratorHelper.class.php';

/**
 * mdSubscriberBackend actions.
 *
 * @package    agrotemario
 * @subpackage mdSubscriberBackend
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdSubscriberBackendActions extends autoMdSubscriberBackendActions
{
  public function executeExportar(sfWebRequest $request){
    $ids = $request->getParameter('ids');

    $this->records = mdNewsletterSubscriber::export($ids);
    
    $this->setLayout(false);
  }
  
  public function executeImportar(sfWebRequest $request){
    $record = $request->getFiles();

    $file = $record['suscribers_import'];

    if(strpos($file['type'], 'excel') !== false || strpos($file['name'], '.xls') !== false)
    {
      $record['suscribers_import']['name'] = date('Y-m-d-') . $file['name'];
      $record['upload'] = $record['suscribers_import'];
      
      $filename = MdFileHandler::upload($record, sfConfig::get('sf_upload_dir').'/newsletter/import', true ,'suscribers_import');
    
      mdNewsletterSubscriber::import(sfConfig::get('sf_upload_dir').'/newsletter/import/' . $filename);

      $this->getUser()->setFlash('notice', 'Los usuarios se han importado correctamente');
    }
    else
    {
      $this->getUser()->setFlash('error', 'La extension del archivo no es valida. Recueda que debe ser un archivo de extension .xls');
    }
    
    $this->redirect('@md_newsletter_subscriber');
  }

  public function executeBatchUnsubscribe(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $count = 0;
    foreach($ids as $subs_id){
      $subscriber = mdNewsletterSubscriberTable::getInstance()->find($subs_id);
      $subscriber->unsuscribe();
      $count ++;
    }
    if($count>0){
      $this->getUser()->setFlash('exito', $count . ' emails han sido editados');
    }else{
      $this->getUser()->setFlash('notice', 'No se han editado emails');
    }
    
    $this->redirect('@md_newsletter_subscriber');
  }

}
