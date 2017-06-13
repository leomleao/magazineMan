{% extends 'index.volt' %}

{% block content %}
        <div id="content">
          	<div class="row">     
		        <section>
		          <div class="section-header">
		            <ol class="breadcrumb">
		              <li><a>{{ link_to('session', 'Pagina Inicial') }}</a></li>
		            </ol>
		          </div>
		          <div class="section-body contain-lg">
		            <div class="row">
		              <div class="col-lg-12 text-center">
		                <h1><span class="text-xxxl text-light">Oups 500<i class="fa fa-search-minus text-primary"></i></span></h1>
		                <h2 class="text-light">Pagina não encontrada ou sob manutenção</h2>
		                <p>{{ link_to('session', 'Home', 'class': 'btn ink-reaction btn-raised btn-primary') }}</p>
		              </div><!--end .col -->
		            </div><!--end .row -->
		          </div><!--end .section-body -->
		        </section>
            </div>
            <!-- /.section-body -->
        </div>
        <!-- /#content -->
{% endblock %}