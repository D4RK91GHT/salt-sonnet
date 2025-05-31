@extends('web.web-layout')

@section('hero')
    <div class="hero_single version_1">
        <div class="opacity-mask">
            <div class="container">
                <div class="row justify-content-lg-start justify-content-md-center">
                    <div class="col-xl-6 col-lg-8">
                        <h1>Delivery or Takeaway Food</h1>
                        <p>The best restaurants at the best price</p>
                        <form method="post" action="grid-listing-filterscol.html">
                            <div class="row g-0 custom-search-input">
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input class="form-control no_border_r" type="text" id="autocomplete"
                                            placeholder="Address, neighborhood...">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn_1 gradient" type="submit">Search</button>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="search_trends">
                                <h5>Trending:</h5>
                                <ul>
                                    <li><a href="#0">Sushi</a></li>
                                    <li><a href="#0">Burgher</a></li>
                                    <li><a href="#0">Chinese</a></li>
                                    <li><a href="#0">Pizza</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="wave hero"></div>
    </div>
    <!-- /hero_single -->
@endsection

@section('main')
    <x-web.home-categories :categories="$categories"/>

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title">
                <span><em></em></span>
                <h2>Top Rated Restaurants</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                <a href="#0">View All &rarr;</a>
            </div>
            <div class="row add_bottom_25">
                <div class="col-lg-6">
                    <div class="list_home">
                        <ul>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_1.jpg"
                                            alt="" class="lazy">
                                    </figure>
                                    <div class="score"><strong>9.5</strong></div>
                                    <em>Italian</em>
                                    <h3>La Monnalisa</h3>
                                    <small>8 Patriot Square E2 9NF</small>
                                    <ul>
                                        <li><span class="ribbon off">-30%</span></li>
                                        <li>Average price $35</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_2.jpg"
                                            alt="" class="lazy">
                                    </figure>
                                    <div class="score"><strong>8.0</strong></div>
                                    <em>Mexican</em>
                                    <h3>Alliance</h3>
                                    <small>27 Old Gloucester St, 4563</small>
                                    <ul>
                                        <li><span class="ribbon off">-40%</span></li>
                                        <li>Average price $30</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_3.jpg"
                                            alt="" class="lazy">
                                    </figure>
                                    <div class="score"><strong>9.0</strong></div>
                                    <em>Sushi - Japanese</em>
                                    <h3>Sushi Gold</h3>
                                    <small>Old Shire Ln EN9 3RX</small>
                                    <ul>
                                        <li><span class="ribbon off">-25%</span></li>
                                        <li>Average price $20</li>
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="list_home">
                        <ul>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_4.jpg"
                                            alt="" class="lazy">
                                    </figure>
                                    <div class="score"><strong>9.5</strong></div>
                                    <em>Vegetarian</em>
                                    <h3>Mr. Pepper</h3>
                                    <small>27 Old Gloucester St, 4563</small>
                                    <ul>
                                        <li><span class="ribbon off">-30%</span></li>
                                        <li>Average price $20</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_5.jpg"
                                            alt="" class="lazy">
                                    </figure>
                                    <div class="score"><strong>8.0</strong></div>
                                    <em>Chinese</em>
                                    <h3>Dragon Tower</h3>
                                    <small>22 Hertsmere Rd E14 4ED</small>
                                    <ul>
                                        <li><span class="ribbon off">-50%</span></li>
                                        <li>Average price $35</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_6.jpg"
                                            alt="" class="lazy">
                                    </figure>
                                    <div class="score"><strong>8.5</strong></div>
                                    <em>Pizza - Italian</em>
                                    <h3>Bella Napoli</h3>
                                    <small>135 Newtownards Road BT4</small>
                                    <ul>
                                        <li><span class="ribbon off">-45%</span></li>
                                        <li>Average price $25</li>
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
            <div class="banner lazy" data-bg="url(img/banner_bg_desktop.jpg)">
                <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                    <div>
                        <small>FooYes Delivery</small>
                        <h3>We Deliver to your Office</h3>
                        <p>Enjoy a tasty food in minutes!</p>
                        <a href="grid-listing-filterscol.html" class="btn_1 gradient">Start Now!</a>
                    </div>
                </div>
                <!-- /wrapper -->
            </div>
            <!-- /banner -->
        </div>
    </div>
    <!-- /bg_gray -->

    <x-web.large-banner />
    <!-- /shape_element_2 -->
@endsection
