<?php
declare(strict_types=1);


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $subforums = $this->toJson(Subforums::join('threads')->limit(5)->get());
        $threads = $this->toJson(Threads::where("title","%", ".")->join('replies')->orderBy("updated_at","desc")->limit(5)->get());
        $this->view->subforums = $subforums;
        $this->view->threads = $threads;

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
        $request = $this->checkCSRF($this->request);
        $user->fill(
            [
                'username' => $request->getPost('username'),
                'email' => $request->getPost('email',"email"),
                'password' => $this->security->hash($request->getPost('password',"string")),
                'role' => 0,
            ]

        )->save();
        $this->response->redirect('/');
    }

    public function signinAction()
    {

        $request = $this->checkCSRF($this->request);
        $email = $request->getPost('em', 'email');
        $pass = $request->getPost('pw',"string");
        $user = Users::findFirst(["email"=> $email])->toArray();

        if($user)
        {
            if($this->security->checkHash($pass, $user['password']) === true){
                $this->session->set('auth',['username' => $user['username'], 'uid' => $user['id'], 'role' => $user['role']]);
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
        $request = $this->checkCSRF($this->request);
        $results =  $this->toJson(Threads::where("title","%",$request->getPost("search"))->join('user')->get());;
        $this->view->results = $results;
        $this->view->pick('index/search');
    }

}

