<?php
declare(strict_types=1);

use Phalcon\Escaper;
use Phalcon\Security;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Url as UrlResolver;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;
/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

$di->setShared(
    'dispatcher',
    function () {
        // Create an EventsManager
        $eventsManager = new EventsManager();

        // Attach a listener
        $eventsManager->attach(
            'dispatch:beforeException',
            function (Event $event, $dispatcher, Exception $exception) {
                // Handle 404 exceptions
                if ($exception instanceof DispatchException) {
                    $dispatcher->forward(
                        [
                            'controller' => 'error',
                            'action'     => 'show404',
                        ]
                    );

                    return false;
                }
            }
        );

        $dispatcher = new MvcDispatcher();

        // Bind the EventsManager to the dispatcher
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
);


$di->setShared(
    'security',
    function () {
        $security = new Security();

        $security->setWorkFactor(12);

        return $security;
    }
);
/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'path' => $config->application->cacheDir,
                'separator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});


$di->set('mongo', function () use ($di) {
    $config  = $di->get('config')->mongodb;
    $manager = new \MongoDB\Driver\Manager('mongodb://' . $config->host . ':' . $config->port);
    return $manager;
}, true);


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */

$di->setShared('escaper', function () {
    return new Escaper();
});

 $di->set('flash', function () use ($di) {
    $flash = new Flash($di->getShared('escaper'));
    $flash->setImplicitFlush(false);
    $flash->setCssClasses([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);

    return $flash;
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionManager();
    $files = new SessionAdapter([
        'savePath' => sys_get_temp_dir(),
        'uniqueID' => 'prspbkk',
    ]);
    $session->setAdapter($files);
    $session->start();

    return $session;
});

$di->set(
    'flashSession',
    function () use ($di) {
        $flash = new FlashSession(
            $di->getShared('escaper'), $di->getShared('session')
        );
        $flash->setCssClasses([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
        $flash->setAutoescape(false);
        
        return $flash;
    }
);