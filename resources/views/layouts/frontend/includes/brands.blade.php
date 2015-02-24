<div id="brands-carousel" class="logo-slider wow fadeInUp">

    <h3 class="section-title">Shop Top Brands</h3>

    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            @foreach($brands as $brand)

                @if(!is_null($brand->logo))
                    <div class="item">
                        <a href="{{ route('brands.shop', ['id' => $brand->id]) }}" class="image">
                            <img src="{{ asset($brand->logo) }}">
                        </a>
                    </div><!--/.item-->
                @endif
            @endforeach

        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div><!-- /.logo-slider -->