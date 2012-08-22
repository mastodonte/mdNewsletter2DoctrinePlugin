<?php

/**
 * PluginmdNewsletterTemplate form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmdNewsletterTemplateForm extends BasemdNewsletterTemplateForm
{
  public function setup(){
    parent::setup();
    
    unset($this['created_at'], $this['updated_at']);
    
    $this->widgetSchema['content'] = new sfWidgetFormTextareaTinyMCE(
        array(
          'showTiny' => true,
          'width' => 750,
          'height' => 500,
          'config' => '
                  plugins : "preview,media,fullscreen, table",
                  theme_advanced_buttons1 : "bold,italic,underline,separator,bullist,numlist, separator,justifyleft,justifycenter,justifyright,justifyfull, separator, link, sub, sup",
                  theme_advanced_buttons2 : "table, indent, outdent, separator, charmap, code, media, preview, fullscreen",
                  theme_advanced_buttons3 : "",
                  theme_advanced_path : false
                  '));


    $this->widgetSchema['template'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['template'] = new sfValidatorString(array('required' => false));
  }
  
  public function doSave($con = null) 
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers("Partial");
    
    $data = $this->getTaintedValues();

    $data['template'] = $this->getModelName();

    if($this->getObject()->isNew())
    {
      $partial = get_partial("mdNewsletterMailing/template_mdNewsletterTemplate", array('data' => $data));
      $data['content'] = str_replace('%url%', '<a href="http://' . sfConfig::get('app_domain_url') . '" style="color:#006600" target="_blank">' . sfConfig::get('app_domain_url') . '</a>', $partial);
    }

    $this->bind($data);

    parent::doSave($con);
  }
}
