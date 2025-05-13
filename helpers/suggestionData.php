<?php
require_once('./help.php');

require_login();

if ( isset($_GET['q']) && !empty(trim($_GET['q'])) )
{
        $symbol = $_GET['q'];
        $apikey = getenv("FINNHUB_API_KEY");
        $result = file_get_contents("https://finnhub.io/api/v1/stock/recommendation?symbol={$symbol}&token={$apikey}");
        echo $result;
}
?>