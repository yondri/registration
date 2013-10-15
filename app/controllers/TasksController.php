<?php
use Phalcon\Tag as Tag;
use Phalcon\Flash as Flash;
use Phalcon\Session as Session;

class TasksController extends \Phalcon\Mvc\Controller
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
		}else{
			$this->flash->error('Please login or register to manage your tasks!');
			return $this->dispatcher->forward(array(
	            'controller' => 'session',
	            'action' => 'index'
	        ));
		}

        //Query the active user
        //$user = Users::findFirst($auth['id']);
        /*if (!$user) {
            $this->_forward('signup/index');
        }else{
        	$this->view->setVar("user", $user);
        }*/
    }
	
	public function initialize()
    {
        //$this->view->setTemplateAfter('main');
        //Tag::setTitle('Manage your Invoices');
        //parent::initialize();
    }

}