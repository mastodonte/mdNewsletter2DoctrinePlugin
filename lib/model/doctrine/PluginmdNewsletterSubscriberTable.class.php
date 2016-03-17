<?php

/**
 * PluginmdNewsletterSubscriberTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginmdNewsletterSubscriberTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object PluginmdNewsletterSubscriberTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('PluginmdNewsletterSubscriber');
  }

  public function findSubscribers($ids = NULL){
    $query = Doctrine_Query::create()
        ->select('mdS.*')
        ->from('mdNewsletterSubscriber mdS')
        ->where('mdS.status =?', 'subscribed');
    
    if(!is_null($ids))
    {
      $query->whereIn('mdS.id', $ids);
    }
    
    return $query->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
  }
  
  public function findSubscribersNotQueue($queue_id, $limit = null, $returnQuery = null){
    $query = mdNewsletterSubscriberTable::getInstance()->createQuery('mdS')
        ->where('mdS.status =?', 'subscribed')
        ->andWhere('mdS.id in (select md_subscriber_id from md_newsletter_queue_subscriber where md_newsletter_sent_at is null and md_queue_id = ' . $queue_id . ')');

    if($limit){
      $query->limit($limit);
    }
    
    if($returnQuery === true)
      return $query;

    return $query->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
  }

  public function batch_create($records) {
    $con = Doctrine_Manager::getInstance()->connection();
	 	 
    $r = array();
    $sql = "INSERT INTO 
            `md_newsletter_subscriber` 
            (`email`, `status`, `created_at`, `updated_at`)";

    foreach ($records as $record) {
      $d = "('" . $record . "', 'subscribed', now(), now())";
      array_push($r, $d);
    }

    $sql = $sql . ' VALUES ' . implode(',', $r);
    $sql = $sql . " ON DUPLICATE KEY UPDATE `updated_at` = now()";

    //ejecutamos la consulta
    $st = $con->execute($sql);
  }

}
