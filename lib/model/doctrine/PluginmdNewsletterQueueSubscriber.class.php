<?php

/**
 * PluginmdNewsletterQueueSubscriber
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginmdNewsletterQueueSubscriber extends BasemdNewsletterQueueSubscriber
{
  public static function updateDates($records){
    if(count($records) > 0)
    {
      $con = Doctrine_Manager::getInstance()->connection();

      $sql = "UPDATE `md_newsletter_queue_subscriber` 
              SET `md_newsletter_sent_at` = now()
              WHERE `id` IN ";

      $sql = $sql . "(" . implode(',', $records) . ")";

      //ejecutamos la consulta
      $st = $con->execute($sql);
    }
  }
}