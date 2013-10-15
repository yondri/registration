<?php

use Phalcon\Tag as Tag;
use Phalcon\Session as Session;

class SessionController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        //Get session info
        $auth = $this->session->get('auth');
        
        if($auth){
            $user = Users::findFirst($auth['id']);
            $tasks = Tasks::find();
            $this->view->setVar("tasks", $tasks);
            $this->view->setVar("user", $user);
            return $this->dispatcher->forward(array(
                'controller' => 'tasks',
                'action' => 'index'
            ));
        }
    }

    public function registerAction()
    {
    	$request = $this->request;
        if ($request->isPost()) {
			$user = new Users();
			$user->name = $this->request->getPost('name');
			$user->username = $this->request->getPost('username');
			$user->password = md5($this->request->getPost('password'));
			$user->email = $this->request->getPost('email');
			$user->created_at = date('Y-m-d H:i:s');
			$user->active = 1;
			
			if($user->save()){
				$this->flash->success('Thanks for sign-up, please log-in to start managing tasks');
                //return $this->forward('session/index');
				//$this->_registerSession($user);
				//$this->flash->success('Welcome ' . $user->name);
				return $this->dispatcher->forward(array(
                    'controller' => 'session',
                    'action' => 'index'
                ));
				//echo 'Thanks for registering!';
			}else{
				echo 'We found some problem during registration: <br/>';
				foreach ($user->getMessages() as $message) {
					echo $message->getMessage().'<br/>';
				}
			}
		}
    }

    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }

    /**
     * This actions receive the input from the login form
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email');

            $password = $this->request->getPost('password');
            $password = md5($password);

            $user = Users::findFirst("email='$email' AND password='$password'");
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome!');
                return $this->dispatcher->forward(array(
                    'controller' => 'tasks',
                    'action' => 'index'
                ));
            }

            $username = $this->request->getPost('email', 'alphanum');
            $user = Users::findFirst("username='$email' AND password='$password'");
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome!');
                return $this->dispatcher->forward(array(
                    'controller' => 'tasks',
                    'action' => 'index'
                ));
            }

            $this->flash->error('Wrong email/password');
        }

        return $this->dispatcher->forward(array(
            'controller' => 'session',
            'action' => 'index'
        ));
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
    	$this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->dispatcher->forward(array(
            'controller' => 'index',
            'action' => 'index'
        ));
    }
}
