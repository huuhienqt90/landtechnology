<div class="col-md-3 col-sm-3">
    <div class="sidebar">
        <div class="categories">
            <h2 class="text-uppercase">Categories</h2>
            @if( \App\Models\Category::count() )
                @foreach(\App\Models\Category::where('parent_id', 0)->get() as $category)
                    <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#category-{{ $category->id }}">{{ $category->name }}</button>
                    <div id="category-{{ $category->id }}" class="collapse">
                        @if($category->getChildren()->count() )
                            @foreach($category->getChildren() as $child)
                                <p><a href="{{ route('front.product.category', $child->slug) }}" title="menu collapse">{{ $child->name }}</a></p>
                            @endforeach
                        @endif
                    </div> <!-- .collapse -->
                @endforeach
            @else
                <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo">Chair</button>
                <div id="demo" class="collapse">
                    <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                    <p><a href="#" title="menu collapse">Eyewear</a></p>
                    <p><a href="#" title="menu collapse">Jewelry</a></p>
                    <p><a href="#" title="menu collapse">Shoes</a></p>
                    <p><a href="#" title="menu collapse">Skyrts</a></p>
                </div> <!-- .collapse -->
                <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo-1">Woment</button>
                <div id="demo-1" class="collapse">
                    <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                    <p><a href="#" title="menu collapse">Eyewear</a></p>
                    <p><a href="#" title="menu collapse">Jewelry</a></p>
                    <p><a href="#" title="menu collapse">Shoes</a></p>
                    <p><a href="#" title="menu collapse">Skyrts</a></p>
                </div> <!-- .collapse -->
                <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo-2">Kids</button>
                <div id="demo-2" class="collapse">
                    <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                    <p><a href="#" title="menu collapse">Eyewear</a></p>
                    <p><a href="#" title="menu collapse">Jewelry</a></p>
                    <p><a href="#" title="menu collapse">Shoes</a></p>
                    <p><a href="#" title="menu collapse">Skyrts</a></p>
                </div> <!-- .collapse -->
                <button type="button" class="btn-categories collapsed text-uppercase" data-toggle="collapse" data-target="#demo-3">All Peoducts</button>
                <div id="demo-3" class="collapse">
                    <p><a href="#" title="menu collapse">Bag & Luggage</a></p>
                    <p><a href="#" title="menu collapse">Eyewear</a></p>
                    <p><a href="#" title="menu collapse">Jewelry</a></p>
                    <p><a href="#" title="menu collapse">Shoes</a></p>
                    <p><a href="#" title="menu collapse">Skyrts</a></p>
                </div> <!-- .collapse -->
            @endif
        </div> <!-- .categories -->

        <div class="shop-by">
            <h2 class="text-uppercase">Shop by</h2>
            @if( \App\Models\Brand::count() )
                <div class="Manufacturer">
                    <p class="text-uppercase">Brands</p>
                    @foreach(\App\Models\Brand::all() as $brand)
                        <a href="{{ route('front.product.brand', $brand->slug) }}">{{ $brand->name }} <span class="badge">({{ getProductCountByBrand($brand->id) }})</span></a>
                    @endforeach
                </div>
            @endif

            <div class="demo">
                <span class="text-uppercase title-prince">Price</span>
                <div id="slider-range" class="range-style"></div>
                <p>
                    <!-- <label for="amount"></label> -->
                    <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                </p>
                <a href="#" title="btn search price">Search</a>
            </div>

        </div> <!-- .shop-by -->
    </div> <!-- .sidebar -->
</div>