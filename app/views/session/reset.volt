
{% extends 'index.volt' %}

{% block content %}

        <div class="user-reset-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset mt-reset-5-bsfix">
                    <div class="reset-bg" style="background-image:url('{{ url('assets/img/wago_backdrop.jpg') }}')">
                    </div>
                </div>
                <div class="col-md-6 reset-container bs-reset mt-reset-5-bsfix">
                    <img class="reset-logo reset-6" src="{{ url('assets/img/logo_wago_2.png') }}" />   
                    <div class="reset-content">
                        <h1>WAGO Follow-me Up</h1> 
                        {% if recover %}
                            {% if overdue %}

                            <div class="reset-header">
                                <p> {{ message }} </p> 
                            </div>


                            {% else %}
                            <div class="reset-header">
                                <p>Ola, {{userName}}, conforme requisicao basta digitar sua nova senha:</p> 
                            </div>
                            {{ form('session/reset', 'class': 'reset-form') }}
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </div>                            
                                <div class="row">     
                                    <div class="col-xs-3">  
                                    </div>                         
                                    <div class="col-xs-6">
                                        {{ password_field('userPassword', 'class': "form-control form-control-solid placeholder-no-fix form-group",'placeholder': 'Senha', 'autoComplete': 'off', 'required': 'required') }}                                    
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-xs-3">  
                                    </div>   
                                    <div class="col-xs-6">
                                        {{ password_field('userPasswordConfirm', 'class': "form-control form-control-solid placeholder-no-fix form-group",'placeholder': 'Confirmacao', 'autoComplete': 'off', 'required': 'required') }}                                    
                                    </div>
                                    <input type="hidden" name="{{ tokenKey }}" value="{{ token }}" />
                                    <input type="hidden" name="token" value="{{ resetToken }}" />

                                </div>
                                <div class="row">                                
                                    <div class="col-xs-7 text-right">
                                        {{ submit_button('Redefinir', 'class': 'btn green-wago') }}                                    
                                    </div>
                                </div>
                            </form>

                            {% endif %} 


                        

                        {% else %}

                         <div class="reset-header">
                            <p> {{ message }} </p> 
                        </div>

                        {% endif %} 



                        <div class="row">
                                <div class="col-xs-12 reset-message">                               
                                    {{ flash.output() }}                                 
                                </div>                                
                        </div>                                               
                    </div>
                    <div class="reset-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                               <ul class="reset-social social-icons social-icons-color">                                    
                                    <li>
                                        <a href="https://www.facebook.com/wagobr" data-original-title="facebook" class="facebook"> </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/wagobr" data-original-title="twitter" class="twitter"> </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/channel/UC0aKeW9IK6y0PHIiFiJHO-Q" data-original-title="youtube" class="youtube"> </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/wago-brazil" data-original-title="linkedin" class="linkedin"> </a>
                                    </li>                                    
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="reset-copyright text-right">
                                    <p>WAGO Kontakttechnik GmbH &amp; Co. KG &copy; 2016</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 {% endblock %}
