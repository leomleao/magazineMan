<?php

use Phalcon\Mvc\View;
use UAParser\Parser;

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Login');
        parent::initialize();
    }

    public function indexAction()
    {      

        //This is to avoid the rendering of the top bar and the side bar
        $this->view->setRenderLevel(
        View::LEVEL_ACTION_VIEW
        );

        //Get remember me cookie if it exists to render it in the view
        if ($this->cookies->has("rememberMe")) {             
            $userUser = json_decode($this->cookies->get("rememberMe")->getValue())->userUser;
        } else {
            $userUser = '';
        }

        //All the assets will be added to the current view (index.volt)

        // VIEW VARIABLES
        $this->view->page     = 'login';
        $this->view->userUser = $userUser;


        // BEGIN CSS

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginsCss = $this->assets->collection("pagePluginsCss");
            $pagePluginsCss->addCss('assets/plugins/select2/css/select2.min.css');
            $pagePluginsCss->addCss('assets/plugins/select2/css/select2-bootstrap.min.css');
            // END PAGE LEVEL PLUGINS

            // BEGIN PAGE LEVEL STYLES
            $pageStyleCss = $this->assets->collection("pageStyleCss");
            $pageStyleCss->addCss('assets/pages/css/login.min.css');
            // END PAGE LEVEL STYLES

        // END CSS
        // START JS           

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginJs = $this->assets->collection("pagePluginJs");
            $pagePluginJs->addJs('assets/plugins/jquery-validation/js/jquery.validate.min.js');
            $pagePluginJs->addJs('assets/plugins/jquery-validation/js/additional-methods.min.js');
            $pagePluginJs->addJs('assets/plugins/select2/js/select2.full.min.js');
            $pagePluginJs->addJs('assets/plugins/backstretch/jquery.backstretch.min.js');
            // END PAGE LEVEL PLUGINS




            // BEGIN PAGE LEVEL SCRIPTS
            $pageLevelScripts = $this->assets->collection("pageScripts");
            $pageLevelScripts->addJs('assets/pages/scripts/login.min.js');
            // END PAGE LEVEL SCRIPTS

        // END JS

                 

    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $user)
    {
            $this->session->set('auth', array(
            'userID'    => $user->getUserID(),
            'userName'  => $user->getUserName(),
            'userUser'  => $user->getUserUser()
        ));
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function loginAction()
    {                            

        if ($this->request->isPost()) {
            $user = $this->request->getPost('userUser');            
            $password = $this->request->getPost('userPassword');

            if ($this->request->getPost('remember')){
                $this->cookies->set(
                    "rememberMe",
                    json_encode(array('userUser' => $user)),
                    time() + 30 * 86400 #86400 is a full day
                );
            } else {
                if ($this->cookies->has("rememberMe")) {             
                    $this->cookies->get("rememberMe")->delete();
                }  
            }

            if ($user && $password){

                $user = Users::findFirstByUserUser($user);

                if ($user) {

                    if ($user->getUserStatus() === '1'){

                        if (LoginAttempts::attempts($user)){

                            $security = new \Phalcon\Security;
                            if ($this->security->checkHash($password,$user->getUserPassword())) {                          
                            $this->_registerSession($user);
                            LoginAttempts::clearAttempts($user);
                            return $this->dispatcher->forward(
                                [
                                    "controller" => "index",
                                    "action"     => "index",
                                ]
                            ); 
                            } else {
                            LoginAttempts::registerAttempts($user);
                            $this->flash->error('Usuario e/ou Senha incorretos!');
                            }
                        } else {
                        $this->flash->error('Usuario bloqueado devido muitas tentativas!');
                        }
                    }
                } else {
                $this->flash->error('Usuario inexistente!'); 
                }
            } else {
                $this->flash->warning('Preencha sua senha e usuario!');
            }    
        } 
            return $this->dispatcher->forward(
                [
                    "controller" => "session",
                    "action"     => "index",
                ]
            );
         
    }

    /**
     * Reset password
     *
     * @return unknown
     */
    public function resetAction()
    {   
        $parser = Parser::create();
        $userAgent = $parser->parse($this->request->getUserAgent());
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://freegeoip.net/json/' . $this->request->getClientAddress());
        $localization = NULL;  
        if ($res->getStatusCode() == 200){           
            $localization = json_decode($res->getBody());
            if ($localization->city == '' || $localization->region_code == ''){
                $localization = NULL;
            }
        }
        
        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                //the token is only present if the request came from the form to reset the password

                $token        = $this->request->getPost('token')               ? $this->request->getPost('token')               : FALSE;               
                $password     = $this->request->getPost('userPassword')        ? $this->request->getPost('userPassword')        : FALSE;   
                $passwordConf = $this->request->getPost('userPasswordConfirm') ? $this->request->getPost('userPasswordConfirm') : FALSE;
                if ($token && $password && $passwordConf){
                    if ($recover = PasswordRecoveries::findFirstByToken($token)){
                        if($recover->getStatus() == '1'){
                            if ($user = Users::findFirstByUserID($recover->getUserID())){  
                                if ($password === $passwordConf){
                                    $user->setUserPassword($this->security->hash($password));
                                    $recover->setStatus('0');
                                    if ($user->save() && $recover->save()){
                                        $this->flash->success('Senha trocada com sucesso.'); 
                                        return $this->dispatcher->forward(
                                            [
                                                "controller" => "session",
                                                "action"     => "index"
                                            ]
                                        );
                                    }
                                } else {
                                    $this->flash->warning('Senha nao conferem!');            
                         
                                    return $this->_redirectBack();
                                }
                            }
                        } else {
                            $this->flash->warning('Infelizmente esse link nao e mais valido ou ja foi usado.');            
                         
                            return $this->_redirectBack();
                        }
                    }
                }

                $this->flash->warning('Algo de errado ocorreu!');             
                 
                return $this->_redirectBack();
            }
            $this->view->setRenderLevel(
            View::LEVEL_NO_RENDER
            );
            $userEmail = $this->request->getPost('userEmail');   
            $user = Users::findFirstByUserEmail($userEmail);
            if ($user) {
                if ($user->getUserStatus() === '1'){
                    $token = $this->security->getToken();
                    $recover = new PasswordRecoveries();
                    $recover->setUserID($user->getUserID());
                    $recover->setToken($token);
                    if($recover->save())
                    {   
                        return $this->mail->send(
                            $userEmail,
                            'Redefinicao de Senha',
                            'recover',
                            array( 
                                'name' => $user->getUserName(),
                                'localization' =>  $localization,
                                'operating_system' => $userAgent->os->family,
                                'browser_name' => $userAgent->ua->family,
                                'support_url' => '',
                                'action_url' =>  $this->request->getServerName() . $this->url->get('reset/') . $token
                            )
                        );
                    }
                } else {
                    return json_encode(array('status' => false, 'message' => 'Usuario nao ativo no sistema, verifique com o time de suporte! :/'));                    
                }
            } else {
                return json_encode(array('status' => false, 'message' => 'Usuario nao cadastrado no sistema, verifique o email inserido! :/'));
            }
        } 
        $this->view->page     = 'reset';
        $this->view->tokenKey = $this->security->getTokenKey();
        $this->view->token    = $this->security->getToken();

         // BEGIN CSS

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginsCss = $this->assets->collection("pagePluginsCss");
            $pagePluginsCss->addCss('assets/plugins/select2/css/select2.min.css');
            $pagePluginsCss->addCss('assets/plugins/select2/css/select2-bootstrap.min.css');
            // END PAGE LEVEL PLUGINS

            // BEGIN PAGE LEVEL STYLES
            $pageStyleCss = $this->assets->collection("pageStyleCss");
            $pageStyleCss->addCss('assets/pages/css/reset.min.css');
            // END PAGE LEVEL STYLES

        // END CSS
        // START JS           

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginJs = $this->assets->collection("pagePluginJs");
            $pagePluginJs->addJs('assets/plugins/jquery-validation/js/jquery.validate.min.js');
            $pagePluginJs->addJs('assets/plugins/jquery-validation/js/additional-methods.min.js');
            $pagePluginJs->addJs('assets/plugins/select2/js/select2.full.min.js');
            $pagePluginJs->addJs('assets/plugins/backstretch/jquery.backstretch.min.js');
            // END PAGE LEVEL PLUGINS




            // BEGIN PAGE LEVEL SCRIPTS
            $pageScripts = $this->assets->collection("pageScripts");
            $pageScripts->addJs('assets/pages/scripts/reset.min.js');
            // END PAGE LEVEL SCRIPTS

        // END JS

        $token = $this->dispatcher->getParams('token')['token'];
        $recover = PasswordRecoveries::query()
            ->columns(array('PasswordRecoveries.userID', 'PasswordRecoveries.token', 'PasswordRecoveries.status', 'creationDate', 'u.userID', 'u.userUser', 'u.userName', 'u.userStatus'))
            ->leftjoin('Users', 'u.userID = PasswordRecoveries.userID', 'u' )
            ->where('PasswordRecoveries.token= :token:', array('token' => $token))
            ->execute();

         $this->view->resetToken = $token;



        if ($recover && $recover->getFirst()->userStatus == '1' && $recover = $recover->getFirst()){
            $this->view->recover = TRUE;
            $this->view->userName = $recover->userName;

            $today = strtotime(date('Y/m/d H:i:s'));
            if ($today - strtotime($recover->creationDate) > 86400) {
                $this->view->overdue = TRUE;
                $this->view->message = 'Infelizmente sua requisicao expirou, por questoes de seguranca esse link apenas eh valido durante 24 horas apos sua requisicao.';
            } else { 
                $this->view->overdue = FALSE;               
            } 

        } else{
            $this->view->recover = FALSE;
            $this->view->message = 'Infelizmente sua requisicao e invalida, talvez algo tenha acontecido com o link ou ainda seu usuario esteja inativo, por favor, consulte o suporte.';
        }
        $this->view->setRenderLevel(
            View::LEVEL_ACTION_VIEW
        );
    }



    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {   
        $this->session->remove('auth');
        $this->flash->success('Tchau! :)');

        return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
    }
}
