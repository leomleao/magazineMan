<?php

class BrothersController extends \Phalcon\Mvc\Controller
{

    public function createAction()
    {       
        $this->view->disable();

        $jsonResponse     = new JsonResponse();
        $responseHTMLcode = 200;

        try {

            /**
             * Do the thing
             */             

            if(!$this->request->hasPost('brotherName') && !$this->request->hasPost('brotherTakesMagazine'))
            {
                throw new Exception("POST request must contain data.", 440);
            }

            $brotherName = $this->request->getPost('brotherName');            
            $brotherTakesMagazine = $this->request->getPost('brotherTakesMagazine');

            $brother = new Brothers();
            $brother->setBrotherName($brotherName);
            $brother->setBrotherTakesMagazine($brotherTakesMagazine);

            if($brother->save()) {

                $jsonData = new JsonData();            
                $jsonData->setId($id)
                         ->setType('Brother')
                         ->addAttributes([
                            'brotherName'                => $brotherName,
                            'brotherTakesMagazine'       => $brotherTakesMagazine
                         ]);  

            } else {
                throw new Exception("Deu ruim.", 440);

            }
            $responseHTMLcode = 201;


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

        } 
      
        /**
        * Send the response object in JSON format
        */
        $jsonResponse->send($responseHTMLcode);

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

            $brother = Brothers::findFirstByBrotherID($id);

            $jsonData = new JsonData();
            if ($brother && $brother->getBrotherStatus() == '1') {
                $jsonData->setId($id)
                         ->setType('Brother')
                         ->addAttributes([
                            'brotherName'          => $brother->getBrotherName(),
                            'brotherTakesMagazine' => $brother->getBrotherTakesMagazine(),                            
                            'brotherCreationDate'  => $brother->getBrotherCreationDate(),                            
                            'brotherLastMod'       => $brother->getBrotherLastMod(),                            
                            'brotherStatus'        => $brother->getBrotherStatus()                            
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

        } 
      
        /**
        * Send the response object in JSON format
        */
        $jsonResponse->send($responseHTMLcode);

    }

    public function readAllAction()
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

            $brother = Brothers::find();

            if ($brother) {

                foreach ($brother as $brother) {
                    if ($brother->getBrotherStatus() == '1'){
                        $jsonData = new JsonData();                        
                        $jsonData->setId($brother->getBrotherID())
                                 ->setType('Brother')
                                 ->addAttributes([
                                    'brotherName'          => $brother->getBrotherName(),
                                    'brotherTakesMagazine' => $brother->getBrotherTakesMagazine(),                            
                                    'brotherCreationDate'  => $brother->getBrotherCreationDate(),                            
                                    'brotherLastMod'       => $brother->getBrotherLastMod(),                            
                                    'brotherStatus'        => $brother->getBrotherStatus()                
                                    ]);                  

                        $jsonResponse->addData($jsonData->commit());
                    }   
                }    

            } else {
                    //Send 'No Content'  Html response code   
                    $responseHTMLcode = 204;
            }    




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

            $brother = Brothers::findFirstByBrotherID($id);
            $changed = FALSE;

            if($this->request->hasPut('brotherName'))
            {
                $changed = TRUE;   
                $brother->setBrotherName($this->request->getPut('brotherName'));
            }

            if($this->request->hasPut('brotherTakesMagazine'))
            {
                $changed = TRUE;
                $brother->setBrotherTakesMagazine($this->request->getPut('brotherTakesMagazine'));
            }

            if($this->request->hasPut('brotherCreationDate'))
            {
                $changed = TRUE;
                $brother->setBrotherCreationDate($this->request->getPut('brotherCreationDate'));
            }

            if($this->request->hasPut('brotherLastMod'))
            {
                $changed = TRUE;
                $brother->setBrotherLastMod($this->request->getPut('brotherLastMod'));
            }
            if($this->request->hasPut('brotherStatus'))
            {
                $changed = TRUE;                
                $brother->setBrotherStatus($this->request->getPut('brotherStatus'));
            }


            if($changed){
                $brother->save();
            }

            $jsonData = new JsonData();
            $jsonData->setId($id)
                     ->setType('Brother')
                     ->addAttributes([
                        'brotherName'          => $brother->getBrotherName(),
                        'brotherTakesMagazine' => $brother->getBrotherTakesMagazine(),                            
                        'brotherCreationDate'  => $brother->getBrotherCreationDate(),                            
                        'brotherLastMod'       => $brother->getBrotherLastMod(),                            
                        'brotherStatus'        => $brother->getBrotherStatus()                            
                     ]);  
            

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

        } 
      
        /**
        * Send the response object in JSON format
        */
        $jsonResponse->send($responseHTMLcode);
            
    }

    public function deleteAction()
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

            $brother = Brothers::findFirstByBrotherID($id); 
            $brother->setBrotherStatus('O');    
            $brother->save();    

            $jsonData = new JsonData();
            $jsonData->setId($id)
                     ->setType('Brother')
                     ->addAttributes([
                        'brotherName'          => $brother->getBrotherName(),
                        'brotherTakesMagazine' => $brother->getBrotherTakesMagazine(),                            
                        'brotherCreationDate'  => $brother->getBrotherCreationDate(),                            
                        'brotherLastMod'       => $brother->getBrotherLastMod(),                            
                        'brotherStatus'        => $brother->getBrotherStatus()                            
                     ]);  
            

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

        } 
      
        /**
        * Send the response object in JSON format
        */
        $jsonResponse->send($responseHTMLcode);
    }    
    

}

