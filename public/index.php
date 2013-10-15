<?php

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
		$view->registerEngines(array(
			".volt" => 'volt'
		));
        return $view;
    });
	
	//Setting up volt
	$di->set('volt', function($view, $di) {

		$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

		$volt->setOptions(array(
			"compiledPath" => "../cache/volt/"
		));

		return $volt;
	}, true);
	
	// Setting up the view component
	$di->set(
	    'url', 
	    function() {
	        $url = new \Phalcon\Mvc\Url();
	        $url->setBaseUri('/phalcon/');
	        return $url;
	    }
	);
	
	//Set the database service
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "test_phalcon",
            "password" => "SDfg$%hdr5",
            "dbname" => "db_phalcon"
        ));
    });
	
	//Start the session the first time when some component request the session service
	$di->set('session', function() {
	    $session = new Phalcon\Session\Adapter\Files();
	    $session->start();
	    return $session;
	});
	
	/**
	 * Register the flash service with custom CSS classes
	 */
	$di->set('flash', function(){
		return new Phalcon\Flash\Direct(array(
			'error' => 'alert alert-error',
			'success' => 'alert alert-success',
			'notice' => 'alert alert-info',
		));
	});

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}