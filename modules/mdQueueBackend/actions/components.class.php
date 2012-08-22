<?php

class mdQueueBackendComponents extends sfComponents
{
  public function executeSelectorFecha(sfWebRequest $request)
  {
    $this->form = new mdQueueForm();
  }
}
