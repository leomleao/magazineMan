<?php

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Bem-Vindo');
        parent::initialize();
    }

    public function indexAction()
    {   
           
        //All the assets will be added to the current view (index.volt)

        // VIEW VARIABLES
            $auth = $this->session->get('auth');
            $this->view->userUser  = $auth['userUser'];
            $this->view->userName  = $auth['userName'];
            $this->view->brothers  = Brothers::getAllocations();   
            $this->view->months    = $this->util->getNextSixMonths(); 
            $this->view->page      = 'home';
            $this->view->pageClass = 'page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-md page-header-fixed page-sidebar-fixed';


        // BEGIN CSS

            // BEGIN PAGE LEVEL PLUGINS
            $pagePluginsCss = $this->assets->collection("pagePluginsCss");
            $pagePluginsCss->addCss('assets/plugins/bootstrap-daterangepicker/daterangepicker.min.css');            
            $pagePluginsCss->addCss('assets/plugins/morris/morris.css');
            $pagePluginsCss->addCss('assets/plugins/fullcalendar/fullcalendar.min.css');
            $pagePluginsCss->addCss('assets/plugins/jqvmap/jqvmap/jqvmap.css');
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
            $pagePluginJs->addJs('assets/plugins/moment.min.js');
            $pagePluginJs->addJs('assets/plugins/bootstrap-daterangepicker/daterangepicker.min.js');
            $pagePluginJs->addJs('assets/plugins/morris/morris.min.js');
            $pagePluginJs->addJs('assets/plugins/morris/raphael-min.js');
            $pagePluginJs->addJs('assets/plugins/counterup/jquery.waypoints.min.js');
            $pagePluginJs->addJs('assets/plugins/counterup/jquery.counterup.min.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/amcharts.min.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/serial.min.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/pie.min.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/radar.min.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/themes/light.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/themes/patterns.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amcharts/themes/chalk.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/ammap/ammap.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/ammap/maps/js/worldLow.js');
            $pagePluginJs->addJs('assets/plugins/amcharts/amstockcharts/amstock.js');
            $pagePluginJs->addJs('assets/plugins/fullcalendar/fullcalendar.min.js');
            $pagePluginJs->addJs('assets/plugins/horizontal-timeline/horizontal-timeline.js');
            $pagePluginJs->addJs('assets/plugins/flot/jquery.flot.min.js');
            $pagePluginJs->addJs('assets/plugins/flot/jquery.flot.resize.min.js');
            $pagePluginJs->addJs('assets/plugins/flot/jquery.flot.categories.min.js');
            $pagePluginJs->addJs('assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js');
            $pagePluginJs->addJs('assets/plugins/jquery.sparkline.min.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/jquery.vmap.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js');
            $pagePluginJs->addJs('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js');
            // END PAGE LEVEL PLUGINS


            // BEGIN PAGE LEVEL SCRIPTS
            $pageLevelScripts = $this->assets->collection("pageScripts");
            $pageLevelScripts->addJs('assets/pages/scripts/dashboard.min.js');
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

    
}
