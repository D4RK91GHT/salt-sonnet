@extends('web.web-layout')
@section('header')
<link href="{{ asset('assets/web/css/home.css') }}" rel="stylesheet">
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

    <x-web.large-banner />
@endsection

@section('custom-js')
@endsection
