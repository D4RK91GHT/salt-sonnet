@extends('web.web-layout')
@section('header')
    <link href="{{ asset('assets/web/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/detail-page.css') }}" rel="stylesheet">
@endsection
@section('main')
    <x-web.home-hero />


    <x-web.home-categories :categories="$categories" />

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

            <x-web.first-banner />

            <x-web.large-cards-slider />

        </div>
    </div>
    <!-- /bg_gray -->

    <x-web.item-list />
    

@endsection

@section('elements')
    <!-- Modal item order -->
    <div id="modal-dialog" class="zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3>Cheese Quesadilla</h3>
        </div>
        <div class="content">
            <h5>Quantity</h5>
            <div class="numbers-row">
                <input type="text" value="1" id="qty_1" class="qty2 form-control" name="quantity">
            </div>
            <h5>Size</h5>
            <ul class="clearfix">
                <li>
                    <label class="container_radio">Medium<span>+ $3.30</span>
                        <input type="radio" value="option1" name="options_1">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li>
                    <label class="container_radio">Large<span>+ $5.30</span>
                        <input type="radio" value="option2" name="options_1">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li>
                    <label class="container_radio">Extra Large<span>+ $8.30</span>
                        <input type="radio" value="option3" name="options_1">
                        <span class="checkmark"></span>
                    </label>
                </li>
            </ul>
            <h5>Extra Ingredients</h5>
            <ul class="clearfix">
                <li>
                    <label class="container_check">Extra Tomato<span>+ $4.30</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li>
                    <label class="container_check">Extra Peppers<span>+ $2.50</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li>
                    <label class="container_check">Extra Ham<span>+ $4.30</span>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </li>
            </ul>
        </div>
        <div class="footer">
            <div class="row small-gutters">
                <div class="col-md-4">
                    <button type="reset" class="btn_1 outline full-width mb-mobile">Cancel</button>
                </div>
                <div class="col-md-8">
                    <button type="reset" class="btn_1 full-width">Add to cart</button>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </div>
    <!-- /Modal item order -->
@endsection

@section('custom-js')
    <script src="{{ asset('assets/web/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/specific_detail.js') }}"></script>
@endsection
