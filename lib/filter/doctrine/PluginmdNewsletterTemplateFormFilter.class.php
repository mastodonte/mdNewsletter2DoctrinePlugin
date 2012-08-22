<?php

/**
 * PluginmdNewsletterTemplate form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmdNewsletterTemplateFormFilter extends BasemdNewsletterTemplateFormFilter
{
  public function setup(){
    parent::setup();
    
    unset($this['template'], $this['subject'], $this['content'], $this['updated_at'], $this['created_at']);
    
    /*$this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array(
        'label' => 'Fecha',
        'from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
        'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
        'with_empty' => false,
        'template' => '<table><tr><td>desde</td><td>%from_date%</td></tr><tr><td>hasta</td><td>%to_date%</td></tr></table>'
    ));

    $this->validatorSchema['created_at'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))); */
  }
}
