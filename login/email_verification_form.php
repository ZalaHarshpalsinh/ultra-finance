<?php
if ( !isset($_SESSION['verification']) )
{
    return header('location: login.php');
}
?>

<?php require_once "../helpers/header.php" ?>
<title>Ultra Finance: verify</title>
<?php require_once "../helpers/navbar.php" ?>
<section class="form">
<h1>Verify your email</h1>
<a href='generate_otp.php' style="padding:10px;">Did not receive OTP? Resend.</a>

<form action="<?php echo $_SERVER['PHP_SELF'] ?> " method="post">
    <div>
        <?php echo $error['OTP'] ?? '' ?>
    </div>
    <div class="mb-3 mt-3">
        <input autocomplete="off" autofocus class="form-control mx-auto w-auto" id="otp" name="otp"
            placeholder="OTP has been sent to your e-mail." type="text">
    </div>

    <button class="btn btn-primary" type="submit">Verify</button>
</form>
</section>
<?php require_once "../helpers/footer.php"; ?>