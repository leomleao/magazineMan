
{% extends 'index.volt' %}

{% block content %}

        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset mt-login-5-bsfix">
                    <div class="login-bg" style="background-image:url('{{ url('assets/img/JW/bethelNY.jpg') }}')">
                    </div>
                </div>
                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <img class="login-logo login-6" width="100" length="100" src="{{ url('assets/img/jworg.svg') }}" onerror="{{ url('assets/img/jworg.png') }}" />   
                    <div class="login-content">
                        <h1>Magazine MAN</h1>                       
                        {{ form('session/login', 'class': 'login-form') }}
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>Insira seu usuario e senha. </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                {% if userUser != '' %}
                                {{ text_field('userUser', 'class': "form-control form-control-solid placeholder-no-fix form-group", 'value': userUser, 'autoComplete': 'off', 'required': 'required') }}
                                {% else %}
                                {{ text_field('userUser', 'class': "form-control form-control-solid placeholder-no-fix form-group", 'placeholder': 'Usuario', 'autoComplete': 'off', 'required': 'required') }}
                                {% endif %}                                    
                                </div>
                                <div class="col-xs-6">
                                    {{ password_field('userPassword', 'class': "form-control form-control-solid placeholder-no-fix form-group",'placeholder': 'Senha', 'autoComplete': 'off', 'required': 'required') }}
                                    <div class="forgot-password"> 
                                        <a href="javascript:;" id="forget-password" class="forget-password">Esqueceu sua senha?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                                        {{ check_field('remember', 'value': 'true') }} Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col-xs-6 text-right">
                                    {{ submit_button('Entrar', 'class': 'btn blue-madison') }}                                    
                                </div>
                            </div>
                        </form>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
                        {{ form('session/reset', 'class': 'forget-form') }}                        
                            <h3>Esqueceu sua senha?</h3>
                            <p> Insira seu e-mail abaixo para redefinir sua senha. </p>
                            <div class="form-group">
                                {{ email_field('userEmail', 'class': "form-control placeholder-no-fix form-group", 'autoComplete': 'off', 'required': 'required') }}
                            </div>
                            <div class="form-actions">
                                <button type="button" id="back-btn" class="btn blue-madison btn-outline">Voltar</button>
                                
                                {{ submit_button('Enviar', 'class': 'btn btn-success uppercase pull-right blue-madison') }}
                            </div>
                        </form>
                        <!-- END FORGOT PASSWORD FORM -->
                        <div class="row">
                                <div class="col-xs-12 login-message">
                                <div class="loader display-hide">
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                    <span class="loader-block"></span>
                                </div>
                                    {{ flash.output() }}                                 
                                </div>                                
                        </div>
                                               
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                               
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Desenvolvido por <a href="https://www.leoleao.ml"> Leonardo Leao</a> &copy; {{ date("Y") }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 {% endblock %}
