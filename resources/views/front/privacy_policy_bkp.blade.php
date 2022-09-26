@extends('layouts.pages_layout')
@section('content')
<section id="introduction" class="relative center white bg-dark-gray gradient-1 overflow-hidden" style="height:auto;">
    <!--<canvas id="spiders" class="hidden-xs" ></canvas>-->
    <div id="particles-js">
        <canvas width="1349" height="900" style="width: 100%; height: 100%;"></canvas>
    </div>
    <header class="container mt2 mb2" style="position:relative;z-index:2;">
        <div class="table">
            <div class="table-cell text-center">
                <a class="mt2 mb2" href="/" title="SEO Reports" style="display:inline-block;"><img id="badge" class="2x" src="{{URL::asset('/public/front/images/logo-new.png')}}" /></a>
            </div>
        </div>
    </header>
</section>
<!-- Section Powerful features -->
<section class="py4 dark-gray bg-white  overflow-hidden full-width-2 feature-section ">
    <div class="container">
        <h2 class="wow fadeInUp center" data-wow-duration="1.1s">Privacy Policy</h2>
        <p>AgencyDashboard.io is committed to protecting our users best interest including their privacy.
            <br>
            <br> All the information and data received and made available by you is strictly private. In no manner will our company sell, rent or share these information to any other parties other than AgencyDashboard.io or/and its subsidiaries.
            <br>
            <br> All the information and data that is available is for the purpose of our website. It is and shall be used in such a way that our services and products can be improved for you, our users' benefit.
            <br>
            <br> Our website contain links to other websites. We are not to be made responsible for our users' privacy on any other site other than ours..</p>

            <h3>Google Analytics</h3>
            <p>We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.

                These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.

                <br><br>
                We may use third-party Service Providers to monitor and analyze the use of our Service.
                <br><br>
                Google Analytics is a web analytics service offered by Google that tracks and reports website traffic. Google uses the data collected to track and monitor the use of our Service. This data is shared with other Google services. Google may use the collected data to contextualize and personalize the ads of its own advertising network.
                <br><br>
                You can opt-out of having made your activity on the Service available to Google Analytics by installing the Google Analytics opt-out browser add-on. The add-on prevents the Google Analytics JavaScript (ga.js, analytics.js, and dc.js) from sharing information with Google Analytics about visits activity.
                <br><br>
                For more information on the privacy practices of Google, please visit the Google Privacy & Terms web page: <a href="http://www.google.com/intl/en/policies/privacy">http://www.google.com/intl/en/policies/privacy/</a>

            </p>
            <h3>Refund Policy</h3>
            <p>If you are not 100% satisfied with your purchase, within 30 days from the purchase date, we will fully refund the cost of your order if you have not used the system or the system is faulty.</p>
        </div>
    </section>
    <!-- # End Section  -->
    <section id="section-beta" class="center py2 lighter-gray gradient-1 clearfix">
        <div class="container">
            <div class="clearfix">
                <div class="relative col col-12 text-center">
                    <div class=" mt3 mb2">
                        <div class="mt0 mb2 py1 wow fadeInUp" data-wow-duration="1.1s">
                            <h3 class="h4 mt1 bold white">Get started with AgencyDashboard.io</h3>
                            <ul class="list-reset">
                                <li class="inline-block">
                                    <a href="{{url('/register')}}" class="open-popup mt2 mr1 fw300 py1 button cta cta-green no-scale rounded drop-target"> <span class="caps h5 bold block">Sign Up </span> <em class="h6"></em> </a>
                                </li>
                                <li class="inline-block">
                                    <a href="{{url('/login')}}" class="mt2 fw300 py1 button cta cta-blue no-scale rounded"> <span class="caps h5 bold block">Login</span> <em class="h6"></em> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="center mt2 p1 dark-gray bg-white">
        <div class="container clearfix ">
            <div class="col col-12">
                <p class="center p1 h5 mid-gray">&copy; 2020, AgencyDashboard.io. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    @endsection