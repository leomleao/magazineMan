<?php

class AllocationsController extends \Phalcon\Mvc\Controller
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

            if(!$this->request->hasPost('allocationBrotherID') && !$this->request->hasPost('allocationMagazineDate'))
            {
                throw new Exception("POST request must contain data.", 440);
            }

            $allocationBrotherID = $this->request->getPost('allocationBrotherID');            
            $allocationMagazineDate = $this->request->getPost('allocationMagazineDate');

            $allocation = new Allocations();
            $allocation->setAllocationBrotherID($allocationBrotherID);
            $allocation->setAllocationMagazineDate($allocationMagazineDate);

            if($allocation->save()) {

                $jsonData = new JsonData();            
                $jsonData->setId($id)
                         ->setType('Brother')
                         ->addAttributes([
                            'allocationBrotherID'    => $allocationBrotherID,
                            'allocationMagazineDate' => $allocationMagazineDate
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

            $allocation = Allocations::findFirstByAllocationBrotherID($id);

            $jsonData = new JsonData();
            if ($allocation) {
                $jsonData->setId($allocation->getAllocationID())
                         ->setType('Brother')
                         ->addAttributes([
                            'allocationBrotherID'    => $allocation->getallocationBrotherID(),
                            'allocationMagazineDate' => $allocation->getallocationMagazineDate()                        
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

            // $allocations = Allocations::find();

            

            $allocations = Allocations::find();

            if ($allocations) {

                foreach ($brothers as $brothers) {
                    
                    $jsonData = new JsonData();                        
                    $jsonData->setId($allocation['allocationID'])
                             ->setType('Brother')
                             ->addAttributes([
                                    'allocationBrotherID'    => $brothers['allocationBrotherID'],
                                    'allocationMagazineDate' => $brothers['allocationMagazineDate']                 
                                ]);                  

                    $jsonResponse->addData($jsonData->commit());
                     
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

            $allocation = Allocations::findFirstByAllocationBrotherID($id);
            $changed = FALSE;

            if($this->request->hasPut('allocationBrotherID'))
            {
                $changed = TRUE;   
                $allocation->setAllocationBrotherID($this->request->getPut('allocationBrotherID'));
            }

            if($this->request->hasPut('allocationMagazineDate'))
            {
                $changed = TRUE;
                $allocation->setAllocationMagazineDate($this->request->getPut('allocationMagazineDate'));
            }          


            if($changed){
                $allocation->save();
            }

            $jsonData = new JsonData();
            $jsonData->setId($id)
                     ->setType('Brother')
                     ->addAttributes([
                            'allocationBrotherID'    => $allocation->getallocationBrotherID(),
                            'allocationMagazineDate' => $allocation->getallocationMagazineDate()                           
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

