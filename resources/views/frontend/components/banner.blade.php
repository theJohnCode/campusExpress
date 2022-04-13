 <div class="col-lg-9">
 @if (count($banners) > 0)
        <div class="slider-area pt-sm-30 pt-xs-30">
            <div class="slider-active owl-carousel">
                <!-- Begin Single Slide Area -->
                @foreach ($banners as $banner)
                <div class="single-slide align-center-left animation-style-02 bg-4" style="background-image: url('{{$banner->photo}}')">
                    <div class="slider-progress"></div>
                    <div class="slider-content">
                        
                        <h2>{{$banner->title}}</h2>
                        <h5>{!!html_entity_decode($banner->description)!!}</h5>
                        
                        <div class="default-btn slide-btn">
                            <a href="{{$banner->slug}}" class="links">Shopping Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Single Slide Area End Here -->
            </div>
        </div>
        @endif
</div>