<?php
declare(strict_types=1);
use Phalcon\Http\Request;


class UserController extends ControllerBase
{
    public function showAction($uid)
    {
        $uidM = new \MongoDB\BSON\ObjectId($uid);
        $user = Users::where("_id", $uidM)->first();
        $this->view->user = $user;
        $this->view->pick("user/show");
    }


    public function editAction()
    {
        $request = new Request();
        $changes = [];
        $uid = $request->getPost("uid");
        $uidM = new \MongoDB\BSON\ObjectId($uid);
        $em = $request->getPost("email");
        if ( isset($em) ) {
            $changes['email'] = $em;
        }
        $user = Users::where("_id",$uidM)->update($changes);
        $this->response->redirect("/user/show/".$uid);

    }
}