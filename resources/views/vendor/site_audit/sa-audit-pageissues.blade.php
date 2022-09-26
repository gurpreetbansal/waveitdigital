<div class="audit-box-head">
    <h2>Page-level issues 
        <span uk-tooltip="title: It displays a comprehensive list of technical issues spotted on different pages of your site.; pos: top-left" class="fa fa-info-circle"></span> 
    </h2>
</div>
<div class="audit-box-body">
    <div class="audit-stats">
        <a href="javascript:;" class="sa-viewPages" data-id="{{$auditTask->task_id}}" data-filter="critical" >
            <div class="audit-stats-box red">
                <figure>
                    <img src="{{URL::asset('public/vendor/internal-pages/images/criticals-icon.png')}}">
                </figure>
                <h3>
                    {{ array_sum($errorsListing['critical']) }}
                    <small>Criticals</small>
                </h3>
                <i class="fa fa-long-arrow-right"></i>
                
            </div>
        </a>
        <a href="javascript:;" class="sa-viewPages" data-id="{{$auditTask->task_id}}" data-filter="warning" >
            <div class="audit-stats-box yellow">
                <figure>
                    <img src="{{URL::asset('public/vendor/internal-pages/images/warnings-icon.png')}}">
                </figure>
                <h3>
                    {{ array_sum($errorsListing['warning']) }}
                    <small>Warnings</small>
                </h3>
                <i class="fa fa-long-arrow-right"></i>
                
            </div>
        </a>
        <a href="javascript:;" class="sa-viewPages" data-id="{{$auditTask->task_id}}" data-filter="notices" >
            <div class="audit-stats-box blue">
                <figure>
                    <img src="{{URL::asset('public/vendor/internal-pages/images/notices-icon.png')}}">
                </figure>
                <h3>{{ array_sum($errorsListing['notices']) }} <small>Notices</small></h3>
                <i class="fa fa-long-arrow-right"></i>
                
            </div>
        </a>
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
            <p>Here is a list of all technical issues Agency Dashboard has found on the website. Start fix them step by step from the most critical errors to less important. When you finished fixing issues, recrawl the website to make sure Website Score is up.</p>
        </div>

        <?php
        $CriticalErrors =  $zerolErrors = $warningErrors = $noticesErrors = '';
        $issuebreakcount = 0;
        ?>
        <div class="tab-content ">
            <div class="uk-switcher auditIssuesContainer">
                <!-- Tab 1 All Issues -->
                <div>
                    <table>
                        <tbody>
                            @foreach($errorsListing['critical'] as $keyName => $valueName)
                                
                                @if($valueName > 0)

                                @if($issuebreakcount == 15)

                                    <tr>
                                        <td colspan="4" class="pa-0">
                                            <div class="table-audit-collapseed" style="display: none;">
                                                <table>
                                                    <tbody>
                                @endif

                                <?php 
                                   $pages = $valueName == 1 ? 'page' : 'pages';
                                   ?>
                                <tr>
                                    <td class="issue-type critical">
                                        <a href="javascript:;" class="sa-viewPages" data-id="{{$auditTask->task_id}}" data-filter="{{ $keyName }}" >{{ $auditLevel[$keyName] }} </a>
                                    </td>
                                    <td>{{ $valueName }} {{ $pages }} </td>
                                    <td>  </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror"
                                        data-type="critical" data-value="{{ $keyName }}"
                                        uk-toggle="target: #offcanvas-flip"><i class="fa fa-question-circle"
                                        aria-hidden="true"></i> How to fix</a>
                                    </td>
                                </tr>
                                <?php   $issuebreakcount++; 
                                $CriticalErrors .= '<tr><td class="issue-type critical"><a href="javascript:;" class="sa-viewPages" data-id="'. $auditTask->task_id .'  data-filter="'. $keyName .'" >' . trim($auditLevel[$keyName])  .'</a></td><td>'. $valueName .' '.$pages.'</td><td></td> <td> <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="critical" data-value="'.$keyName.'" uk-toggle="target: #offcanvas-flip" ><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a></td> </tr>';
                                ?> 
                                @else
                                    <?php
                                    $zeroValue  = ($valueName)?$valueName:'0';
                                    $zerolErrors .= '<tr><td class="issue-type zero-error">'. $auditLevel[$keyName] .'</td><td>'. $zeroValue .' pages</td><td></td> <td> <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="critical" data-value="'.$keyName.'" uk-toggle="target: #offcanvas-flip" ><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a></td> </tr>';
                                    ?>

                                @endif
                              
                            @endforeach 

                            @foreach($errorsListing['warning'] as $keyName => $valueName)
                                

                                @if($valueName > 0)
                                @if($issuebreakcount == 15)

                                    <tr>
                                        <td colspan="4" class="pa-0">
                                            <div class="table-audit-collapseed" style="display: none;">
                                                <table>
                                                    <tbody>
                                @endif

                                  <?php 
                                   $pages = $valueName == 1 ? 'page' : 'pages';
                                   ?>
                                   <tr>
                                        <td class="issue-type warnings">
                                            <a href="javascript:;" class="sa-viewPages" data-id="{{$auditTask->task_id}}" data-filter="{{ $keyName }}" >{{ $auditLevel[$keyName] }} </a> 
                                        </td>
                                        <td>{{ $valueName }} {{ $pages }} </td>
                                        <td></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="warning" data-value="{{ $keyName }}" uk-toggle="target: #offcanvas-flip"><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a>
                                        </td>
                                    
                                    </tr>
                                    <?php   $issuebreakcount++;
                                    $warningErrors .= '<tr><td class="issue-type warnings"><a href="javascript:;" class="sa-viewPages" data-id="'. $auditTask->task_id .'  data-filter="'. $keyName .'">' . $auditLevel[$keyName]  .'</a></td><td>'.  $valueName .' '.$pages .'  </td><td></td> <td> <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="warning" data-value="'. $keyName .'" uk-toggle="target: #offcanvas-flip" ><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a></td> </tr>';
                                    ?>
                                @else
                                    <?php
                                    $zeroValue  = ($valueName)?$valueName:'0';
                                    $zerolErrors .= '<tr><td class="issue-type zero-error">'. $auditLevel[$keyName] .'</td><td>'. $zeroValue .' pages</td><td></td> <td> <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="warning" data-value="'. $keyName .'" uk-toggle="target: #offcanvas-flip" ><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a></td> </tr>';
                                    ?>
                                @endif
                               
                            @endforeach

                            @foreach($errorsListing['notices'] as $keyName => $valueName)
                                

                                @if($valueName > 0)
                                @if($issuebreakcount == 15)
                                <tr>
                                    <td colspan="4" class="pa-0">
                                        <div class="table-audit-collapseed" style="display: none;">
                                            <table>
                                                <tbody>
                                @endif

                                <?php 
                                
                               $pages = $valueName == 1 ? 'page' : 'pages';
                               ?>
                               <tr>
                                    <td class="issue-type notices">
                                        <a href="javascript:;" class="sa-viewPages" data-id="{{$auditTask->task_id}}" data-filter="{{ $keyName }}" >{{ $auditLevel[$keyName] }} </a> 
                                    </td>
                                    <td>{{ $valueName }} {{ $pages }}</td>
                                    <td></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror"
                                        data-type="notices" data-value="{{ $keyName }}"
                                        uk-toggle="target: #offcanvas-flip"><i class="fa fa-question-circle"
                                        aria-hidden="true"></i> How to fix</a>
                                    </td>
                                </tr>
                                <?php   $issuebreakcount++;
                                $noticesErrors .= '<tr><td class="issue-type notices"><a href="javascript:;" class="sa-viewPages" data-id="'. $auditTask->task_id .' data-filter="'. $keyName .'">' . $auditLevel[$keyName]  .'</a></td><td>'. $valueName .' '.$pages .' </td><td></td> <td> <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="notices" data-value="'. $keyName .'" uk-toggle="target: #offcanvas-flip" ><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a></td> </tr>';
                                ?>
                                @else
                                <?php
                                $zeroValue  = ($valueName)?$valueName:'0';
                                $zerolErrors .= '<tr><td class="issue-type zero-error">'. $auditLevel[$keyName] .'</td><td>'. $zeroValue .'  pages</td><td></td> <td> <a href="#" class="btn btn-sm btn-border blue-btn-border sidedrawererror" data-type="notices" data-value="'. $keyName .'" uk-toggle="target: #offcanvas-flip" ><i class="fa fa-question-circle" aria-hidden="true"></i> How to fix</a></td> </tr>';
                                ?>
                                @endif
                                
                            @endforeach

                            {!! $zerolErrors !!}
                            
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                               
                        </tbody>
                    </table>
                    <div class="audit-box-foot">
                        <a href="javascript:void(0);" class="show-more-audit-issues"><span uk-icon="icon:triangle-down"></span> <span class="t">Show More</span></a>
                    </div>     
                </div>
                <!-- Tab 1 All Issues End -->

                <!-- Tab 2 Critical -->
                <div>
                    <table>
                        {!! $CriticalErrors !!}
                    </table>
                </div>
                <!-- Tab 2 Critical End -->

                <!-- Tab 3 Warnings -->
                <div>
                    <table>

                        {!! $warningErrors !!}

                    </table>
                </div>
                <!-- Tab 3 Warnings End -->

                <!-- Tab 4 Notices -->
                <div>
                    <table>

                        {!! $noticesErrors !!}


                    </table>
                </div>
                <!-- Tab 4 Notices End -->

                <!-- Tab 5 Zero Issues -->
                <div>
                    <table>
                        {!! $zerolErrors !!}
                    </table>

                </div>
                <!-- Tab 5 Zero Issues End -->
            </div>
        </div>
    </div>
</div>