<?php
declare(strict_types=1);


class ErrorController extends ControllerBase
{
    public function show404Action()
    {
        $this->view->pick('error/404');
    }
}