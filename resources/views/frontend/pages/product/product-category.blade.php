@extends('frontend.layouts.master')

@section('content')
    @include('frontend.components.breadcrumb')
    <div class="content-wraper pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <!-- Begin Li's Banner Area -->
                    <div class="single-banner shop-page-banner">
                        <a href="#">
                            <img src="{{ asset('frontend/images/bg-banner/2.jpg')}}" alt="Li's Static Banner">
                        </a>
                    </div>
                <!-- Li's Banner Area End Here -->
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            <span>Showing 1 to 9 of 15</span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <div class="product-select-box">
                        <div class="product-short">
                            <p>Sort By:</p>
                            <select id="sortBy" class="nice-select">
                                <option value="">Default</option>
                                <option value="titleAsc">Name (A - Z)</option>
                                <option value="titleDes">Name (Z - A)</option>
                                <option value="priceAsc">Price (Low &gt; High)</option>
                                <option value="priceDes">Price (High &gt;Low)</option>
                                <option value="rate">Rating (Lowest)</option>
                                <option value="discountAsc">Discount (Low &gt;High)</option>
                                <option value="discountDes">Discount (High &gt;Low)</option>
                            </select>
                        </div>
                    </div>
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-40" id="product-data">
                                        @include('frontend.layouts._single-product')
                                    </div>
                                </div>
                            </div>
                            <div class="ajax-load text-center" style="display: none">
                                <img src="{{ asset('frontend/images/loader.gif') }}" alt="" style="width: 10%">
                            </div>
                        </div>
                        {{-- <div id="list-view" class="tab-pane product-list-view fade" role="tabpanel">
                            <div class="row">
                                @if (count($categories->products) > 0)
                                <div class="col">
                                    {{-- List Single Product --}}
{{--                                     
                                    @foreach ($categories->products as $product)
                                        <div class="row product-layout-list">
                                        <div class="col-lg-3 col-md-5 ">
                                            @php
                                                $photo = explode(',', $product->photo)
                                            @endphp
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{$photo[0]}}" alt="{{$product->title}}">
                                                </a>
                                                <span class="sticker">{{$product->conditions}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-7">
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="#">{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</a>
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
                                                    <h4><a class="product_name" href="#">{{$product->title}}</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">{{number_format($product->offer_price,2)}}}</span>
                                                        <span class="new-price text-danger"><del>{{number_format($product->price,2)}}}</del></span>
                                                    </div>
                                                    <p>{{$product->description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="shop-add-action mb-xs-30">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart"><a href="#">Add to cart</a></li>
                                                    <li class="wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a></li>
                                                    <li><a class="quick-view" data-toggle="modal" data-target="#productID{{$product->id}}" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                   @include('frontend.components.productModal')
                                    @endforeach
                                </div>
                                @else:
                                <p>No Product Found</p>
                                @endif
                            </div>
                        </div> --}} 
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <p>Showing 1-12 of 13 item(s)</p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul class="pagination-box">
                                        <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li>
                                            <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
    <script>
        $('#sortBy').change(function (e) { 
            let sort = $('#sortBy').val();
            window.location = "{{ url(''.$route.'') }}/{{ $categories->slug }}?sort="+sort;
        });
    </script>
    <script>
        function loadMoreData(page){
            $.ajax({
                type: "get",
                url: "?page="+page,
                beforeSend: function(){
                    $('.ajax-load').show();
                },
            })
            .done(function(data){
                if(data.html == ''){
                    $('.ajax-load').html('No more product is available');
                    return;
                }
                $('.ajax-load').hide();
                $('#product-data').append(data.html);
            })
            .fail(function(){
                alert('Something went wrong! Please try again');
            });
        }

        let page = 1;
        $(window).scroll(function () { 
            if($(window).scrollTop() + $(window).height() + 120 >= $(document).height()){
                page ++;
                loadMoreData(page);
            }
        });
    </script>
@endsection