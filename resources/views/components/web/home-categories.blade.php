<div class="container margin_30_60">
    <div class="main_title center">
        <span><em></em></span>
        <h2>Popular Categories</h2>
        <p>From starters to desserts—flavor in every category</p>
    </div>
    <!-- /main_title -->
    <div class="owl-carousel owl-theme categories_carousel">
        @foreach ($categories as $category)
        <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>98</span>
                    <img src="{{ asset('storage/' . $category->image) }}" data-src="{{ asset('storage/' . $category->image) }}" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>{{ $category->name }}</h3>
                        <small>Avg price $40</small>
                    </div>
                </figure>
            </a>
        </div>
        @endforeach
        {{-- <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>87</span>
                    <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_sushi.jpg" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>Japanese</h3>
                        <small>Avg price $50</small>
                    </div>
                </figure>
            </a>
        </div>
        <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>55</span>
                    <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_hamburgher.jpg" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>Burghers</h3>
                        <small>Avg price $55</small>
                    </div>
                </figure>
            </a>
        </div>
        <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>55</span>
                    <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_vegetarian.jpg" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>Vegetarian</h3>
                        <small>Avg price $40</small>
                    </div>
                </figure>
            </a>
        </div>
        <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>65</span>
                    <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_bakery.jpg" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>Bakery</h3>
                        <small>Avg price $60</small>
                    </div>
                </figure>
            </a>
        </div>
        <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>25</span>
                    <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_chinesse.jpg" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>Chinese</h3>
                        <small>Avg price $40</small>
                    </div>
                </figure>
            </a>
        </div>
        <div class="item_version_2">
            <a href="grid-listing-filterscol.html">
                <figure>
                    <span>35</span>
                    <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_mexican.jpg" alt=""
                        class="owl-lazy">
                    <div class="info">
                        <h3>Mexican</h3>
                        <small>Avg price $35</small>
                    </div>
                </figure>
            </a>
        </div> --}}
    </div>
    <!-- /carousel -->
</div>
<!-- /container -->