<?php
require_once('./help.php');

require_login();

if ( isset($_GET['q']) && !empty(trim($_GET['q'])) )
{
        $symbol = $_GET['q'];
        $apikey = getenv("ALPHA_VANTAGE_API_KEY");
        $result = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol={$symbol}&apikey={$apikey}");
        echo $result;
}
?>