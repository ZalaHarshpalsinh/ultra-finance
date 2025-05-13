<?php session_start(); ?>

<?php require_once "./helpers/header.php" ?>

<title>Ultra Finance: Welcome</title>

<?php require_once "./helpers/navbar.php" ?>

<?php

echo $_SESSION['home_message'] ?? '';

?>

<section class="welcome" id="welcome">
  <h2 class="tp"><span class="big fs-1 fw-bold">Welcome </span> To Finance</h2>
  <p class="px">Welcome to UltraFinace, your ultimate destination for all things related to the stock market. Our
    website provides investors and traders with a comprehensive platform to access real-time financial information,
    track stock prices, and stay informed about the latest market trends. With a wide range of features, including
    interactive stock charts, news updates, company profiles, and financial analysis tools,
    UltraFinace empowers you to make well-informed investment decisions.Experience the convenience and
    accessibility of UltraFinace, where you can actively participate in the stock market and crypto space, potentially
    unlocking new opportunities to grow your wealth. Join us today and embark on your financial journey with confidence.
  </p>
</section>


<section class="services" id="services">
  <div class="header-services">
    <h2 class="tp"><span class="big fw-bold">Services</span> </h2>
  </div>
  <!-- <div class="container"> -->
  <div class="cards d-flex justify-content-around flex-wrap">

    <div class="card " style="width: 20rem;">
      <img src="image/s1.png" class="card-img-top" alt="...">
      <div class="card-body" style="padding-top: 35px;padding-bottom: 5px;">
        <h3 class="card-title text-center">Safe & Secure</h3>
        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>

    <div class="card " style="width: 20rem;">
      <img src="image/s3.png" class="card-img-top" alt="...">
      <div class="card-body" style="padding-top: 35px;padding-bottom: 5px;">
        <h3 class="card-title text-center">Wallet</h3>
        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>

    <div class="card" style="width: 20rem;">
      <img src="image/s4.png" class="card-img-top" alt="...">
      <div class="card-body" style="padding-top: 35px;padding-bottom: 5px;">
        <h3 class="card-title text-center">Experts Support</h3>
        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  </div>
</section>
<?php require_once "./helpers/footer.php" ?>
<?php unset($_SESSION['home_message']) ?>