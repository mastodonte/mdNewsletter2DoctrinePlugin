<?php

/**
 * mdNewsletterFrontend actions.
 *
 * @package    mdNewsletterDoctrine
 * @subpackage mdNewsletterFrontend
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdNewsletterFrontendActions extends sfActions {

  public function executeCreate(sfWebRequest $request) {
    $this->form = new mdNewsletterSubscriberFrontendForm();

    return $this->processForm($request, $this->form);
  }
  
  public function executeShow(sfWebRequest $request){
    $queue = $this->getRoute()->getObject();
    

    $email = $request->getParameter('e');

    $body = str_replace(
      array(
        '%unsuscribe_url%', 
        '%direct_url%',
        '%email%'),
      array(
        mdNewsletterSubscriber::getUnsuscribeUrl( $queue->getId() ), 
        $queue->getDirectUrl(),
        $email),
      $queue->getContent()
    );
    echo $body;
    die();
  }

  protected function processForm(sfWebRequest $request, sfForm $form){
    sfContext::getInstance()->getConfiguration()->loadHelpers("I18N");
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $md_newsletter_template = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        
        $message = __("mdNewsletter_El e-mail ingresado ya existe");

        return $this->renderText(mdBasicFunction::basic_json_response(false, array("message" => $message)));
      }

      $this->getUser()->setFlash('notice', $notice);
      
      $message = __('mdNewsletter_Se a suscrito correctamente.');
      
      return $this->renderText(mdBasicFunction::basic_json_response(true, array("message" => $message)));

    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
      
      $message = $form['email']->getError()->getMessageFormat();

      return $this->renderText(mdBasicFunction::basic_json_response(false, array("message" => $message)));
    }
  }
  
  public function executeUnsuscribe(sfWebRequest $request){
    
    $code = $request->getParameter('code');
    sfContext::getInstance()->getConfiguration()->loadHelpers("I18N");
    
    try{
      
      mdNewsletterSubscriber::checkUnsuscribeParams($code);
      $this->getUser()->setFlash('notice', __('mdNewsletter_Desuscripcion correcta'));
      
    }  catch (Exception $e){
      
      $this->getUser()->setFlash('error', $e->getMessage());

    }

    $this->redirect('@homepage');
  }

}
