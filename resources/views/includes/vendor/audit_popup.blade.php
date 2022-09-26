<div class="popup" data-pd-popup="howisitcalculated">
    <div class="popup-inner">
        <a class="popup-close" data-pd-popup-close="howisitcalculated" href="#"></a>
        <div class="popup-innerContent">
            <div class="uk-flex">
                <div>
                    <h2>How is it calculated?</h2>
                    <h4>How is Website Score calculated</h4>
                    <p>We use following formula to calculate this metric.</p>
                </div>
                <figure><img src="{{URL::asset('public/vendor/internal-pages/images/calculated-vector.png')}}" alt="calculated-vector"></figure>
            </div>            
            <ul>
                <li>
                    <strong>
                        <figure><img src="{{URL::asset('public/vendor/internal-pages/images/calculated-icon1.png')}}" alt="calculated-icon1"></figure>
                        Website Score =
                    </strong> 
                    (sum OnePageScore) / # of pages
                </li>
                <li>
                    <strong>
                        <figure><img src="{{URL::asset('public/vendor/internal-pages/images/calculated-icon2.png')}}" alt="calculated-icon2"></figure>
                        OnePageScore =
                    </strong> 
                    100 - cost of critical error one - cost of critical error two - cost of warning one ...
                </li>
                <li>
                    <strong>
                        <figure><img src="{{URL::asset('public/vendor/internal-pages/images/calculated-icon3.png')}}" alt="calculated-icon3"></figure>
                        Cost of specific critical error =
                    </strong> 
                    (60 * # of specific errors) / # of all critical errors
                </li>
                <li>
                    <strong>
                        <figure><img src="{{URL::asset('public/vendor/internal-pages/images/calculated-icon4.png')}}" alt="calculated-icon4"></figure>
                        Cost of specific warning =
                    </strong> 
                    (40 * # of specific warnings) / # of all warnings
                </li>
            </ul>
            <p> Let's dive into each element of formula.</p>
            <p>Website Score is an average score across all website pages. By default each page has 100 points. And we minus
                from 100 points cost of each error. </p>
            <p>Cost of error isn't static for all websites. It is calculated for each new crawl and depends from 2 factors:
                type of error (critical or warning) and how often a specific error occurs on the site. Critical errors take
                more points than warnings. Popular errors take more points than rare errors. Notices have no impact on
                Website Score.</p>
            <p>We use index 60 for critical errors and index 40 for warnings to give more weight critical errors.</p>
        </div>
    </div>
</div>
