@extends('layouts.vendor_internal_pages')
@section('content')
<div class="audit-white-box mb-40">
            <div class="elem-flex">
                <div class="elem-start">
                    <div class="circle_percent hiddenOnLoad" data-percent="{{ $summaryTask['page_metrics']['onpage_score'] }}">
                        <div class="circle_inner">
                            <div class="round_per">
                            </div>
                        </div>
                    </div>
                    <div class="loader"></div>
                    <div class="score-for">
                        <h2><small>Website score for</small>{{ $summaryTask['domain_info']['name'] }}</h2>
                        <p><a href="#">How is it calculated?</a></p>
                        <ul>
                            <li>IP: {{ $summaryTask['domain_info']['ip'] }}</li>
                            <li>|</li>
                            <li>SSL: {{ $summaryTask['domain_info']['checks']['ssl'] == 1 ? "enabled": "N/A" }}</li>
                        </ul>
                        <a href="#" class="btn btn-sm blue-btn">View issues</a>
                    </div>
                </div>

                <div class="elem-end">
                    <div class="loader h-48 loader-text"></div>
                    <div class="btn-group">
                        <a href="#" class="btn icon-btn color-orange"
                            uk-tooltip="title: Refresh Report; pos: top-center">
                            <img src="{{URL::asset('public/vendor/internal-pages/images/refresh-yellow-icon.png')}}">
                        </a>
                        <a href="#" class="btn icon-btn color-red"
                            uk-tooltip="title: Generate PDF File; pos: top-center">
                            <img src="{{URL::asset('public/vendor/internal-pages/images/pdf-icon.png')}}">
                        </a>
                        <a href="#" class="btn icon-btn color-blue" uk-tooltip="title:Project Setting; pos: top-center">
                            <img src="{{URL::asset('public/vendor/internal-pages/images/setting-icon.png')}}">
                        </a>
                        <a href="#" id="ShareKey" class="btn icon-btn color-purple"
                            uk-tooltip="title: Generate Shared Key; pos: top-center">
                            <img src="{{URL::asset('public/vendor/internal-pages/images/share-key-icon.png')}}">
                        </a>
                    </div>

                    <article>
                        <div class="loader h-54 "></div>
                        <ul>
                            <li>
                                <div>Crawled pages</div>
                                <div>{{ $summaryTask['domain_info']['total_pages'] }}</div>
                            </li>
                            <li>
                                <div>Current crawling</div>
                                <div>{{ date('M d Y h:i A',strtotime($summaryTask['domain_info']['crawl_start'])) }}</div>
                            </li>
                            <li>
                                <div>Previous crawling</div>
                                <div>{{ date('M d Y h:i A',strtotime($summaryTask['domain_info']['crawl_end'])) }}</div>
                            </li>
                        </ul>
                        <div class="loader h-54 "></div>
                        <ul>
                            <li>
                                <div><img src="{{URL::asset('public/vendor/internal-pages/images/google-indexed-logo.png')}}"> Google indexed pages</div>
                                <div>{{ $summaryTask['domain_info']['total_pages'] - $nonidexTask['total_items_count'] }}</div>
                            </li>
                            <li>
                                <div><img src="{{URL::asset('public/vendor/internal-pages/images/google-safe-browsing-logo.png')}}"> Google safe browsing</div>
                                <div>{{ $summaryTask['domain_info']['checks']['ssl'] == 1 ? "Site is safe": "Site is not safe" }} </div>
                            </li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>

        <div class="audit-white-box mb-40 pa-0">
            <div class="audit-box-head">
            <div class="loader h-48 "></div>
                <h2>Site-level issues <small>(found 0)</small> <span
                        uk-tooltip="title: Site-level issues Here...; pos: top-left" class="fa fa-info-circle"></span>
                </h2>
            </div>
            <div class="audit-box-body">
            <div class="loader h-300-table"></div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                XML sitemap
                            </td>
                            <td>{{ $summaryTask['domain_info']['checks']['sitemap'] ==1 ? "Site has XML sitemap file" : "Site has not XML sitemap file" }}</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                Robots.txt
                            </td>
                            <td>{{ $summaryTask['domain_info']['checks']['robots_txt'] ==1 ? "Site has robots.txt" : "Site has not robots.txt" }}</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                Favicon
                            </td>
                            <td>{{ $summaryTask['page_metrics']['checks']['no_favicon'] ==0 ? "Site has a favicon" : "Site has not a favicon" }}</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                4XX pages
                            </td>
                            <td>{{ $summaryTask['page_metrics']['checks']['is_4xx_code'] ==0 ? "No 4XX pages" : "4XX error page exist" }}</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                HTTP and HTTPS
                            </td>
                            <td>{{ $summaryTask['page_metrics']['checks']['is_http'] ==0 ? "Working protocol redirect: HTTP to HTTPS" : "Not working protocol redirect: HTTP to HTTPS" }}</td>
                         
                        </tr>
                    </tbody>
                    <tbody class="table-collapseed">
                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                WWW and non-WWW
                            </td>
                            <td>{{ $summaryTask['page_metrics']['checks']['is_www'] ==0 ? "Working protocol redirect: HTTP to HTTPS" : "Not working protocol redirect: HTTP to HTTPS" }}</td>
                         
                        </tr>


                        <tr>
                            <td>
                                <img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}">
                                Google Safe Browsing
                            </td>
                            <td>{{ $summaryTask['domain_info']['checks']['ssl'] == 1 ? "Site is safe": "Site is not safe" }}</td>
                         
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="audit-box-foot">
            <div class="loader h-48 "></div>
                <a href="javascript:void(0);" class="show-more-issues"><span uk-icon="icon:triangle-down"></span> <span class="t">Show More</span></a>
            </div>
        </div>

        <div class="audit-white-box pa-0 hiddenOnLoad" id="PageLevelIssues">
            <div class="audit-box-head">
                <h2>Page-level issues <span uk-tooltip="title: Page-level issues Here...; pos: top-left"
                        class="fa fa-info-circle"></span>
                </h2>
            </div>
            <div class="audit-box-body">
                <div class="audit-stats">
                    <div class="audit-stats-box red">
                        <figure>
                            <img src="{{URL::asset('public/vendor/internal-pages/images/criticals-icon.png')}}">
                        </figure>
                        <h3>4217 <small>Criticals</small></h3>
                        <div class="number red">
                            <span uk-icon="icon: arrow-down"></span>
                            1
                        </div>
                    </div>
                    <div class="audit-stats-box yellow">
                        <figure>
                            <img src="{{URL::asset('public/vendor/internal-pages/images/warnings-icon.png')}}">
                        </figure>
                        <h3>7437 <small>Warnings</small></h3>
                        <div class="number red">
                            <span uk-icon="icon: arrow-down"></span>
                            33
                        </div>
                    </div>
                    <div class="audit-stats-box blue">
                        <figure>
                            <img src="{{URL::asset('public/vendor/internal-pages/images/notices-icon.png')}}">
                        </figure>
                        <h3>3267 <small>Notices</small></h3>
                        <div class="number green">
                            <span uk-icon="icon: arrow-up"></span>
                            13
                        </div>
                    </div>
                </div>

                <div class="audit-issues">
                    <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .auditIssuesContainer">
                        <li><a href="#">All Issues</a></li>
                        <li><a href="#">Critical Errors</a></li>
                        <li><a href="#">Warnings</a></li>
                        <li><a href="#">Notices</a></li>
                        <li><a href="#">Zero Issues</a></li>
                    </ul>
                    <div class="content">
                        <p>Here is a list of all technical issues Agency Dashboard has found on the website. Start fix
                            them
                            step by step from the most critical errors to less important. When you finished fixing
                            issues,
                            recrawl the website to make sure Website Score is up.</p>
                    </div>
                    <div class="tab-content ">
                        <div class="uk-switcher auditIssuesContainer">
                            <!-- Tab 1 All Issues -->
                            <div>
                                <table>
                                    <!-- critical Errors -->    
                                    <tr>
                                        <td class="issue-type critical">Noscript in head contains invalid HTML elements:*</td>
                                        <td>15 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type critical">HTTPS page has internal links to HTTP:</td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['https_to_http_links'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type critical">Title duplicates</td>
                                        <td>{{ $summaryTask['page_metrics']['duplicate_title'] }}  pages</td>
                                        <td><i class="icon ion-arrow-up-a"></i> 2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type critical">Redirect chains</td>
                                        <td>{{ $summaryTask['page_metrics']['redirect_loop'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 6</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type critical">Page has broken JavaScript files: *</td>
                                        <td>15 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 6</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <!-- Warning Errors -->
                                    <tr>
                                        <td class="issue-type warnings">Open Graph URL not matching canonical:*</td>
                                        <td>65 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 7</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type warnings">Missing alt text:*</td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type warnings">Page has no outgoing links:</td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['has_links_to_redirects'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">Twitter card incomplete: </td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">Open Graph tags incomplete:*</td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td class="issue-type warnings">Description duplicates: </td>
                                        <td>{{ $summaryTask['page_metrics']['duplicate_description'] }}  pages</td> 
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">Description is missing: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['no_description'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">H1 duplicates: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['no_h1_tag'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">Canonical is missing: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['canonical_to_broken'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">4xx redirects:</td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['is_4xx_code'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td class="issue-type warnings">CSS file size is over 15 KB:* </td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">Image size is over 100 KB:* </td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td class="issue-type warnings">JavaScript file size is over 25 KB:* </td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Twitter card missing:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Open Graph tags missing:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">HTTP page has internal links to HTTPS:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">H1 too short:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">PDF files:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Images:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">External linking: </td>
                                        <td>{{ $summaryTask['page_metrics']['links_external'] }}  pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Text to code ratio < 10%: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['low_content_rate'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">H1 = Title:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">H1 too long:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">More than one h1 on page:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Long URLs: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['seo_friendly_url_relative_length_check'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Non-HTML URLs:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Title too short: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['title_too_short'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Title too long: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['title_too_long'] }}  pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                     
                                    <tr>
                                        <td class="issue-type notices">Canonical ≠ URL: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['canonical_chain'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Meta nofollow pages:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Meta noindex pages:* </td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Non-indexable pages: </td>
                                        <td>{{ $summaryTask['domain_info']['total_pages'] - ($summaryTask['domain_info']['total_pages'] - $nonidexTask['total_items_count']) }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="issue-type notices">Indexable pages: </td>
                                        <td>{{ $summaryTask['domain_info']['total_pages'] - $nonidexTask['total_items_count'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                      
                                    <tr>
                                        <td class="issue-type notices">5xx Pages: </td>
                                        <td>{{ $summaryTask['page_metrics']['checks']['is_5xx_code'] }} pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                
                                    <tbody class="table-audit-collapseed">
                                        <tr>
                                            <td class="issue-type zero-error"> Page has empty src attributes:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Page has broken CSS files:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Page has broken images: </td>
                                            <td>{{ $summaryTask['page_metrics']['broken_resources'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Orphan URLs: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['is_orphan_page'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> 302 redirects: </td>
                                            <td>{{ $summaryTask['domain_info']['canonicalization_status_code'] }}  pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> 3xx other redirects: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['is_redirect'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> H1 is missing: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['no_h1_tag'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="issue-type zero-error"> Disallowed by robots.txt: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Canonical is empty: </td>
                                            <td>{{ $summaryTask['domain_info']['total_pages'] - $summaryTask['page_metrics']['checks']['canonical'] }}  pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Canonical to non-200:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Title is missing/Empty: </td>
                                            <td>$summaryTask['page_metrics']['checks']['no_title'] pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="issue-type zero-error"> H1 is empty: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['no_h1_tag'] }}  pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Description is empty: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['no_description'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                            </td>
                                        </tr>
                                      
                                        <tr>
                                            <td class="issue-type zero-error"> Duplicate content pages: </td>
                                            <td>$summaryTask['page_metrics']['checks']['duplicate_content'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> Page has nofollow outgoing internal links:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> HTTPS to HTTP redirect: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['https_to_http_links'] }}  pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error"> HTTP to HTTPS redirect: </td>
                                            <td>{{ $summaryTask['domain_info']['checks']['test_https_redirect'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">High waiting Time: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['high_waiting_time'] }} 25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="issue-type zero-error">High Loading Time: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['high_loading_time'] }} 25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="issue-type zero-error">Meta refresh redirect:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="issue-type zero-error">Canonical from HTTP to HTTPS:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Canonical from HTTPS to HTTP:* </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="issue-type zero-error">Low content pages: </td>
                                            <td>{{ $summaryTask['page_metrics']['checks']['low_content_rate'] }} pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="issue-type zero-error">More than three parameters in URL: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Hreflang annotation invalid: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">HTTP URL contains a password input field: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">X-default hreflang annotation missing: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Has link with a URL referencing LocalHost or 127.0.0.1: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">More than one page for same language in hreflang: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Has link with a URL referencing a local or UNC file path: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">URL receives both follow and nofollow internal links: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Page referenced for more than one language in hreflang: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">HTTPS page links to HTTP CSS: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Canonical is a relative URL: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">HTTPS page links to HTTP JavaScript: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Has outgoing hreflang annotations using relative URLs: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">HTTPS page links to HTTP image: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Hreflang defined but HTML lang missing: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Mismatched hreflang and HTML lang declarations: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Self-reference hreflang annotation missing: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Mismatched canonical tag in HTML and HTTP header: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Double slash in URL: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Not all pages from hreflang group were crawled: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Meta robots found outside of <head>: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Hreflang to non-canonical: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Has a link with whitespace in href attribute: </td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="issue-type zero-error">Hreflang and HTML lang mismatch:</td>
                                            <td>25 pages</td>
                                            <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                        class="fa fa-question-circle" aria-hidden="true"></i> How to
                                                    fix</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="audit-box-foot">
                                    <a href="javascript:void(0);" class="show-more-audit-issues"><span
                                            uk-icon="icon:triangle-down"></span> <span class="t">Show More</span></a>
                                </div>
                            </div>
                            <!-- Tab 1 All Issues End -->

                            <!-- Tab 2 Critical -->
                            <div>
                                <table>
                                    <tr>
                                        <td class="issue-type critical">Canonical</td>
                                        <td>15 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type critical">Title duplicates</td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-up-a"></i> 2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type critical">Meta Tag duplicates</td>
                                        <td>15 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 6</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Tab 2 Critical End -->

                            <!-- Tab 3 Warnings -->
                            <div>
                                <table>
                                    <tr>
                                        <td class="issue-type warnings">Description duplicate</td>
                                        <td>65 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 7</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type warnings">Missing Image alt text</td>
                                        <td>5 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 14</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Tab 3 Warnings End -->

                            <!-- Tab 4 Notices -->
                            <div>
                                <table>
                                    <tr>
                                        <td class="issue-type notices">Missing Image title text</td>
                                        <td>25 pages</td>
                                        <td><i class="icon ion-arrow-down-a"></i> 84</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type notices">SEO Friendly URL</td>
                                        <td>2 pages</td>
                                        <td><i class="icon ion-arrow-up-a"></i> 23</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="issue-type notices">Title too short</td>
                                        <td>7 pages</td>
                                        <td><i class="icon ion-arrow-up-a"></i> 8</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Tab 4 Notices End -->

                            <!-- Tab 5 Zero Issues -->
                            <div></div>
                            <!-- Tab 5 Zero Issues End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection