<?php

class mdNewsletterFrontendComponents extends sfComponents {

  public function executeRegister(sfWebRequest $request) {
    $this->form = new mdNewsletterSubscriberFrontendForm();
  }

}
