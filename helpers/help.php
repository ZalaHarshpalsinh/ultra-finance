<?php
session_start();
function require_login()
{
    if ( !(isset($_SESSION["user_id"])) )
    {
        $_SESSION['login_message'] = 'Log in first!';
        return header('location: /revolution/login/login.php');
    }
}

function prevent_access_after_login()
{
    if ( (isset($_SESSION["user_id"])) )
    {
        return header('location: /revolution/features/wallet.php');
    }
}

function lookup(string $symbol)
{
    require_once("../helpers/HTML_parser/simple_html_dom_parser.php");
    $url = "https://groww.in/us-stocks/" . $symbol;

    $html = file_get_html("$url", false, null, 0, 100000);

    if ( !$html )
    {
        return false;
    }

    $apikey = getenv("FINNHUB_API_KEY");
    $result = file_get_contents("https://finnhub.io/api/v1/quote?symbol=$symbol&token=$apikey");
    $result = json_decode($result, true);

    $price = $result['c'];
    $sign = ($result['d'] >= 0 ? "+" : "-");
    $change = "$sign{$result['d']} ( $sign{$result['dp']} %)";

    $company_name = $html->find("h1.usph14Head", 0)->innertext();

    $response = [ 'price' => $price, 'change' => $change, 'company_name' => $company_name ];

    return $response;
}

// Function to generate OTP
function generate_OTP($n)
{
    // Taking a generator string that consists of
    // all the numeric digits
    $generator = "1234567890";

    $result = "";

    for ($i = 1; $i <= $n; $i++)
    {
        $result .= substr($generator, rand() % strlen($generator), 1);
    }

    return $result;
}

use PHPMailer\PHPMailer\PHPMailer;

function send_mail($to_email, $subject, $body)
{
    require_once("../PHPMailer/src/PHPMailer.php");
    require_once("../PHPMailer/src/SMTP.php");

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = getenv("ULTRA_FINANCE_EMAIL");
    $mail->Password = getenv("ULTRA_FINANCE_PASSWORD");
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom(getenv("ULTRA_FINANCE_EMAIL"));
    $mail->addAddress($to_email);
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
}
?>