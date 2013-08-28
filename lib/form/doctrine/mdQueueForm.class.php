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
    
    $this->widgetSchema['time']     = new sfWidgetFormTime(array('format_without_seconds' => '<li>' . __('mdNewsletter_Hora') . '</li><li>%hour%</li><li>' . __('mdNewsletter_hs') . ' :</li><li>%minute%</li><li>' . __('mdNewsletter_min') . '</li>', 'minutes' => array_combine($minutos, $minutos)));
    
    $this->validatorSchema['time']  = new sfValidatorTime(array());

    if(sfConfig::get('app_mdNewsletter2DoctrinePlugin_use_groups', false)){
      $this->widgetSchema['group'] = new sfWidgetFormDoctrineChoice(array(
                                        'model'     => 'mdNewsletterGroup',
                                        'add_empty' => false,
                                        'label' => 'Grupo'
                                      ));

      $this->validatorSchema['group'] = new sfValidatorDoctrineChoice(array(
                                        'model'     => 'mdNewsletterGroup',
                                        'required'  => true
                                    ));
    }
        
    $this->widgetSchema->setNameFormat('md_queue[%s]');    
  }
}
