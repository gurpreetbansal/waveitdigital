<?php
include('simple_html_dom.php');
if($_GET){
?>
    <form method="GET">
        <input type="text" name="url" required>
        <input type="submit">
    </form>
<?php
    $domain = $_GET['url'];
    $html = file_get_html('https://www.google.com/search?client=ms-google-coop&q=site:'.$domain.'&cx=e670fa3861a3fdac5&num=100&safe=high');
    $links = array();
    $i = 1;
    foreach($html->find('a[href*="/url"]') as $a) {
        $links = $a->href;
        if (strpos($links,'google.com') !== false) {
        }else{
            $links = parse_url($links,PHP_URL_QUERY);
            $links =  str_replace("q=","",$links);    
            $url = strtok($links, '&');
            echo $i . ' '. $url;
            echo '<br>';
        }
        $i++;
    }
}else{
?>
    <form method="GET">
        <input type="text" name="url" required>
        <input type="submit">
    </form>
<?php
}
?>