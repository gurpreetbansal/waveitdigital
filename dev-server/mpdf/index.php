<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require composer autoload
require __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$url = urldecode('https://waveitdigital.com/download/seo/MjI3LXwtOTktfC0xNjU0MjMxNjcx');

// To prevent anyone else using your script to create their PDF files
// if (!preg_match('@^https?://www\.mydomain\.com/@', $url)) {
//     die("Access denied");
// }

// For $_POST i.e. forms with fields
if (count($_POST) > 0) {

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1 );

    foreach($_POST as $name => $post) {
      $formvars = array($name => $post . " \n");
    }

    curl_setopt($ch, CURLOPT_POSTFIELDS, $formvars);
    $html = curl_exec($ch);
    curl_close($ch);

} elseif (ini_get('allow_url_fopen')) {
    $html = file_get_contents($url);

} else {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , 1 );
    $html = curl_exec($ch);
    curl_close($ch);
}

$mpdf = new \Mpdf\Mpdf();

$mpdf->useSubstitutions = true; // optional - just as an example
$mpdf->SetHeader($url . "\n\n" . 'Page {PAGENO}');  // optional - just as an example
$mpdf->CSSselectMedia='mpdf'; // assuming you used this in the document header
$mpdf->setBasePath($url);
$mpdf->WriteHTML($html);

$mpdf->Output();








/*require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">My document</td>
    </tr>
</table>');

$mpdf->WriteHTML('<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Devallum</title>
    <meta name="title" content="Devallum">
    <meta name="description" content="Devallum">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.png" sizes="32x32" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://player.vimeo.com/api/player.js"></script>
</head>
<body>
    <header id="header" class="site-header container-fluid">
        <nav>
            <span class="site-logo">
                <a href="index.php">
                    <img src="images/devallum-logo.png" alt="Devallum Logo">
                </a>
            </span>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="about.php">About</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
            <span class="site-search">
                <a href="javascript:void(0)">
                    <i class="las la-search"></i>
                </a>
                <form class="form">
                    <input type="text" name="search" placeholder="Search...">
                </form>
            </span>
        </nav>
    </header>');
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML('<footer id="footer" class="site-footer">
    <div class="footer-top container-fluid">
        <span class="site-logo">
            <a href="index.php">
                <img src="images/devallum-footer-logo.png" alt="Devallum Logo">
            </a>
        </span>
        <ul class="footer-menu">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="about.php">About</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
        </ul>
        <p>
            <a href="javascript:void(0)" target="_blank">97 Oak Meadow Lane Tallahassee, FL 32303</a>
            <br>
            <a href="mailto:dessau@example.com">rishabh@devallum.com</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="tel:+917340750196">+91 73407-50196</a>
        </p>
        <ul class="social-icons">
            <li>
                <a href="javascript:void(0)"><i class="lab la-instagram"></i></a>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="lab la-twitter"></i></a>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="lab la-facebook-f"></i></a>
            </li>
        </ul>
    </div>
    <p>&COPY; 2022 - Devallum</p>
</footer>

<script src="js/bundle.min.js"></script>
<script src="js/custom.js"></script>

<!-- For Developer use -->
<script src="js/developer.js"></script>

</body>

</html>');

$mpdf->Output();*/