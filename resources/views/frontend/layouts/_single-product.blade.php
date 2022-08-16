                 
    <!-- single-product-wrap start -->
    @foreach ($products as $product)
        
    <div class="single-product-wrap">
        <div class="product-image">
            @php
                $photo = explode(',', $product->photo)
            @endphp
            <a href="#">
                <img src="{{$photo[0]}}" alt="{{$product->title}}">
            </a>
            <span class="sticker">{{$product->conditions}}</span>
        </div>
        <div class="product_desc">
            <div class="product_desc_info">
                <div class="product-review">
                    <h5 class="manufacturer">
                        <a href="product-details.html">{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</a>
                    </h5>
                    <div class="rating-box">
                        <ul class="rating">
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
                <h3><a class="product_name" href="#">{{ucfirst($product->title)}}</a></h3>
                <div class="price-box">
                    <span class="new-price">{{number_format($product->offer_price, 2)}}</span>
                    <span class="new-price text-danger"><del>{{number_format($product->price, 2)}}</del></span>
                </div>
            </div>
            <div class="add-actions">
                <ul class="add-actions-link">
                    <li class="add-cart active"><a href="shopping-cart.html">Add to cart</a></li>
                    <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#productID{{$product->id}}"><i class="fa fa-eye"></i></a></li>
                    <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    @include('frontend.components.productModal')
    @endforeach
    <!-- single-product-wrap end -->
