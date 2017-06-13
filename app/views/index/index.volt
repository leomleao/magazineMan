                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->                       
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Revistas</span>
                                </li>
                            </ul>                            
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Administracao
                            <small> entrega de revistas</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->                        
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            Revistas de estudo 
                                        </div>                                        
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th> Nome </th>
                                                        {% for month in months %}
                                                            <th> {{ month }} </th>
                                                        {% endfor  %}                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {% for brother in brothers %}
                                                        <tr id="{{brother['brotherID']}}">
                                                            <td> {{ brother['brotherName'] }} </td>
                                                            {% for month in months %}
                                                                {% for magazine in brother['magazines'] %}
                                                                    {% if month == magazine %}                                          
                                                                        {% set haveMagazine = TRUE %}
                                                                        {% break %}
                                                                    {% else %}
                                                                        {% set haveMagazine = FALSE %}
                                                                    {% endif %}
                                                                {% endfor  %}

                                                                {% if haveMagazine == TRUE %}
                                                                    <td id="{{magazine}}"> <a class="done" href="javascript:;"><i style="color:green"class="fa fa-check fa-lg"></i></a></td>
                                                                {% else %}
                                                                    <td id="{{magazine}}"> <a class="done" href="javascript:;"><i style="color:red"class="fa fa-close fa-lg"></i></a></td></td>
                                                                {% endif %} 
                                                            {% endfor  %}                                                            
                                                        </tr>  
                                                    {% endfor  %}                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SAMPLE TABLE PORTLET-->                                
                            </div>                            
                        </div>                       
                       
                    </div>
                    <!-- END CONTENT BODY -->