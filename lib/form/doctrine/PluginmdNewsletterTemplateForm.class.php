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
          'theme' => 'modern',
          'showTiny' => true,
          'width' => 750,
          'height' => 500,
          'config' => '
                  menubar: "tools table format view insert edit",
                  plugins : "preview,media,fullscreen, table, fullpage, link, image, media, textcolor, paste, code",
                  toolbar : "undo redo | copy cut paste pastetext | bold italic | forecolor backcolor | link image, media | code preview fullscreen ",
                  relative_urls: false,
                  remove_script_host: false,
                  convert_urls : false,
                  extended_valid_elements : "+td[colspan|rowspan|width|height|align|valign|bgcolor|style]|a[class|name|href|target|title|onclick|rel],script[type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],$elements",
                  fix_table_elements : false,
                  forced_root_block : false,
                  cleanup_on_startup: false,
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
