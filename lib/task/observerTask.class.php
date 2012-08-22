<?php

class observerTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'backend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'mdNewsletter';
    $this->name             = 'observer';
    $this->briefDescription = 'Envia los newsletters que esten agendados';
    $this->detailedDescription = <<<EOF
The [observer|INFO] task does things.
Call it with:

  [php symfony observer|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    if (!Md_TaskManager::isTaskLocked(__class__)) 
    {
        Md_TaskManager::lockTask(__class__);

        sfContext::createInstance($this->configuration);
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $records = Doctrine::getTable('mdNewsletterQueueSubscriber')->scheduledSend(80); // Hay que testear este valor y ver como se comporta el servidor
        $ids = array();
        $statics = array();
        
        foreach($records as $record)
        {
          try
          {
            mdNewsletterLog::log(1,'[NOTICE] Before Send Mail: ' . $record['mdNewsletterSubscriber']['email'], $record['md_queue_id'], $record['md_subscriber_id']);

            if(mdNewsletterQueue::sendMail($record))
            {
              mdNewsletterLog::log(2, '[NOTICE] After Send Mail: ' . $record['mdNewsletterSubscriber']['email'], $record['md_queue_id'], $record['md_subscriber_id']);
              
              array_push($ids, $record['id']);
              
              $statics[$record['md_queue_id']]++;
            }
            else
            {
              mdNewsletterLog::log(3, '[ERROR] El E-mail no ha podido enviarse' . $record['mdNewsletterSubscriber']['email'], $record['md_queue_id'], $record['md_subscriber_id']);
            }
          }catch(Exception $e){

            mdNewsletterLog::log($e->getCode(), '[ERROR] ' . $e->getMessage() . ' '. $record['mdNewsletterSubscriber']['email'], $record['md_queue_id'], $record['md_subscriber_id']);
          }

          sleep(1);
        }
        
        // Marcarlo fecha de enviado
        mdNewsletterQueueSubscriber::updateDates($ids);
        
        // Actualizamos estadisticas del envio
        mdNewsletterQueue::stats($statics);
        
        Md_TaskManager::unlockTask(__class__);
    }    

  }
}
