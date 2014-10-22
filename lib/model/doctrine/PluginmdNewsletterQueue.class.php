<?php

/**
 * PluginmdNewsletterQueue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginmdNewsletterQueue extends BasemdNewsletterQueue
{
  public function getSlug(){
    return $this->getDateTimeObject('sending_date')->format('Y-m-d');
  }

  //no se usa mas porque genera problemas con mas de 5000 mails
  public function associate($group = null){
    $con = Doctrine_Manager::getInstance()->connection();    
    if($group == null)
      $records = Doctrine::getTable('mdNewsletterSubscriber')->findSubscribers();
    else{
      $group = Doctrine::getTable('mdNewsletterGroup')->find($group);
      $records = $group->getSubscribers();
    }
    
    if(count($records)){

      $r = array();
      $sql = "INSERT INTO 
              `md_newsletter_queue_subscriber` 
              (`md_queue_id`, `md_subscriber_id`)";     

      foreach($records as $record)
      {
        $d = "('" . $this->getId() . "', '" . $record['id'] . "')";    
        array_push($r, $d);
      }

      $sql = $sql . ' VALUES ' . implode(',', $r);

      //ejecutamos la consulta
      $st = $con->execute($sql);
      
      return count($records);
    }else{
      return 0;
    }
  }
  public function getSubscribersScheduled($limit){
    if($this->getMdGroupId()!=null){
      //envio a los subscritos del grupo
      $records = $this->getGroup()->getSubscribersSchedule($this->getId(), $limit);
    }else{
      // envio a todos los suscritos que no se envío
      $records = Doctrine::getTable('mdNewsletterSubscriber')->findSubscribersNotQueue($this->getId(), $limit);
    }          

    return $records;

  }
  

  public function markSend(){
    if($this->getProcessed() == 0){
      $this->setStatus('sending');
    }
    $this->setProcessed((integer)$this->getProcessed() + 1);
    if($this->getProcessed() == $this->getRecipients()){
      $this->setStatus('sent');
    }

    return $this->save();
  }


  //deprecated
  public function stats($stats){
    if(count($stats) > 0)
    {
      $con = Doctrine_Manager::getInstance()->connection();   

      foreach($stats as $md_queue_id => $count)
      {
        $sql = "UPDATE `md_newsletter_queue` 
                SET `processed` = (`processed` + " . $count . "), `status` = 'sent' 
                WHERE `id` = " . $md_queue_id;

        //ejecutamos la consulta
        $st = $con->execute($sql);
      }
    }
  }
  


  public function getDirectUrl(){
    $sfContext = sfContext::getInstance();
    $config = $sfContext->getConfiguration();
    $config->loadHelpers(array('I18N', 'Partial'));
    $origin_app = $config->getApplication();
    $sfContext->switchTo('frontend');
    

    sfContext::getInstance()->getConfiguration()->loadHelpers("Url");
    $url = str_replace(sfConfig::get('app_observer_taskSymfonyUrl'), sfConfig::get('app_observer_taskFrontendUrl') , url_for('mdNewsletterDirect' ,$this, true));
    
    $sfContext->switchTo($origin_app);

    return $url;
  }

  public function sendMail($queue){
    $mdMailXMLHandler = new mdMailXMLHandler();

    $param['body'] = str_replace(
      array('%unsuscribe_url%', '%direct_url%','%email%'),
      array(
        mdNewsletterSubscriber::getUnsuscribeUrl( $queue['id'] ),
        $this->getDirectUrl(),
        $queue['email']),
      $this->getContent()
    );

    $param['subject'] = $this->getSubject();

    $param['recipients'] = $queue['email'];
    
    $param['sender'] = array('name' => $mdMailXMLHandler->getFrom(), 'email' => $mdMailXMLHandler->getEmail());
    $param['reply_to'] = $mdMailXMLHandler->getEmail();
    
    $param['realtime'] = true;

    return mdMailHandler::sendMail($param);
  }
}