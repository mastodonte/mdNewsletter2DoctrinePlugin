<?php

/**
 * mdQueue form.
 *
 * @package    mdNewsletter2DoctrinePlugin
 * @subpackage form
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdQueueForm extends sfForm
{
  public function configure()
  {
    parent::configure();
      
    sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');

    $minutos = array('00', '15', '30', '45');
    
    $this->widgetSchema['day']     = new sfWidgetFormInput(array());

    $this->validatorSchema['day'] = new sfValidatorDate(array('with_time' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'));
    
    $this->widgetSchema['time']     = new sfWidgetFormTime(array('format_without_seconds' => __('mdNewsletter_hs') .':%hour%'. __('mdNewsletter_min').' :%minute%', 'minutes' => array_combine($minutos, $minutos)));
    
    $this->validatorSchema['time']  = new sfValidatorTime(array());
    
    $this->widgetSchema->setNameFormat('md_queue[%s]');    
  }
}
