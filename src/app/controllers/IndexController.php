<?php
declare(strict_types=1);
use Phalcon\Http\Request;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $subforums = json_decode( Subforums::limit(5)->get()->toJson());

        $this->view->subforums = $subforums;

        $this->view->pick('index/index');
    }

    public function loginAction()
    {
        $this->view->pick('index/login');
    }

    public function registerAction()
    {
        $this->view->pick('index/register');
    }

    public function storeAction()
    {
        $user = Users::init();
        $request = new Request();
        $user->fill(
            [
                'username' => $request->getPost('username'),
                'email' => $request->getPost('email'),
                'password' => $request->getPost('password'),
            ]

        )->save();
        $this->response->redirect('/');
    }

    public function signinAction()
    {
        $request = new Request();
        $username = $request->getPost('em');
        $user = Users::where('email', $username)->first()->toArray();
        $pass = $request->getPost('pw');
        if($user)
        {
            if($user['password'] == $pass){
                $this->session->set('auth',['username' => $user['username'], 'uid' => $user['id']]);
            }
            else{
                $this->flashSession->error('Password anda salah');
            }
        }
        else{
            $this->flashSession->error('Email tidak ditemukan');
        }
        $this->response->redirect('/');
    }

    public function logoutAction()
    {
        $this->session->destroy();

        $this->response->redirect('/');
    }

    public function searchAction()
    {
        $request = new Request();
        $results =  json_decode(Threads::where("title","%",$request->getPost("search"))->join('user')->get()->toJson());
        $this->view->results = $results;
        $this->view->pick('index/search');
    }


}

