@extends('layouts.main_layout')
@section('content')

<div class="pricingSection">
	<div class="white-layer"></div>
	<div class="m-white-layer"></div>
    <div class="container">

        <div class="pricingTable">
            <div class="d-none d-lg-block">
                <table>
                    <thead>
                        <tr>
                            <th>
                                <h1>Plans & Pricing</h1>
                                <div class="d-flex align-items-center">
                                    <label class="sw">
                                        <input id="pay_annually" name="pay_annually" type="checkbox">
                                        <div class="sw-pan"></div>
                                        <div class="sw-btn"></div>
                                    </label>
                                    <label for="pay_annually">Pay annually</label>
                                </div>
                                <p>*14 days trial</p>
                                <p>**Credit card required</p>
                            </th>
                            <th>
                                <h3>Freelancer</h3>
                                <div class="priceAmount">
                                    <big>$49/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </th>
                            <th>
                                <h3>Agency</h3>
                                <div class="priceAmount">
                                    <big>$149/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </th>
                            <th>
                                <h3>Agency Plus</h3>
                                <div class="priceAmount">
                                    <big>$249/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </th>
                            <th>
                                <h3>Enterprise</h3>
                                <div class="priceAmount">
                                    <big>$399/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5">
                                <h6>Project Features</h6>
                            </td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Each projects represents one of your clients">Projects</span>
                            </td>
                            <td>5</td>
                            <td>15</td>
                            <td>30</td>
                            <td>50</td>
                        </tr>
                        <tr class="odd onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="One keyword counts towards all of the ranking sources your account has enabled">Keywords to track (with daily updates)</span>
                            </td>
                            <td>500</td>
                            <td>1500</td>
                            <td>2500</td>
                            <td>4000</td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="The ability to track mobile rankings in Position tracking tool.">Mobile rankings</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="odd onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="The total number of keywords that can be tracked for all your projects simultaneously using the Position Tracking tool.">Daily Rank Tracking</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Competitive and Keyword Research">Competitive and Keyword Research</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="odd onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="The maximum number of pages you can crawl for your Site Audit campaign per audit.">Pages to crawl per project</span>
                            </td>
                            <td>50</td>
                            <td>100</td>
                            <td>150</td>
                            <td>150</td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Configure campaigns to match your clients brand with campaign white labeling.">White Label Dashboard</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="odd onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Choose from the top SEO, PPC, GMB, Analytics, and other Integrations">Access to 50+ Integrations</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Schedule unlimited number of reports to be automatically generated and sent in PDF format to multiple email addresses on a regular basis.">Scheduled PDF reports</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="odd onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Additional add-ons credits to each plan.">Additional Website Audit report credits</span>
                                <br> **1 Credit per page
                            </td>
                            <td>500</td>
                            <td>1500</td>
                            <td>3000</td>
                            <td>4000</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="5">
                                <h6>Agency Management</h6>
                            </td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Create as many staff or client accounts with no additional charge.">User Access</span>
                            </td>
                            <td>unlimited</td>
                            <td>unlimited</td>
                            <td>unlimited</td>
                            <td>unlimited</td>
                        </tr>
                        <tr class="odd onHover">
                            <td>Sharing with "edit" access with team members</td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="even onHover">
                            <td>Sharing with "read-only" access with clients</td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="odd onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="GMB Dashboard">GMB Dashboard Integration</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                                <td><i class="fa fa-check"></i></td>
                        </tr>
                        <tr class="even onHover">
                            <td>
                                <span data-toggle="tooltip" data-placement="left" title="" data-original-title="Google Ads Dashboard">Google Ads Dashboard Integration</span>
                            </td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-lg-none">
                <div class="m-pricing">
                    <div class="head">
                        <h1>Plans & Pricing</h1>
                        <div class="d-flex align-items-center">
                            <label class="sw">
                                <input id="pay_annually" name="pay_annually" type="checkbox">
                                <div class="sw-pan"></div>
                                <div class="sw-btn"></div>
                            </label>
                            <label for="pay_annually">Pay annually</label>
                        </div>
                        <p>*14 days trial</p>
                        <p>**Credit card required</p>
                    </div>

                    <div class="nav nav-tabs m-pricing-tab" id="m-pricing-tab" role="tablist">
                        <a class="active" id="nav-freelancer-tab" data-toggle="tab" href="#nav-freelancer" role="tab" aria-controls="nav-freelancer" aria-selected="true">Freelancer</a>
                        <a id="nav-agency-tab" data-toggle="tab" href="#nav-agency" role="tab" aria-controls="nav-agency" aria-selected="false">Agency</a>
                        <a id="nav-agencyPlus-tab" data-toggle="tab" href="#nav-agencyPlus" role="tab" aria-controls="nav-agencyPlus" aria-selected="false">Agency Plus</a>
                        <a id="nav-enterprise-tab" data-toggle="tab" href="#nav-enterprise" role="tab" aria-controls="nav-enterprise" aria-selected="false">Enterprise</a>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-freelancer" role="tabpanel" aria-labelledby="nav-freelancer-tab">
                            <table>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Project Features</h6>
                                        </td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Each projects represents one of your clients">Projects</span>
                                        </td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="odd onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="One keyword counts towards all of the ranking sources your account has enabled">Keywords to track (with daily updates)</span>
                                        </td>
                                        <td>500</td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The ability to track mobile rankings in Position tracking tool.">Mobile rankings</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="odd onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The total number of keywords that can be tracked for all your projects simultaneously using the Position Tracking tool.">Daily Rank Tracking</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Competitive and Keyword Research">Competitive and Keyword Research</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="odd onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The maximum number of pages you can crawl for your Site Audit campaign per audit.">Pages to crawl per project</span>
                                        </td>
                                        <td>50</td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Configure campaigns to match your clients brand with campaign white labeling.">White Label Dashboard</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="odd onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Choose from the top SEO, PPC, GMB, Analytics, and other Integrations">Access to 50+ Integrations</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Schedule unlimited number of reports to be automatically generated and sent in PDF format to multiple email addresses on a regular basis.">Scheduled PDF reports</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="odd onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Additional add-ons credits to each plan.">Additional Website Audit report credits</span>
                                            <br> **1 Credit per page
                                        </td>
                                        <td>500</td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Agency Management</h6>
                                        </td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Create as many staff or client accounts with no additional charge.">User Access</span>
                                        </td>
                                        <td>unlimited</td>
                                    </tr>
                                    <tr class="odd onHover">
                                        <td>Sharing with "edit" access with team members</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>Sharing with "read-only" access with clients</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="odd onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="GMB Dashboard">GMB Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="even onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Ads Dashboard">Google Ads Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="sticky-price">
                                <div class="priceAmount">
                                    <big>$49/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-agency" role="tabpanel" aria-labelledby="nav-agency-tab">
                            <table>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Project Features</h6>
                                        </td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Each projects represents one of your clients">Projects</span>
                                        </td>
                                        <td>15</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="One keyword counts towards all of the ranking sources your account has enabled">Keywords to track (with daily updates)</span>
                                        </td>
                                        <td>1500</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The ability to track mobile rankings in Position tracking tool.">Mobile rankings</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The total number of keywords that can be tracked for all your projects simultaneously using the Position Tracking tool.">Daily Rank Tracking</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Competitive and Keyword Research">Competitive and Keyword Research</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The maximum number of pages you can crawl for your Site Audit campaign per audit.">Pages to crawl per project</span>
                                        </td>
                                        <td>100</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Configure campaigns to match your clients brand with campaign white labeling.">White Label Dashboard</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Choose from the top SEO, PPC, GMB, Analytics, and other Integrations">Access to 50+ Integrations</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Schedule unlimited number of reports to be automatically generated and sent in PDF format to multiple email addresses on a regular basis.">Scheduled PDF reports</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Additional add-ons credits to each plan.">Additional Website Audit report credits</span>
                                            <br> **1 Credit per page
                                        </td>
                                        <td>1500</td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Agency Management</h6>
                                        </td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Create as many staff or client accounts with no additional charge.">User Access</span>
                                        </td>
                                        <td>unlimited</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>Sharing with "edit" access with team members</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>Sharing with "read-only" access with clients</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="GMB Dashboard">GMB Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Ads Dashboard">Google Ads Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="sticky-price">
                                <div class="priceAmount">
                                    <big>$149/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-agencyPlus" role="tabpanel" aria-labelledby="nav-agencyPlus-tab">
                            <table>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Project Features</h6>
                                        </td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Each projects represents one of your clients">Projects</span>
                                        </td>
                                        <td>30</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="One keyword counts towards all of the ranking sources your account has enabled">Keywords to track (with daily updates)</span>
                                        </td>
                                        <td>2500</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The ability to track mobile rankings in Position tracking tool.">Mobile rankings</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The total number of keywords that can be tracked for all your projects simultaneously using the Position Tracking tool.">Daily Rank Tracking</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Competitive and Keyword Research">Competitive and Keyword Research</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The maximum number of pages you can crawl for your Site Audit campaign per audit.">Pages to crawl per project</span>
                                        </td>
                                        <td>150</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Configure campaigns to match your clients brand with campaign white labeling.">White Label Dashboard</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Choose from the top SEO, PPC, GMB, Analytics, and other Integrations">Access to 50+ Integrations</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Schedule unlimited number of reports to be automatically generated and sent in PDF format to multiple email addresses on a regular basis.">Scheduled PDF reports</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Additional add-ons credits to each plan.">Additional Website Audit report credits</span>
                                            <br> **1 Credit per page
                                        </td>
                                        <td>3000</td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Agency Management</h6>
                                        </td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Create as many staff or client accounts with no additional charge.">User Access</span>
                                        </td>
                                        <td>unlimited</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>Sharing with "edit" access with team members</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>Sharing with "read-only" access with clients</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="GMB Dashboard">GMB Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Ads Dashboard">Google Ads Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="sticky-price">
                                <div class="priceAmount">
                                    <big>$249/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-enterprise" role="tabpanel" aria-labelledby="nav-enterprise-tab">
                            <table>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Project Features</h6>
                                        </td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Each projects represents one of your clients">Projects</span>
                                        </td>
                                        <td>50</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="One keyword counts towards all of the ranking sources your account has enabled">Keywords to track (with daily updates)</span>
                                        </td>
                                        <td>4000</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The ability to track mobile rankings in Position tracking tool.">Mobile rankings</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The total number of keywords that can be tracked for all your projects simultaneously using the Position Tracking tool.">Daily Rank Tracking</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Competitive and Keyword Research">Competitive and Keyword Research</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="The maximum number of pages you can crawl for your Site Audit campaign per audit.">Pages to crawl per project</span>
                                        </td>
                                        <td>150</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Configure campaigns to match your clients brand with campaign white labeling.">White Label Dashboard</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Choose from the top SEO, PPC, GMB, Analytics, and other Integrations">Access to 50+ Integrations</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Schedule unlimited number of reports to be automatically generated and sent in PDF format to multiple email addresses on a regular basis.">Scheduled PDF reports</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Additional add-ons credits to each plan.">Additional Website Audit report credits</span>
                                            <br> **1 Credit per page
                                        </td>
                                        <td>4000</td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <h6>Agency Management</h6>
                                        </td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Create as many staff or client accounts with no additional charge.">User Access</span>
                                        </td>
                                        <td>unlimited</td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>Sharing with "edit" access with team members</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>Sharing with "read-only" access with clients</td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="GMB Dashboard">GMB Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                    <tr class="onHover">
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Ads Dashboard">Google Ads Dashboard Integration</span>
                                        </td>
                                        <td><i class="fa fa-check"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="sticky-price">
                                <div class="priceAmount">
                                    <big>$399/</big><small>mo</small>
                                </div>
                                <a href="javascript:;">
                                    <button type="button" class="btn btn-blue">Start Trial</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="free-price">
            <div class="left">
                <h3>Free Forever</h3>
                <ul>
                    <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Each campaign represents one of your clients">
                        1 Campaigns
                    </li>
                    <li data-toggle="tooltip" data-placement="left" title="" data-original-title="One keyword counts towards all of the ranking sources your account has enabled">
                        50 Keyword Rankings
                    </li>
                </ul>
                <p>For startup & Small business</p>
                <a href="javascript:;"><button type="button" class="btn pricing-btn">Start Now</button></a>
                <p><small>*No credit card required</small></p>
            </div>
            <div class="right">
                <h6>Features included</h6>
                <div class="d-flex">
                    <ul>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="The ability to track mobile rankings in Position tracking tool.">Mobile rankings</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="The total number of keywords that can be tracked for all your projects simultaneously using the Position Tracking tool.">Daily Rank Tracking</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Competitive and Keyword Research">Competitive and Keyword Research</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="The maximum number of pages you can crawl for your Site Audit campaign per audit.">50 Pages to crawl per project</li>
                    </ul>
                    <ul>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Configure campaigns to match your clients brand with campaign white labeling.">White Label Dashboard</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Choose from the top SEO, PPC, GMB, Analytics, and other Integrations">Access to 50+ Integrations</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Schedule unlimited number of reports to be automatically generated and sent in PDF format to multiple email addresses on a regular basis.">Scheduled PDF reports</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Additional add-ons credits to each plan.">500 Additional Website Audit report credits</li>
                    </ul>
                    <ul>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Create as many staff or client accounts with no additional charge.">Unlimited User Access</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="SEO Dashboard">SEO Dashboard</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="Google Ads Dashboard">Google Ads Dashboard</li>
                        <li data-toggle="tooltip" data-placement="left" title="" data-original-title="GMB Dashboard">GMB Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection