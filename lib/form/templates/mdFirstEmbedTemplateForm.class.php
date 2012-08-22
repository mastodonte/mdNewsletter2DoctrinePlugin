<?php
 
class mdFirstEmbedTemplateForm extends sfForm{
  
  public function setup()
  {
    parent::setup();
    
    sfContext::getInstance()->getConfiguration()->loadHelpers("I18N");

    $this->widgetSchema['copete_header'] = new sfWidgetFormTextarea();
    $this->validatorSchema['copete_header'] = new sfValidatorString();
    
    $this->widgetSchema['copete_footer'] = new sfWidgetFormTextarea();
    $this->validatorSchema['copete_footer'] = new sfValidatorString();
    
    $this->setWidget('header', new sfWidgetFormInputFile());
    $this->setValidator('header', new sfValidatorFile(array(
      'mime_types' => 'web_images',
      'path' => sfConfig::get('sf_upload_dir').'/newsletter',
    )));
    
    $this->setWidget('body', new sfWidgetFormInputFile());
    $this->setValidator('body', new sfValidatorFile(array(
      'mime_types' => 'web_images',
      'path' => sfConfig::get('sf_upload_dir').'/newsletter',
    )));
    
    $this->setWidget('footer', new sfWidgetFormInputFile());
    $this->setValidator('footer', new sfValidatorFile(array(
      'mime_types' => 'web_images',
      'path' => sfConfig::get('sf_upload_dir').'/newsletter',
    )));    
    
    $this->widgetSchema->setHelp('header', __('mdNewsletter_Importante: La imagen se mostrara con las medidas originales que tenga.'));
    $this->widgetSchema->setHelp('body', __('mdNewsletter_Importante: La imagen se mostrara con las medidas originales que tenga.'));
    $this->widgetSchema->setHelp('footer', __('mdNewsletter_Importante: La imagen se mostrara con las medidas originales que tenga.'));

    $this->validatorSchema['header_delete'] = new sfValidatorPass();
    $this->validatorSchema['body_delete'] = new sfValidatorPass();
    $this->validatorSchema['footer_delete'] = new sfValidatorPass();
  }

  public function getName() {
    return 'mdFirstEmbedTemplate';
  }
  
  public function my_save($object, $data, $files){
    sfContext::getInstance()->getConfiguration()->loadHelpers("Partial");
    
    $path_info = pathinfo ( $files ["mdFirstEmbedTemplate"]["header"]['name'] );
    $file_extension = $path_info ["extension"];
    $files["mdFirstEmbedTemplate"]["header"]["name"] = 'pic_header_' . $object->getId() . "." . strtolower($file_extension);
    
    $path_info = pathinfo ( $files ["mdFirstEmbedTemplate"]["body"]['name'] );
    $file_extension = $path_info ["extension"];
    $files["mdFirstEmbedTemplate"]["body"]["name"]   = 'pic_body_' . $object->getId() . "." . strtolower($file_extension);
    
    $path_info = pathinfo ( $files ["mdFirstEmbedTemplate"]["footer"]['name'] );
    $file_extension = $path_info ["extension"];
    $files["mdFirstEmbedTemplate"]["footer"]["name"] = 'pic_footer_' . $object->getId() . "." . strtolower($file_extension);
    
    // Subir archivos
    MdFileHandler::upload( $files["mdFirstEmbedTemplate"], sfConfig::get('sf_upload_dir').'/newsletter', true, "header" );
    MdFileHandler::upload( $files["mdFirstEmbedTemplate"], sfConfig::get('sf_upload_dir').'/newsletter', true, "body" );
    MdFileHandler::upload( $files["mdFirstEmbedTemplate"], sfConfig::get('sf_upload_dir').'/newsletter', true, "footer" );    
    
    $partial = get_partial("mdNewsletterMailing/template_mdFirstTemplate", array('data' => $data, 'object' => $object));
    $content = str_replace('%url%', '<a href="http://' . sfConfig::get('app_domain_url') . '" style="color:#006600" target="_blank">' . sfConfig::get('app_domain_url') . '</a>', $partial);
    $object->setContent($content);
    $object->save();    
  }
}

?>
