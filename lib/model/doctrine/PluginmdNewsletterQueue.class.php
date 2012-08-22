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
  public function associate(){
    $con = Doctrine_Manager::getInstance()->connection();    

    $records = Doctrine::getTable('mdNewsletterSubscriber')->findSubscribers();
    
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
  }
  
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
  
  public static function sendMail($queue){
    $mdMailXMLHandler = new mdMailXMLHandler();

    $param['body'] = str_replace(
      array('%unsuscribe_url%', '%email%'),
      array(mdNewsletterSubscriber::getUnsuscribeUrl( $queue['md_subscriber_id'] ), $queue['mdNewsletterSubscriber']['email']),
      $queue['mdNewsletterQueue']['content']
    );

    $param['subject'] = $queue['mdNewsletterQueue']['subject'];

    $param['recipients'] = $queue['mdNewsletterSubscriber']['email'];
    
    $param['sender'] = array('name' => $mdMailXMLHandler->getFrom(), 'email' => $mdMailXMLHandler->getEmail());
    
    return mdMailHandler::sendMail($param);
  }
}