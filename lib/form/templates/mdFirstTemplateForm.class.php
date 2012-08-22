<?php
 
class mdFirstTemplateForm extends BasemdNewsletterTemplateForm{
  
  public function setup()
  {
    parent::setup();
    
    unset($this['created_at'], $this['updated_at']);
     
    $this->widgetSchema['template'] = new sfWidgetFormInputHidden();
    
    $this->widgetSchema['content'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['content'] = new sfValidatorString(array('required' => false));
    
    $this->embedForm('mdFirstEmbedTemplate', new mdFirstEmbedTemplateForm());
  }
  
  public function doSave($con = null) 
  {
    $data = $this->getTaintedValues();

    $files = sfContext::getInstance()->getRequest()->getFiles($this->getName());

    parent::doSave($con);

    $this->embeddedForms['mdFirstEmbedTemplate']->my_save($this->getObject(), $data, $files);      

  }

}

?>
