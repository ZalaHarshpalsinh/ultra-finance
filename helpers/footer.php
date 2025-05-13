<footer class="footer-box bg-dark tp">
    <div class="container">
        <div class="row">
            <div class="col-md-12 white_fonts">
                <div class="row">

                    <div class="col-sm-6 col-md-6 col-lg-3 p-5">
                        <div class="full">
                            <img class="img-responsive" src="/revolution/image/logo1.png" alt="#"
                                style="width: 250px;" />
                            <p class="p-3 ">
                                Data provided by <a href="https://finnhub.io/">Finnhub</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-3 p-5">
                        <div class="full text-center fw-bold">
                            <h3 class="big">Quick Links</h3>
                        </div>
                        <div class="full">
                            <ul class="menu_footer " style="text-align: left;">
                                <li><a href="/revolution/home.php">> Home</a></li>
                                <li><a href="/revolution/features/wallet.php">> Wallet</a></li>
                                <li><a href="/revolution/features/quote.php">> Buy</a></li>
                                <li><a href="/revolution/features/news.php">> News</a></li>
                                <li><a href="/revolution/features/history.php">> History</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-3 p-5">
                        <div class="full">
                            <div class="footer_blog full white_fonts">
                                <h3 class="big text-center fw-bold">Query</h3>
                                <p>if you have any question so feel free to ask.</p>
                                <div class="newsletter_form">
                                    <form action="/revolution/features/query.php" method='POST'>
                                        <div class="p-2">
                                            <?php if ( !isset($_SESSION['user_id']) ): ?>
                                                <input type="email" name="email" id="email" placeholder="Your email">
                                            <?php else: ?>
                                                <?php

                                                $root = realpath($_SERVER["DOCUMENT_ROOT"]);
                                                require_once("$root/revolution/helpers/config.php");
                                                $sql = "SELECT email FROM users WHERE id=?";
                                                $stmt = mysqli_prepare($link, $sql);
                                                mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);
                                                $result = mysqli_fetch_array($result);

                                                ?>
                                                <input type="hidden" name="email" id="email"
                                                    value="<?php echo $result[0] ?>">
                                            <?php endif ?>
                                        </div>
                                        <div class="p-2">
                                            <input type="text" name="question" id="question" placeholder="question..!!"
                                                required>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" value="Send" name="Send"
                                                style="width: 100px;padding: 10px;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-3 p-5">
                        <div class="full">
                            <div class="footer_blog full ">
                                <h3 class="big fw-bold text-center">Contact us</h3>
                                <ul class="full">
                                    <li><img src="/revolution/image/i5.png"><span>Gujarat<br>India</span></li>
                                    <li><img src="/revolution/image/i6.png"><span>ultrafinance100@gmail.com</span></li>
                                    <li><img src="/revolution/image/i7.png"><span>+919586813653</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
</body>

</html>