<?php
declare(strict_types=1);


class SubforumController extends ControllerBase
{

    public function indexAction()
    {
        $subforums = $this->toJson(Subforums::get());

        $this->view->subforums = $subforums;

        $this->view->pick('subforum/index');
    }

    public function createAction()
    {
        $this->view->pick('subforum/create');  
    }

    public function storeAction()
    {
        $user = Subforums::init();
        $request = $this->request;
        $user->fill(
            [
                'name' => $request->getPost('name'),
                'description' => $request->getPost('desc'),
            ]

        )->save();
        $this->response->redirect('subforum/index');
    }

    public function showAction($param)
    {
        $q = Subforums::findById($this->toID($param));
        $name = $q->name;
        $threads = $this->toJson(Threads::where("title","%", ".")->join('replies')->where('subforum_id',$this->toID($param))->inWhere('pinned',[false,true])
        ->orderBy('pinned', 'desc')->get());
        $this->view->threads = $threads;
        $this->view->name = $name;

        $this->view->pick('subforum/show');
    } 
}