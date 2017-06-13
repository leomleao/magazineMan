<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('Inv Manager | ');
        $this->view->setTemplateAfter('main');
    }

	/**
	* Go Back from whence you came
	* @return type
	*/
	protected function _redirectBack() {
	    return $this->response->redirect($this->request->getHTTPReferer());
	}


}
