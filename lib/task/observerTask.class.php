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
        $open = Md_TaskManager::lockTask(__class__);
        if($open === false){
          mdNewsletterLog::log(4, '[ERROR] No se pudo hacer el lock ' . time());
        }
        
        sfContext::createInstance($this->configuration);
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        //cantidad de mails a enviar
        //maximo 500 mails por día. 
        $limit = sfConfig::get('app_mdNewsletter2DoctrinePlugin_observer_limit', 60);

        $queue = mdNewsletterQueueTable::getInstance()->findScheduleToSend();
        if($queue){ 
          $records = $queue->getSubscribersScheduled($limit);

          $ids = array();
          $statics = array();
          
          foreach($records as $record)
          {
            try
            {
              mdNewsletterLog::log(1,'[NOTICE] Before Send Mail: ' . $record['email'], $queue->getId(), $record['id']);

              if($queue->sendMail($record))
              {
                mdNewsletterLog::log(2, '[NOTICE] After Send Mail: ' . $record['email'], $queue->getId(), $record['id']);
                
                mdNewsletterQueueSubscriber::insertSend($queue->getId(), $record);
                $queue->markSend();
                
                $statics ++;
              }
              else
              {
                mdNewsletterLog::log(3, '[ERROR] El E-mail no ha podido enviarse' . $record['email'], $queue->getId(), $record['id']);
              }
            }catch(Exception $e){

              mdNewsletterLog::log($e->getCode(), '[ERROR] ' . $e->getMessage() . ' '. $record['email'], $queue->getId(), $record['id']);
            }

            //sleep(1);
          }
        } //end if $queue
        $close = Md_TaskManager::unlockTask(__class__);
        if($close === false){
          mdNewsletterLog::log(4, '[ERROR] No se pudo hacer el unlock ' . time());
        }
    } else {
      mdNewsletterLog::log(5, '[ERROR] Task lock ' . time());
    }

  }
}
