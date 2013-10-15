<?php

class SignupController extends \Phalcon\Mvc\Controller
{
	private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }

    public function indexAction()
    {

    }
	
	public function registerAction()
    {
		$user = new Users();
		$user->name = $this->request->getPost('name');
		$user->username = $this->request->getPost('username');
		$user->password = md5($this->request->getPost('password'));
		$user->email = $this->request->getPost('email');
		$user->created_at = date('Y-m-d H:i:s');
		$user->active = 1;
		
		if($user->save()){
			$this->_registerSession($user);
			$this->flash->success('Welcome ' . $user->name);
			return $this->dispatcher->forward(array(
                    'controller' => 'tasks',
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
	
	public function endAction()
    {
    	//print_r($this->session);
    	//$this->session->destroy();
        $this->session->remove();
        //$this->flash->success('Goodbye!');
        //return $this->forward('index/index');
    }

}