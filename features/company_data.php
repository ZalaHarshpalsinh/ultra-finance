<?php
require_once('../helpers/help.php');

require_login();

if ( isset($_GET['q']) && !empty(trim($_GET['q'])) )
{
    $name = str_replace(" ", "%20", $_GET['q']);
    $apikey = getenv("FINNHUB_API_KEY");
    $result = file_get_contents("https://finnhub.io/api/v1/search?q=$name&exchange=US&token=$apikey");
    echo $result;
}
?>