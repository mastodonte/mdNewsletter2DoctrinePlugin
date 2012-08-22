<?php
 
class mdNewsTemplateForm extends BasemdNewsletterTemplateForm{
  
  public function setup()
  {
    parent::setup();
    
    unset($this['created_at'], $this['updated_at']);
    
    $this->widgetSchema['template'] = new sfWidgetFormInputHidden();
    
    $this->widgetSchema['content'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['content'] = new sfValidatorString(array('required' => false));    
  }

  public function getTemplateName() {
    return 'mdNewsTemplate';
  }
  
  public function doSave($con = null) 
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers("Partial");
    $data = $this->getTaintedValues();

    $noticias = mdNews::ultimasNoticias(10, 1)->getResults();
    $data['content'] = get_partial("mdNewsletterMailing/template_" . $this->getTemplateName(), array('noticias' => $noticias));    

    $this->bind($data);

    return parent::doSave($con);
  }
}

?>
