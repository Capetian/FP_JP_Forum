<?php
declare(strict_types=1);

class ThreadController extends ControllerBase
{

    public function createAction()
    {
        if (isset($this->session->auth['uid'])) {
            $subforums = $this->toJson(Subforums::get());
            $this->view->subforums = $subforums;
            $this->view->pick('thread/create');  
        }
        else {
            $this->response->redirect('/');
        }
    }
    
    public function storeAction()
    {
        $thread = Threads::init();
        $request = $this->request;

        $root = $thread->fill(
            [
                'title' => $request->getPost('title'),
                'subforum_id' => $request->getPost('sid'),
                'user_id' => $request->getPost('uid'),
                'pinned' => false,
                'locked'=> false,
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
                'root' => $id,
                'subforum_id' => $sid,
                'user_id' => $uid,
                'deleted' => false,
            ]

        )->save();
        $this->response->redirect('thread/show/'.$id);
    }

    public function replyAction()
    {
        $request = $this->request;
        $this->reply($request->getPost('r_id'),$request->getPost('r_uid'),$request->getPost('r_sid'), $request->getPost('content'));
    }

    public function showAction($param)
    {
        $id = $this->toID($param);
        $root = Threads::findById($id);
        $replies = $this->toJson(Threads::join('user')->where('root',$id )->get());

        $this->view->replies = $replies;
        $this->view->root = $root;

        $this->view->pick('thread/show');
    }

    public function hideAction()
    {
        $request = $this->request;
        $hid = $request->getPost("h_id");
        $post = Threads::where("_id", $this->toID($hid))->update(["deleted" => true]);
        $id = strval($post->root);
        $this->response->redirect("/thread/show/".$id);
    }

    public function deleteAction()
    {
        $request = $this->request;
        $id = $this->toID($request->getPost("d_id")) ;
        $posts = Threads::where("_id", $id)->orWhere("root",$id)->delete();
        $this->response->redirect("/subforum/index");
    }

    public function lockAction()
    {
        $request = $this->request;
        $id = $request->getPost("l_id");
        $val = $request->getPost("l_val","bool");
        $post = Threads::where("_id", $this->toID($id))->update(["locked" => $val]);
        $this->response->redirect("/thread/show/".$id);
    }


    public function pinAction()
    {
        $request = $this->request;
        $id = $request->getPost("p_id");
        $val = $request->getPost("p_val","bool");
        $post = Threads::where("_id", $this->toID($id) )->update(["pinned" => $val]);
        $this->response->redirect("/thread/show/".$id);
    }


    public function editAction()
    {
        $request = $this->request;
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