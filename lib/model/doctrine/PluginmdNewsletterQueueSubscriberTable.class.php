<?php

/**
 * PluginmdNewsletterQueueSubscriberTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginmdNewsletterQueueSubscriberTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object PluginmdNewsletterQueueSubscriberTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('PluginmdNewsletterQueueSubscriber');
  }
  
  public function scheduledSend($limit){   
    $query = Doctrine::getTable('mdNewsletterQueueSubscriber')
      ->createQuery('n')
      ->select('n.*, q.*, s.*')
      ->leftJoin('n.mdNewsletterQueue as q')
      ->leftJoin('n.mdNewsletterSubscriber as s')
      ->where('n.md_newsletter_sent_at IS NULL')
      ->andWhere('s.status = ?', 'subscribed')
      ->andWhere("q.sending_date <= ?", date('Y-m-d H:i:s', time()))
      ->limit($limit);

    return $query->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
  }

}