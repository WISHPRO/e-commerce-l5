<footer id="footer" class="footer color-bg">
    <div class="footer-bottom inner-bottom-sm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">Categories</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('f.categories.view', ['id' => $category->id]) }}">
                                        {{ beautify($category->name) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">My Account</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            @include('layouts.frontend.includes.user-links')
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">our services</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Libero Sed rhoncus</a></li>
                            <li><a href="#">Venenatis augue tellus</a></li>
                            <li><a href="#">My Vouchers</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading outer-bottom-xs">
                        <h4 class="module-title">help & support</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li><a href="#">Knowledgebase</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Contact Support</a></li>
                            <li><a href="#">Marketplace Blog</a></li>
                            <li><a href="#">About PC-World</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-7 no-padding pull-right">
                <div class="pull-left">
                    <div class="copyright">
                        Copyright &copy; {{ date('Y') }}
                        <a href="#">PC World</a>
                        - All rights Reserved
                    </div>
                    <a href="#">
                        <i class="icon fa fa-heart" style="font-size: 18px"></i>
                        Antony chacha
                    </a>
                </div>
                <div class="social-icons pull-right">

                    <a href="#"><i class="icon fa fa-facebook" style="font-size: 18px"></i></a>
                    <a href="#"><i class="icon fa fa-twitter" style="font-size: 18px"></i></a>
                    <a href="#"><i class="icon fa fa-linkedin" style="font-size: 18px"></i></a>
                    <a href="#"><i class="icon fa fa-google-plus" style="font-size: 18px"></i></a>

                </div>
                <!-- /.social-icons -->
            </div>
        </div>
    </div>
</footer>