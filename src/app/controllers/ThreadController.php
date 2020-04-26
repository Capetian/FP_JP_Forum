<?php
declare(strict_types=1);
use Phalcon\Http\Request;
use Phalcon\Mvc\View;
class ThreadController extends ControllerBase
{

    public function createAction()
    {
        $subforums = json_decode(Subforums::get()->toJson());
        $this->view->subforums = $subforums;
        $this->view->pick('thread/create');  
    }

    private function toID($id)
    {
        $res = new \MongoDB\BSON\ObjectId($id);
        return $res; 
    }
    
    public function storeAction()
    {
        $thread = Threads::init();
        $request = new Request();

        $root = $thread->fill(
            [
                'title' => $request->getPost('title'),
                'subforum_id' => $this->toID( $request->getPost('sid')),
                'user_id' => $this->toID($request->getPost('uid')),
                'status' => 0,
                'locked'=> 0,
            ]

        )->save()->toArray();
        $this->reply($root['id'], $root['user_id'], $root['subforum_id'], $request->getPost('content'));

       
    }
    
    private function reply($id, $uid, $sid, $content)
    {
        $thread = Threads::init();
        $thread->fill(
            [
                'content' => $content,
                'root' => $this->toID($id),
                'subforum_id' => $this->toID($sid),
                'user_id' => $this->toID($uid),
                'deleted' => 0,
            ]

        )->save();
        $this->response->redirect('thread/show/'.$id);
    }

    public function replyAction()
    {
        $request = new Request();
        $this->reply($request->getPost('r_id'),$request->getPost('r_uid'),$request->getPost('r_sid'), $request->getPost('content'));
    }

    public function showAction($param)
    {
        $root = Threads::where('_id', $this->toID($param))->first();
        $root->user;
        $replies = Threads::join('user')->where('root', $this->toID($param))->get();

        $this->view->replies = $replies;
        $this->view->root = $root;

        $this->view->pick('thread/show');
    }

    public function hideAction()
    {
        $request = new Request();
        $hid = $request->getPost("h_id");
        $post = Threads::where("_id", $this->toID($hid))->update(["deleted" => 1]);
        $id = strval($post->root);
        $this->response->redirect("/thread/show/".$id);
    }

    public function deleteAction()
    {
        $request = new Request();
        $id = $this->toID($request->getPost("d_id")) ;
        $posts = Threads::where("_id", $id)->orWhere("root",$id)->delete();
        $this->response->redirect("/subforum/index");
    }

    public function lockAction()
    {
        $request = new Request();
        $id = $request->getPost("l_id");
        $post = Threads::where("_id", $this->toID($id))->update(["locked" => 1]);
        $this->response->redirect("/thread/show/".$id);
    }


    public function pinAction()
    {
        $request = new Request();
        $id = $request->getPost("p_id");
        $post = Threads::where("_id", $this->toID($id) )->update(["status" => 1]);
        $this->response->redirect("/thread/show/".$id);
    }


    public function editAction()
    {
        $request = new Request();
        $changes = [];
        $content = $request->getPost("e_content");
        $eid = $request->getPost("e_id");
        if ( isset($content) ) {
            $changes['content'] = $content;
        }
        $post = Threads::where("_id",$this->toID($eid) )->update($changes);
        $id = strval($post->root);
        $this->response->redirect("/thread/show/".$id);
    }

}