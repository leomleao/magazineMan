<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        {{ get_title() }}        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content="Leo">

        <!-- BEGIN GLOBAL LOADING PLUGIN/STYLE --> 
        {{ javascript_include('assets/plugins/pace/pace.min.js') }}
        {{ stylesheet_link('assets/plugins/pace/themes/pace-theme-flash.min.css') }}
        <!-- END GLOBAL LOADING PLUGIN/STYLE --> 
        <!-- BEGIN GLOBAL MANDATORY STYLES -->        
        {{ stylesheet_link('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all', false) }}        
        {{ stylesheet_link('assets/plugins/font-awesome/css/font-awesome.min.css') }}        
        {{ stylesheet_link('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}        
        {{ stylesheet_link('assets/plugins/bootstrap/css/bootstrap.min.css') }}        
        {{ stylesheet_link('assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {% if assets.exists('pagePluginsCss') %}
        {{ assets.outputCss('pagePluginsCss') }}   
        {% endif %}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        {{ stylesheet_link('assets/css/components-md.min.css') }}
        {{ stylesheet_link('assets/css/plugins-md.min.css') }}
        <!-- END THEME GLOBAL STYLES -->    
        <!-- BEGIN PAGE LEVEL STYLES -->
        {% if assets.exists('pageStyleCss') %}
        {{ assets.outputCss('pageStyleCss') }}   
        {% endif %}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        {% if assets.exists('themeLayoutCss') %}
        {{ assets.outputCss('themeLayoutCss') }}   
        {% endif %}
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ url("favicon.ico") }}" type="image/x-icon">    
    </head>        
    <!-- END HEAD -->
    <body{% if page is not empty %}{% if pageClass is not empty %} class="{{ [page,pageClass]|join(' ') }}"{% else %} class="{{ page }}" {% endif %} > 
        <!-- BEGIN : {{ page }} PAGE -->
        {% endif %}

        {% block content %}   
        {{ content() }}  
        {% endblock %}

        {% if page is not empty %} 
        <!-- END : {{ page }} PAGE -->
        {% endif %}

        <!--[if lt IE 9]>
        {{ javascript_include('assets/plugins/respond.min.js') }}        
        {{ javascript_include('assets/plugins/excanvas.min.js') }}        
        {{ javascript_include('assets/plugins/ie8.fix.min.js') }}
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        {{ javascript_include('assets/plugins/jquery.min.js') }}
        {{ javascript_include('assets/plugins/bootstrap/js/bootstrap.min.js') }}
        {{ javascript_include('assets/plugins/js.cookie.min.js') }}
        {{ javascript_include('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
        {{ javascript_include('assets/plugins/jquery.blockui.min.js') }}
        {{ javascript_include('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {% if assets.exists('pagePluginJs') %}
        {{ assets.outputJs('pagePluginJs') }}   
        {% endif %}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {{ javascript_include('assets/scripts/app.min.js') }}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {% if assets.exists('pageScripts') %}
        {{ assets.outputJs('pageScripts') }}   
        {% endif %}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        {% if assets.exists('themeLayoutScripts') %}
        {{ assets.outputJs('themeLayoutScripts') }}   
        {% endif %}
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- END JAVASCRIPT -->
    </body>
</html>