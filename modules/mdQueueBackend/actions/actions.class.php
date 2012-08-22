<?php

require_once dirname(__FILE__).'/../lib/mdQueueBackendGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mdQueueBackendGeneratorHelper.class.php';

/**
 * mdQueueBackend actions.
 *
 * @package    agrotemario
 * @subpackage mdQueueBackend
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdQueueBackendActions extends autoMdQueueBackendActions
{
  public function executePreview(sfWebRequest $request)
  {    
    $this->queue = Doctrine::getTable('mdNewsletterQueue')->find($request->getParameter('id'));
    
    $this->setLayout(false);
  }
}
