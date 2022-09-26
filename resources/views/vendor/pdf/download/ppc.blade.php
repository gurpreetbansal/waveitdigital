<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 PDF File Download using JQuery Ajax Request Example</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style type="text/css">
	.container {
	    max-width: 560px !important;
	}
	.col-md-12 {
	    
	    max-width: fit-content;
	}
    h2{
        text-align: center;
        font-size:22px;
        margin-bottom:50px;
    }
    body{
        background:#f2f2f2;
    }
    .section{
        margin-top:30px;
        padding:50px;
        background:#fff;
    }
    .pdf-btn{
        margin-top:30px;
    }
</style>  
<body>
	<div class="container">
   
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Laravel 8 PDF File Download using JQuery Ajax Request Example - NiceSnippets.com</h2>
                </div>
                <div class="panel-body">
                    <div class="main-div">
                        <input type="hidden" name="key" id="encriptkey" value="{{ $key }}">
                        <input type="hidden" class="campaignID" name="campaign_id" value="{{ $campaign_id }}">
                        <input type="hidden" class="campaign_id" name="campaign_id" value="{{ $campaign_id }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">

                        @php
                        @$dashUsed = array_intersect($types,array_keys($all_dashboards));
                        @$dashDiff = array_diff(array_keys($all_dashboards),$types);
                        @$arrCombine = array_merge($dashUsed,$dashDiff);
                        @endphp



                            <!-- Project Tabs Content -->
                            <div class="tab-content ">
                                <div class="uk-switcher projectNavContainer">
                                    <div  id="PPC" class="uk-active">
                                      @include('viewkey.pdf.ppc')  
                                    </div>
                                </div>

                                <div class="uk-switcher projectNavContainerSideBar">
                                </div>
                            </div>
                            <!-- Project Tabs Content End -->


                        </div>
                    </div>
                </div>
            </div>
   
    </div>
</body>
</html>