<div class="category-menu">
            <div class="category-heading">
                <h2 class="categories-toggle"><span>categories</span></h2>
            </div>
            <div id="cate-toggle" class="category-menu-list">
                @if (count($categories) > 0)
                <ul>
                    @foreach ($categories as $category)
                    <li class="right-menu"><a href="{{route('product.category',$category->slug)}}">{{$category->title}}</a>
                        @php
                            $cat = \App\Models\Category::where('parent_id',$category->id)->get()
                        @endphp
                          @if (count($cat) > 0)
                        <ul class="cat-mega-menu">
                            @foreach ($cat as $c)  
                            <li class="right-menu cat-mega-title">
                                <a href="{{route('product.category',$c->slug)}}">{{$c->title}}</a>
                                @php
                                    $subcat = \App\Models\Category::where('parent_id',$c->id)->get()
                                 @endphp
                                   @if (count($subcat) > 0)
                                <ul>
                                    @foreach ($subcat as $sub)  
                                    <li><a href="{{route('product.category',$sub->slug)}}">{{$sub->title}}</a></li>
                                    
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach

                        </ul>
                        @endif
                    </li>
                     @endforeach
                   
                    <li class="rx-parent">
                        <a class="rx-default">More Categories</a>
                        <a class="rx-show">Less Categories</a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
