<?php

use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Crypt;
use Phalcon\Http\Response\Cookies;


class Services extends \Base\Services
{    
    /**
     * We register the events manager
     */
    protected function initDispatcher()
    {
        $eventsManager = new EventsManager;

        /**
         * Check if the user is allowed to access certain action using the SecurityPlugin
         */
        $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

        /**
         * Handle exceptions and not-found exceptions using NotFoundPlugin
         */
        $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

        $dispatcher = new Dispatcher;
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }

     /**
     * We register the routes
     */
    protected function initRouter()
    {
        return require APP_PATH . 'app/config/routes.php';
    }

    /**
     * The URL component is used to generate all kind of urls in the application
     */
    protected function initUrl()
    {
        $url = new UrlProvider();
        $url->setBaseUri($this->get('config')->application->baseUri);
        return $url;
    }

    protected function initView()
    {
        $view = new View();

        $view->setViewsDir(APP_PATH . $this->get('config')->application->viewsDir);

        $view->registerEngines(array(
            '.volt' => 'volt'
        ));

        return $view;
    }

    /**
     * Setting up volt
     */
    protected function initSharedVolt($view, $di)
    {
        $volt = new VoltEngine($view, $di);

        $volt->setOptions(array(
            'compiledPath' => APP_PATH . 'cache/volt/',
            'stat' => true,
            'compileAlways' => true
        ));

        $compiler = $volt->getCompiler();
        $compiler->addFunction('is_a', 'is_a');
        $compiler->addFilter('getAttribute', function ($resolvedArgs, $exprArgs) use ($di)
            {
                $args = explode(', ', $resolvedArgs);
                $args[1] = substr($args[1], 1);               
                return vsprintf('%s->%s', $args);
            });
        
        return $volt;
    }

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    protected function initDb()
    {
        $config = $this->get('config')->get('database')->toArray();

        $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
        unset($config['adapter']);

        return new $dbClass($config);
    }

    /**
     * If the configuration specify the use of metadata adapter use it or use memory otherwise
     */
    protected function initModelsMetadata()
    {
        return new MetaData();
    }

    /**
     * Start the session the first time some component request the session service
     */
    protected function initSession()
    {
        $session = new SessionAdapter();
        $session->start();
        return $session;
    }

    /**
     * Start the crypt service
     */
    protected function initCrypt()
    {
        $crypt = new Crypt();

        $crypt->setKey('KLOal%0k5W4euy&-4`!y1de69JN5QG(7667D6s8J70fM.8kV?N84Wb4GcgO2M]('); // Use your own key!

        #     KLOal%0k5W4euy&-4`!y1de69JN5QG(7667D6s8J70fM.8kV?N84Wb4GcgO2M](
        
        return $crypt;
    }

    /**
     * Register the flash service with custom CSS classes
     */
    protected function initFlash()
    {
        return new FlashSession(array(
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ));
    }

    /**
     * Register the mail service
     */
    protected function initMail()
    {
        $mail = new Mail();
        return $mail;

    }

    /**
     * Register the util service
     */
    protected function initUtil()
    {
        $util = new Util();
        return $util;

    }


    // /**
    //  * Register a user component
    //  */
    // protected function initElements()
    // {
    //     return new Elements();
    // }

}
