<footer class="main-footer">
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Products </h3>
                    <ul>
                        <li><a href="#"> Subcategories </a></li>
                        <li><a href="#"> Categories </a></li>
                        <li><a href="#"> Brands </a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Lorem Ipsum </h3>
                    <ul>
                        <li><a href="#"> Lorem Ipsum </a></li>
                        <li><a href="#"> Lorem Ipsum </a></li>
                        <li><a href="#"> Lorem Ipsum </a></li>
                        <li><a href="#"> Lorem Ipsum </a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> help & support </h3>
                    <ul>
                        <li><a href="#">Knowledgebase</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Contact Support</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Company </h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Libero Sed rhoncus</a></li>
                        <li><a href="#">My Vouchers</a></li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    <h3> News Letter </h3>

                    <p>Sign up for our newsletter</p>
                    <ul>
                        <li>
                            <form method="POST" accept-charset="UTF-8" action="#">
                                {!! generateCSRF() !!}
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Enter your email" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </form>
                        </li>
                    </ul>
                    <hr/>
                    <ul class="social">
                        <li><a href="#"> <i class=" fa fa-facebook">   </i> </a></li>
                        <li><a href="#"> <i class="fa fa-twitter">   </i> </a></li>
                        <li><a href="#"> <i class="fa fa-google-plus">   </i> </a></li>
                        <li><a href="#"> <i class="fa fa-pinterest">   </i> </a></li>
                        <li><a href="#"> <i class="fa fa-youtube">   </i> </a></li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright &copy; PC-World {{ date('Y') }}. All right reserved. </p>

            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>

</footer>