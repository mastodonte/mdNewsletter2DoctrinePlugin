<?php

class mdNewsletterTemplateBackendComponents extends sfComponents
{
  public function executeGetForm($request)
  {
    $classForm = $this->template . 'Form';
    if(!isset($this->form) || get_class($this->form) != $classForm){
    	$this->form = new $classForm();
	    // Seteamos el template
    	$this->form->setDefault('template', $this->template);
    }

  }
}
