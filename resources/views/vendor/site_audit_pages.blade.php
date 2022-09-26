@extends('layouts.vendor_internal_pages')
@section('content')
<div class="project-detail-body">
        <!-- Project Tabs Nav -->    


        <div class="white-box">
                <div class="uk-grid"> 
                <div class="uk-width-1-2@s">
                    <div class="heading mb-0">
                        <h2 class="mb-4 mb-10">All criticals</h2>
                        <h5 class="mb-0 mt-5 url">All Urls with critical errors.</h5>
                    </div>
                    </div>
                    <div class="uk-width-1-2@s">
                    <div class="download-options">
                        <div class="btn-group">
                            <a href="#" class="btn icon-btn color-red" uk-tooltip="title: Generate PDF File; pos: top-center"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/pdf-icon.png"></a>
                            <a href="#" class="btn icon-btn color-blue" uk-tooltip="title:Project Setting; pos: top-center"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/setting-icon.png"></a>
                            <a href="#" id="ShareKey" class="btn icon-btn color-purple" uk-tooltip="title: Generate Shared Key; pos: top-center"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/share-key-icon.png"></a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>


        <div class="uk-grid site-audit">
            <div class="uk-width-3-4@m mt-4">
                <div class="white-box px-0">
                    <div class="uk-grid px-30 border-bottom pb-3 uk-margin-remove">
                        <div class="uk-width-1-2@s uk-width-1-4@l uk-padding-remove-left">
                            <div class="search">
                                <form>
                                    <input type="text" placeholder="Search..." class="backlink_search">
                                    <button type="submit"><span uk-icon="icon: search" class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="search"><circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle><path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path></svg></span></button>
                                </form>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s uk-width-1-4@l uk-margin-auto-left uk-text-right">
                            <span class=""><a href="#" class="btn btn-md btn-border uk-box-shadow-small bg-white uk-text-medium"><i class="fas fa-file-csv"></i> <img src="images/csv.png" alt=""/> Export To CSV</a></span>
                        </div>
                    </div>
                    <div class="uk-grid mt-0"> 
                        <div class="uk-width-1-1@m">
                            <div class="audit-content">
                                <div class="audit-content-inner border-bottom px-30 py-30">
                                    <div class="uk-grid">
                                        <div>
                                            <p class="mb-0">https://kparser.com/account/checkout/?level=2</p>
                                            <small>Membership Checkout - Kparser</small>
                                        </div>
                                        <div class="uk-margin-auto-left"><a href="#" class="btn btn-xsm btn-border blue-btn-border"><i class="fa fa-file-text" aria-hidden="true"></i> Page Audit</a></div>
                                    </div>
                                    <div class="links mt-4">Links:
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/anchor-icon.png" alt="" /> Anchors: <span>17</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/internal-icon.png" alt="" /> Internal: <span>22</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/external-icon.png" alt="" /> External: <span>3</span></a>
                                    </div>

                                    <div class="color-messages mt-3">
                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>
                                    </div>
                                </div>
                                <div class="audit-content-inner border-bottom px-30 py-30">
                                    <div class="uk-grid">
                                        <div>
                                            <p class="mb-0">https://kparser.com/account/checkout/?level=2</p>
                                            <small>Membership Checkout - Kparser</small>
                                        </div>
                                        <div class="uk-margin-auto-left"><a href="#" class="btn btn-xsm btn-border blue-btn-border"><i class="fa fa-file-text" aria-hidden="true"></i> Page Audit</a></div>
                                    </div>
                                    <div class="links mt-4">Links:
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/anchor-icon.png" alt="" /> Anchors: <span>17</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/internal-icon.png" alt="" /> Internal: <span>22</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/external-icon.png" alt="" /> External: <span>3</span></a>
                                    </div>

                                    <div class="color-messages mt-3">
                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>
                                    </div>
                                </div>
                                <div class="audit-content-inner border-bottom px-30 py-30">
                                    <div class="uk-grid">
                                        <div>
                                            <p class="mb-0">https://kparser.com/account/checkout/?level=2</p>
                                            <small>Membership Checkout - Kparser</small>
                                        </div>
                                        <div class="uk-margin-auto-left"><a href="#" class="btn btn-xsm btn-border blue-btn-border"><i class="fa fa-file-text" aria-hidden="true"></i> Page Audit</a></div>
                                    </div>
                                    <div class="links mt-4">Links:
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/anchor-icon.png" alt="" /> Anchors: <span>17</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/internal-icon.png" alt="" /> Internal: <span>22</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/external-icon.png" alt="" /> External: <span>3</span></a>
                                    </div>

                                    <div class="color-messages mt-3">
                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>
                                    </div>
                                </div>
                                <div class="audit-content-inner border-bottom px-30 py-30">
                                    <div class="uk-grid">
                                        <div>
                                            <p class="mb-0">https://kparser.com/account/checkout/?level=2</p>
                                            <small>Membership Checkout - Kparser</small>
                                        </div>
                                        <div class="uk-margin-auto-left"><a href="#" class="btn btn-xsm btn-border blue-btn-border"><i class="fa fa-file-text" aria-hidden="true"></i> Page Audit</a></div>
                                    </div>
                                    <div class="links mt-3">Links:
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/anchor-icon.png" alt="" /> Anchors: <span>17</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/internal-icon.png" alt="" /> Internal: <span>22</span></a>
                                        <a href="#"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/external-icon.png" alt="" /> External: <span>3</span></a>
                                    </div>

                                    <div class="color-messages mt-3">
                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="critical-border">URL resolves under both HTTP and HTTPS</a></span> <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>                                        <span><a href="#" class="warning-border">Twitter card incomplete</a></span> <span><a href="#" class="notices-border">Open Graph tags incomplete</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-4@m filters mt-4">
                <h5 class="uk-text-medium">Filters</h5>
                <div class="heading">
                    <span>All Pages</span> <span class="uk-float-right">46</span>
                </div>
                <ul class="all-pages-con">
                    <li><span class="uk-text-medium">All Critical</span> <span class="no"><a href="#" class="light-red-bg">3</a></span></li>
                    <li><span>URL resolves under both HTTP.</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Redirect chains</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>4xx client errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>5xx server errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical is empty</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical to non-200</span> <span class="no"><a href="#">0</a></span></li> 
                </ul>


   <ul uk-accordion="collapsible: false">
    <li>
        <a class="uk-accordion-title" href="#"> Hide zero issues </a>
        <div class="uk-accordion-content">
        <ul class="all-pages-con">
                    <li><span class="uk-text-medium">All Warnings</span> <span class="no"><a href="#" class="light-orange-bg">12</a></span></li>
                    <li><span>URL resolves under both HTTP.</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Redirect chains</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>4xx client errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>5xx server errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical is empty</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical to non-200</span> <span class="no"><a href="#">0</a></span></li> 
                </ul>
        </div>
    </li>
    <li>
    <a class="uk-accordion-title" href="#"> Hide zero issues </a>
        <div class="uk-accordion-content">
        <ul class="all-pages-con">
                    <li><span class="uk-text-medium">All Notices</span> <span class="no"><a href="#" class="light-blue-bg">34</a></span></li>
                    <li><span>URL resolves under both HTTP.</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Redirect chains</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>4xx client errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>5xx server errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical is empty</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical to non-200</span> <span class="no"><a href="#">0</a></span></li> 
                </ul>
        </div>
    </li>
    <li>
    <a class="uk-accordion-title" href="#"> Hide zero issues </a>
        <div class="uk-accordion-content">
        <ul class="all-pages-con">
                    <li><span class="uk-text-medium">All Critical</span> <span class="no"><a href="#" class="light-blue-bg">34</a></span></li>
                    <li><span>URL resolves under both HTTP.</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Redirect chains</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>4xx client errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>5xx server errors</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical is empty</span> <span class="no"><a href="#">0</a></span></li>
                    <li><span>Canonical to non-200</span> <span class="no"><a href="#">0</a></span></li> 
                </ul>
        </div>
    </li>
</ul>


            </div>
        </div>
    </div>



@endsection