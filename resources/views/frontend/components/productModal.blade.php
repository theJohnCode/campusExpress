<div class="modal fade modal-wrapper" id="productID{{$product->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <!-- Product Details Left -->
                        <div class="product-details-left">
                            <div class="product-details-images slider-navigation-1">
                                <div class="lg-image">
                                    <img src="{{ $photo[0]}}" alt="{{$product->title}}">
                                </div>
                                <div class="lg-image">
                                    <img src="{{ asset('frontend/images/product/large-size/2.jpg')}}" alt="product image">
                                </div>
                                {{-- <div class="lg-image">
                                    <img src="{{ asset('frontend/images/product/large-size/3.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{ asset('frontend/images/product/large-size/4.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{ asset('frontend/images/product/large-size/5.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{ asset('frontend/images/product/large-size/6.jpg')}}" alt="product image">
                                </div> --}}
                            </div>
                            <div class="product-details-thumbs slider-thumbs-1">                                        
                                <div class="sm-image"><img src="{{ $photo[0]}}" alt="product image thumb">
                                </div>
                                <div class="sm-image"><img src="{{ asset('frontend/images/product/small-size/2.jpg')}}" alt="product image thumb">
                                </div>
                                {{-- <div class="sm-image"><img src="{{ asset('frontend/images/product/small-size/3.jpg')}}" alt="product image thumb">
                                </div>
                                <div class="sm-image"><img src="{{ asset('frontend/images/product/small-size/4.jpg')}}" alt="product image thumb">
                                </div>
                                <div class="sm-image"><img src="{{ asset('frontend/images/product/small-size/5.jpg')}}" alt="product image thumb">
                                </div>
                                <div class="sm-image"><img src="{{ asset('frontend/images/product/small-size/6.jpg')}}" alt="product image thumb">
                                </div> --}}
                            </div>
                        </div>
                        <!--// Product Details Left -->
                    </div>

                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="product-details-view-content pt-60">
                            <div class="product-info">
                                <h2>{{ $product->title }}</h2>
                                <span class="product-details-ref">Reference: demo_15</span>
                                <div class="rating-box pt-20">
                                    <ul class="rating rating-with-review-item">
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="review-item"><a href="#">Read Review</a></li>
                                        <li class="review-item"><a href="#">Write Review</a></li>
                                    </ul>
                                </div>
                                <div class="price-box pt-20">
                                    <span class="new-price new-price-2">{{ number_format($product->offer_price,2) }}</span>
                                </div>
                                <div class="product-desc">
                                    <p>
                                        <span>{{ $product->description }}. </span>
                                    </p>
                                </div>
                                {{-- todo Change the products size --}}
                                <div class="product-variants">
                                    <div class="produt-variants-size">
                                        <label>Size</label>
                                        <select class="size">
                                            <option value="S" title="S" selected="selected">Small</option>
                                            <option value="M" title="M">Medium</option>
                                            <option value="L" title="L">Large</option>
                                            <option value="XL" title="XL">Extra Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="single-add-to-cart">
                                    <form action="#" class="cart-quantity">
                                        <div class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <button class="add-to-cart" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="product-additional-info pt-25">
                                    <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                    <div class="product-social-sharing pt-25">
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                            <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>