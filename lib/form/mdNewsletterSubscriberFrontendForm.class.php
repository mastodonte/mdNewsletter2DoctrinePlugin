<?php

/**
 * PluginmdNewsletterSubscriber form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdNewsletterSubscriberFrontendForm extends BasemdNewsletterSubscriberForm {

  public function setup() {
    parent::setup();

    unset($this['status'], $this['created_at'], $this['updated_at']);

    sfContext::getInstance()->getConfiguration()->loadHelpers("I18N");

    $error_message = array(
        'required' => __('mdNewsletter_Email Requerido'),
        'invalid' => __('mdNewsletter_Email Invalido')
    );

    $this->widgetSchema['email'] = new sfWidgetFormInputText();

    $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true), $error_message);

    $error_message = array(
        'required' => __('mdNewsletter_Email Requerido'),
        'invalid' => __('mdNewsletter_Email Duplicado')
    );

    $this->validatorSchema->setPostValidator(
            new sfValidatorDoctrineUnique(array('model' => 'mdNewsletterSubscriber', 'column' => array('email')), $error_message)
    );
  }

}
