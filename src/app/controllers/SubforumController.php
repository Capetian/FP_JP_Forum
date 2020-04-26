<?php
declare(strict_types=1);
use Phalcon\Http\Request;


class SubforumController extends ControllerBase
{

    public function indexAction()
    {
        $subforums = json_decode( Subforums::get()->toJson());

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
        $request = new Request();
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
        $id = new \MongoDB\BSON\ObjectId($param);

        $q = Subforums::where('_id', $id)->first();
        $name = $q->name;
        $threads = json_decode(Threads::where('subforum_id',$id)->inWhere('status',[0,1])
        ->orderBy('status', 'desc')->orderBy('updated_at','desc')->get()->toJson());
        $this->view->threads = $threads;
        $this->view->name = $name;

        $this->view->pick('subforum/show');
    } 
}