<?php

require_once dirname(__FILE__) . '/../lib/mdNewsletterTemplateBackendGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/mdNewsletterTemplateBackendGeneratorHelper.class.php';

/**
 * mdNewsletterTemplateBackend actions.
 *
 * @package    agrotemario
 * @subpackage mdNewsletterTemplateBackend
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdNewsletterTemplateBackendActions extends autoMdNewsletterTemplateBackendActions {

  public function executePreview(sfWebRequest $request) {
    $this->template = Doctrine::getTable('mdNewsletterTemplate')->find($request->getParameter('id'));

    $this->setLayout(false);
  }

  public function executeEncolar(sfWebRequest $request) {
    $template = Doctrine::getTable('mdNewsletterTemplate')->find($request->getParameter('id'));

    $form = new mdQueueForm();
    $parameters = $request->getParameter($form->getName());

    $form->bind($parameters);
    if ($form->isValid()) {
      $sending_date = explode('/', $parameters['day']);
      $date = $sending_date[2] . '-' . $sending_date[1] . '-' . $sending_date[0] . ' ' . $parameters['time']['hour'] . ':' . $parameters['time']['minute'] . ':00';

      $queue = new mdNewsletterQueue();
      $queue->setContent($template->getContent());
      $queue->setSubject($template->getSubject());
      $queue->setStatus('not sent');
      $queue->setSendingDate($date);
      $queue->save();

      $count = $queue->associate();

      $queue->setRecipients($count);
      $queue->save();

      $this->getUser()->setFlash('notice', 'Se ha agendado un nuevo newsletter correctamente.');

      $this->redirect('@md_newsletter_queue');
    } else {

      $this->getUser()->setFlash('error', 'La fecha ingresada es incorrecta.');

      $this->redirect('@md_newsletter_template');
    }
  }

  public function executeGetForm(sfWebRequest $request) {
    $template = $request->getParameter('template'); // Nombre del formulario para crear cuerpo del mail

    $classForm = $template . 'Form';

    $form = new $classForm();

    // Seteamos el template
    $form->setDefault('template', $template);

    try {

      $partial = $this->getPartial('mdNewsletterTemplateBackend/form_' . $template, array('form' => $form));

      return $this->renderText(mdBasicFunction::basic_json_response(true, array('form' => $partial)));
    } catch (Exception $e) {

      return $this->renderText(mdBasicFunction::basic_json_response(false, array('message' => $e->getMessage())));
    }
  }

  /* public function executeEdit(sfWebRequest $request)
    {
    $this->md_newsletter_template = $this->getRoute()->getObject();

    // Obtenemos el formulario a partir del objeto
    $template = $this->md_newsletter_template->getTemplate() . 'Form';

    $this->form = new $template($this->md_newsletter_template);
    }

    public function executeUpdate(sfWebRequest $request)
    {
    $this->md_newsletter_template = $this->getRoute()->getObject();

    // Obtenemos el formulario a partir del objeto
    $template = $this->md_newsletter_template->getTemplate() . 'Form';

    $this->form = new $template($this->md_newsletter_template);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
    } */

  public function executeCreate(sfWebRequest $request) {
    $params = $request->getPostParameters();
    $template = $params['md_newsletter_template']['template'] . 'Form';

    // Obtenemos el formulario a partir del objeto
    $this->form = new $template();

    $this->md_newsletter_template = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

}
