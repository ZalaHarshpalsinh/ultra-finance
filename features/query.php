<?php
session_start();
require_once("../helpers/config.php");
require_once("../helpers/help.php");

if ( $_SERVER['REQUEST_METHOD'] != "POST" )
{
    return header('location: /ultra-finance/home.php');
}

const QUESTION_REQUIRED = '<h3>Please enter your question before submitting the form!</h3>';
const EMAIL_REQUIRED = '<h3>Please enter your email</h3>';
const EMAIL_INVALID = '<h3>Please enter a valid email</h3>';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$email = trim($email);
if ( empty($email) )
{
    $_SESSION['home_message'] = EMAIL_REQUIRED;
} else
{
    $val = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ( $val === false )
    {
        $_SESSION['home_message'] = EMAIL_INVALID;
    }
}

$question = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_SPECIAL_CHARS);
$question = trim($question);
if ( empty($question) )
{
    $_SESSION['home_message'] = QUESTION_REQUIRED;
}

if ( isset($_SESSION['home_message']) )
{
    return header('location: /ultra-finance/home.php');
}

$sql = "SELECT id FROM users WHERE email=?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ( mysqli_num_rows($result) == 0 )
{
    $user_id = NULL;
} else
{
    $result = mysqli_fetch_array($result);
    $user_id = $result[0];
}

$sql = "INSERT INTO queries (email,query,user_id) VALUES (?,?,?)";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $question, $email, $user_id);
mysqli_stmt_execute($stmt);


$to_email = 'harshpalsinhzala121@gmail.com';
$subject = "New query received";
$body = "
        <h3>Query : {$question} </h3>
        <br><br>
        <h3>Posted by: {$email} </h3>
";

send_mail($to_email, $subject, $body);

$_SESSION['home_message'] = "<h3>Your query has been succesfully reported.\n" . "Reply will be sent via email as soon as possible.</h3>";
return header("location: /ultra-finance/home.php");

?>