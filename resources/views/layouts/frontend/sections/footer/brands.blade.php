<div class="container">
    <div id="brands-carousel" class="logo-slider wow fadeInUp">

        <h3 class="section-title">Shop Top Brands</h3>

        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                @foreach($brands as $brand)


                    <div class="item p-all-10">
                        <a href="{{ route('brands.shop', ['id' => $brand->id, 'name' => preetify($brand->name)]) }}"
                           class="image" name="{{ $brand->name }}">
                            <img src="{{ displayImage($brand, 'logo') }}" class="img-responsive"
                                 style="width: 195px; height: 100px;">
                        </a>
                    </div><!--/.item-->

                @endforeach

            </div>
            <!-- /.owl-carousel #logo-slider -->
        </div>
        <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
</div>
