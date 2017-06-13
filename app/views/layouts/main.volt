        <div class="page-wrapper">

        <!-- BEGIN HEADER-->
            {% include "partials/topbar.volt" %}
        <!-- END HEADER-->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">

                <!-- BEGIN CONTENT-->
                <div class="page-content-wrapper">
                    {{ content() }}
                </div>
                <!-- END CONTENT -->

            </div>
            <!-- END CONTAINER -->

            <!-- BEGIN FOOTER -->
                {% include "partials/footer.volt" %}
            <!-- END FOOTER -->

            <!-- BEGIN QUICK BAR -->
                {% include "partials/quickbar.volt" %}
            <!-- END QUICK BAR -->

        </div><!--end #base-->
        <!-- END BASE -->
   