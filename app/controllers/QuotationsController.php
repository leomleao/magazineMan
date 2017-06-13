<?php

use Phalcon\Mvc\View;


class QuotationsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Cotacoes');
        parent::initialize();
        $this->auth = $this->session->get('auth');
        $ancestry = Users::query()
            ->columns(array('userID', 'userName'))
            ->leftJoin('userReports', 'Users.userID = userReports.userReportID')
            ->where('userReports.userReportTo= :userID:', array('userID' => $this->auth['userID']))
            ->execute();
        $this->ancestry = array_merge(array(array('userID'=> $this->auth['userID'], 'userName' => $this->auth['userName'])), $ancestry->toArray());
        

        // function cmp($a, $b)
        //                 {
        //                     return strcmp($a->username, $b->username);
        //                 }

        // function getAncestry($id)
        //                 {
        //                     $join = 'LEFT JOIN users ON users.userID = user_reports.userReportID';
        //                     $reports = UserReport::find('all', array('select' => 'userReportID, userName','joins' => $join, 'conditions' => array('userReportTo = ?', $id)));                               
        //                     return $reports;
        //                 }                   

        //             $reports = getAncestry($this->session->get('userID'));      
        //             usort($reports, 'cmp');
        //             $CurrentUser = User::find('all', array('select' => 'userID as UserReportID, userName', 'conditions' => array('userID = ?', $this->session->get('userID'))));
        //             $reports = array_merge($CurrentUser, $reports);
        //             $reports = array_map('unserialize', array_unique(array_map('serialize', $reports)));                    
        //             $this->ancestry = $reports; 


    }

    public function indexAction()
    {
        $this->view->userUser = $this->auth['userUser'];
        $this->view->userName = $this->auth['userName'];
        $this->view->userDpt  = $this->auth['userDpt'];  
        $this->view->page     = 'quotation';
        $this->view->pageClass = 'page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md';

        

        // BEGIN CSS

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginsCss = $this->assets->collection("pagePluginsCss");
            $pagePluginsCss->addCss('assets/plugins/bootstrap-daterangepicker/daterangepicker.min.css');  
            $pagePluginsCss->addCss('assets/plugins/datatables/datatables.min.css');  
            $pagePluginsCss->addCss('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.min.css');  
            $pagePluginsCss->addCss('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');
            // END PAGE LEVEL PLUGINS

            // BEGIN THEME LAYOUT STYLES
            $pageStyleCss = $this->assets->collection("themeLayoutCss");
            $pageStyleCss->addCss('assets/layouts/layout/css/layout.min.css');
            $pageStyleCss->addCss('assets/layouts/layout/css/themes/default.min.css');
            $pageStyleCss->addCss('assets/layouts/layout/css/custom.min.css');
            // END THEME LAYOUT STYLES

        // END CSS
        // START JS           

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginJs = $this->assets->collection("pagePluginJs");
            $pagePluginJs->addJs('assets/scripts/datatable.min.js');
            $pagePluginJs->addJs('assets/plugins/datatables/datatables.min.js');
            $pagePluginJs->addJs('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');
            $pagePluginJs->addJs('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');           
            // END PAGE LEVEL PLUGINS


            // BEGIN PAGE LEVEL SCRIPTS
            $pageLevelScripts = $this->assets->collection("pageScripts");
            $pageLevelScripts->addJs('assets/pages/scripts/quotations.min.js');
            // END PAGE LEVEL SCRIPTS


            // BEGIN THEME LAYOUT SCRIPTS
            $pageThemeScripts = $this->assets->collection("themeLayoutScripts");
            $pageThemeScripts->addJs('assets/layouts/layout/scripts/layout.min.js');
            $pageThemeScripts->addJs('assets/layouts/layout/scripts/demo.min.js');
            $pageThemeScripts->addJs('assets/layouts/scripts/quick-sidebar.min.js');
            $pageThemeScripts->addJs('assets/layouts/scripts/quick-nav.min.js');
            // END THEME LAYOUT SCRIPTS

        // END JS

    }

    public function dataRequestAction()
    {
        $this->view->setRenderLevel(
            View::LEVEL_NO_RENDER
        );
        // return json_encode($this->ancestry);
               
        // return var_dump($quotations->getWhere());
        
        // 
        if (true || $this->request->isPost()) {

        $bind = array('userID' => $this->auth['userID'], 'status' => '1');
        $quotations = Quotations::query()
            ->columns(array(
                'quotationID', 
                'quotationNumber', 
                'quotationValue', 
                'quotationFinalValue', 
                'quotationState', 
                'quotationCreationDate',
                'quotationInsertionDate',
                'quotationPriority',
                'quotationUserID', 
                'quotationDealerUserID',
                    'DealerName.userName as dealerName',
                    'customerCode', 
                    'customerName', 
                    'customerStatus', 
                    'customerContactName',
                'quotationCommuWay', 
                'quotationReceivedConf', 
                'quotationStatus',
                    'followUpID', 
                    'followUpDesc1', 
                    'followUpInsertionDate1', 
                    'followUpUserID1',
                        'user1.userName as userName1',
                    'followUpDesc2', 
                    'followUpInsertionDate2', 
                    'followUpUserID2', 
                        'user2.userName as userName2', 
                    'followUpDesc3', 
                    'followUpInsertionDate3', 
                    'followUpUserID3',
                        'user3.userName as userName3'    
            ))
            ->leftJoin('Users', 'DealerName.userID = Quotations.quotationDealerUserID', 'DealerName')
            ->leftJoin('Customers', 'Customers.customerID = Quotations.quotationCustomerID')            
            ->leftJoin('FollowUps', 'FollowUps.followUpQuotationID = Quotations.quotationID') 
            ->leftJoin('Users', 'user1.userID = FollowUps.followUpUserID1', 'user1')    
            ->leftJoin('Users', 'user2.userID = FollowUps.followUpUserID1', 'user2')    
            ->leftJoin('Users', 'user3.userID = FollowUps.followUpUserID1', 'user3')
            ->orWhere('Quotations.quotationUserID= :userID:');                

        foreach($this->ancestry as $row=>$content)
              {
                $quotations->orWhere('Quotations.quotationDealerUserID = :userID' . $row . ':'); 
                $bind = array_merge($bind,array('userID' . $row => $content['userID']));       
              }

            $quotations
                ->andWhere('Quotations.quotationStatus= :status:')
                ->bind($bind); 

                
            $today = strtotime(date('Y/m/d H:i:s'));
            $quotations = $quotations->execute();
            $quotationsClean = array();            

            for ($i=0; $i < count($quotations); $i++) {
                $quotationsClean[$i] = $quotations[$i];
                if ($quotations[$i]->quotationState != 'Aberta') continue;
                if ($quotations[$i]->quotationInsertionDate) { $followup = array(($today - strtotime($quotations[$i]->quotationInsertionDate)));}
                if ($quotations[$i]->followUpInsertionDate1) { $followup = array_merge($followup,array($today - strtotime($quotations[$i]->followUpInsertionDate1)));}
                if ($quotations[$i]->followUpInsertionDate2) { $followup = array_merge($followup,array($today - strtotime($quotations[$i]->followUpInsertionDate2)));}
                if ($quotations[$i]->followUpInsertionDate3) { $followup = array_merge($followup,array($today - strtotime($quotations[$i]->followUpInsertionDate3)));}

                if (isset($followup) && (min($followup) > 432000)){
                        $quotationsClean[$i]->writeAttribute('isoverdue', true);                    
                    } else {
                        $quotationsClean[$i]->writeAttribute('isoverdue', false);
                    }
                if (isset($followup)) unset($followup);
            }  


        return json_encode(array('data' => $quotationsClean)); 

        }        
    }
}
