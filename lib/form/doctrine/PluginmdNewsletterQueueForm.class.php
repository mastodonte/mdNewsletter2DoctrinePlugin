<?php

/**
 * PluginmdNewsletterQueue form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmdNewsletterQueueForm extends BasemdNewsletterQueueForm
{
  public function setup(){
    parent::setup();
    
    unset($this['content'], $this['recipients'], $this['processed']);
    
    $minutos = array('00', '15', '30', '45');

    $this->widgetSchema['sending_date'] = new sfWidgetFormDateTime(
      array(
        'date' => array('format' => '%day%/%month%/%year%'),
        'time' => array('minutes' => array_combine($minutos, $minutos))
        )
      );
  }
}
