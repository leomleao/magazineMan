<?php

use Phalcon\Mvc\View;

class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Oops!');
        parent::initialize();
    }

    public function show404Action()
    {

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );

    }

    public function show401Action()
    {

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );

    }

    public function show500Action()
    {

        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );

    }
}
