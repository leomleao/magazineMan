<?php

class UsersController extends \Phalcon\Mvc\Controller
{

    public function createAction()
    {       
        $this->view->disable();

    }

    public function readAction()
    {    
        /**
        * Disable the view, as only a JSON will be returned
        */    
        $this->view->disable();

        /**
        * Create the response object with HTML code
        */
        $jsonResponse     = new JsonResponse();
        $responseHTMLcode = 200;

        try {

            /**
             * Do the thing
             */

            if(!$this->dispatcher->hasParam('id'))
            {
                throw new Exception("GET request must contain id.", 440);
            }

            $id = $this->dispatcher->getParam('id');

            $user = Users::findFirstByUserID($id);

            $jsonData = new JsonData();
            if ($user) {
                $jsonData->setId($id)
                         ->setType('User')
                         ->addAttributes([
                            'userUser'                   => '',
                            'userName'                   => '',
                            'userLastKnownPassword'      => '',
                            'userLastKnownPhonePassword' => '',
                            'userEmail'                  => '',
                            'userPicturePath'            => '',
                            'userCreationDate'           => '',
                            'userLastMod'                => '',
                            'userStatus'                 => '',
                            'userRoleID'                 => '',
                            'userDepartmentID'           => ''
                         ]);  
            } else {
                //Send 'No Content'  Html response code   
                $responseHTMLcode = 204;
            }   

            $jsonResponse->addData($jsonData->commit());


        } catch (\Exception $e) {

            $error = new JsonException();
            $error->addLink('http://deuMerda.com.br')
                  ->addStatus($e->getCode())
                  ->addCode('500')
                  ->addTitle('Deu coco no servidor')
                  ->addDetail($e->getMessage())
                  ->addSource($e->getFile (), ['line' => $e->getLine ()])
                  ->addMeta('Esclareco aqui que deu merda');

            $jsonResponse->addError($error->commit());

            /**
             * catch the error

            getMessage ()  string Gets the Exception message
      
            int getCode ()  Gets the Exception code
            
            string getFile ()

            int getLine ()   Gets the line in which the exception occurred

            array getTrace ()  Gets the stack trace

            Exception getPrevious ()  Returns previous Exception

            Exception getTraceAsString ()  Gets the stack trace as a string

            string __toString ()  String representation of the exception

            */

        } 
      
        /**
        * Send the response object in JSON format
        */
        $jsonResponse->send($responseHTMLcode);

    }

    public function updateAction()
    {
        /**
        * Disable the view, as only a JSON will be returned
        */    
        $this->view->disable();

        /**
        * Create the response object
        */
        $jsonResponse = new JsonResponse();

        try {

            /**
             * Do the thing
             */

        } catch (\Exception $e) {

            /**
             * catch the error

            getMessage ()

            string Gets the Exception message


            int getCode ()

            Gets the Exception code


            string getFile ()


            int getLine ()

            Gets the line in which the exception occurred


            array getTrace ()

            Gets the stack trace


            Exception getPrevious ()

            Returns previous Exception


            Exception getTraceAsString ()

            Gets the stack trace as a string


            string __toString ()

            String representation of the exception

             */
        }    
    }

    public function deleteAction()
    {
        $this->view->disable();
        
        echo "ha delete";    
    }

}

