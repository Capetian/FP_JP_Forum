<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function onConstruct(){
        $headCol = $this->assets->collection('header');
        $headCol->addCss('css/bootstrap.min.css');


        $footerCol = $this->assets->collection('js');
        $footerCol->addJs('js/bootstrap.bundle.min.js');



        $this->tag->setTitle('JP FORUM');
        $this->tag->setDoctype(Phalcon\Tag::HTML5);
    }
}
