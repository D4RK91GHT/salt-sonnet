<header class="header black_nav clearfix element_to_stick">
    <div class="container">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/site/logo.png') }}" width="162" height="35" alt="">
            </a>
        </div>
        <div class="layer"></div><!-- Opacity Mask Menu Mobile -->
        <ul id="top_menu" class="drop_user">
            <li>
                <div class="dropdown dropdown-cart">
                    <a href="{{ route('checkout') }}" class="cart_bt"><strong>0</strong></a>
                    <div class="dropdown-menu">
                        <ul>
                            {{-- Cart Items Goes Here --}}
                        </ul>
                        <div class="total_drop">
                            <div class="clearfix add_bottom_15"><strong>Total</strong><span id="cart_total">$32.00</span></div>
                            <a href="{{ route('checkout') }}" class="btn_1 outline">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn_1">Checkout</a>
                        </div>
                    </div>
                </div>
                <!-- /dropdown-cart-->
            </li>

            @auth
            <li>
                <div class="dropdown user clearfix">
                    <a href="#" data-bs-toggle="dropdown">
                        <figure><img src="{{ asset('assets/web/img/avatar.jpg') }}" alt=""></figure>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-content">
                            <ul>
                                <li><a href="{{ route('dashboard') }}"><i class="icon_cog"></i>Dashboard</a></li>
                                <li><a href="#0"><i class="icon_document"></i>Bookings</a></li>
                                <li><a href="#0"><i class="icon_heart"></i>Wish List</a></li>
                                <li><hr class="dropdown-divider m-0"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-item"> <i class="icon_key"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /dropdown -->
            </li>
            @else
            <li><a href="#sign-in-dialog" id="sign-in" class="login">Sign In</a></li>
            @endauth
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="index.html"><img src="{{ asset('assets/site/logo.png') }}" width="162" height="35" alt=""></a>
            </div>
            <ul>
               <li class="submenu">
                    <a href="#0" class="show-submenu">Home</a>
                    <ul>
                        <li><a href="index-13.html">KenBurns Slider <strong>New!</strong></a></li>
                        <li><a href="index.html">Address Autocomplete</a></li>
                        <li><a href="index-2.html">Search by Keyword</a></li>
                        <li><a href="index-3.html">Home Version 2</a></li>
                        <li><a href="index-4.html">Video Bg Fallback Mobile</a></li>
                        <li class="third-level"><a href="#0">Sliders - Parallax <strong>New!</strong></a>
                            <ul>
                                <li><a href="index-6.html">Owl Carousel</a></li>
                                <li><a href="index-7.html">Revolution Slider 1</a></li>
                                <li><a href="index-8.html">Revolution Slider 2</a></li>
                                <li><a href="index-9.html">Youtube/Vimeo Parallax</a></li>
                                <li><a href="index-10.html">MP4 Video Parallax</a></li>
                                <li><a href="index-11.html">Parallax Image</a></li>
                            </ul>
                        </li>
                        <li><a href="index-12.html">Text Rotator <strong>New!</strong></a></li>
                        <li><a href="index-5.html">GDPR Cookie Bar EU Law</a></li>
                        <li><a href="header-user-logged.html">Header User Logged</a></li>
                        <li><a href="header-cart-top.html">Header Cart Top</a></li>
                        <li><a href="modal-advertise.html">Modal 1 Cookie Session</a></li>
                        <li><a href="modal-newsletter.html">Modal 2 Cookie Session</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Listing</a>
                    <ul>
                        <li class="third-level"><a href="#0">List pages</a>
                            <ul>
                                <li><a href="grid-listing-filterscol.html">List default</a></li>
                                <li><a href="grid-listing-filterscol-map.html">List with map</a></li>
                                <li><a href="listing-map.html">List side map</a></li>
                                <li><a href="grid-listing-masonry.html">List Masonry Filter</a></li>
                            </ul>
                        </li>
                        <li class="third-level"><a href="#0">Detail pages</a>
                           <ul>
                                <li><a href="detail-restaurant.html">Detail page 1</a></li>
                                <li><a href="detail-restaurant-2.html">Detail page 2</a></li>
                                <li><a href="detail-restaurant-3.html">Detail page 3</a></li>
                                <li><a href="detail-restaurant-4.html">Detail page 4</a></li>
                            </ul>
                        </li>
                        <li class="third-level"><a href="#0">OpenStreetMap</a>
                            <ul>
                                <li><a href="grid-listing-filterscol-openstreetmap.html">List with map</a></li>
                                <li><a href="listing-map-openstreetmap.html">List side map</a></li>
                                <li><a href="grid-listing-masonry-openstreetmap.html">List Masonry Filter</a></li>
                            </ul>
                        </li>
                        <li><a href="submit-restaurant.html">Submit Restaurant</a></li>
                        <li><a href="submit-rider.html">Submit Rider</a></li>
                        <li><a href="order.html">Order</a></li>
                        <li><a href="confirm.html">Confirm Order</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Other Pages</a>
                   <ul>
                    <li><a href="admin_section/index.html" target="_blank">Admin Section</a></li>
                    <li><a href="404.html">404 Error</a></li>
                    <li><a href="help.html">Help and Faq</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="leave-review.html">Leave a review</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="coming_soon/index.html">Coming Soon</a></li>
                    <li><a href="login.html">Sign In</a></li>
                    <li><a href="register.html">Sign Up</a></li>
                    <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                    <li><a href="icon-pack-2.html">Icon Pack 2</a></li>
                    <li><a href="shortcodes.html">Shortcodes</a></li>
                </ul>
                </li>
                <li><a href="{{ route('categories') }}">Categories</a></li>
            </ul>
        </nav>
    </div>
</header>
<script>
    async function fetchCartAndRender() {
        try {
            const cartToken = localStorage.getItem('cart_token');
            const res = await fetch('/api/cart/items', {
                headers: {
                    ...(cartToken ? { 'X-Guest-Id': cartToken } : {}),
                }
            });
            console.log(cartToken);
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Failed to fetch cart');

            // render cart
            document.querySelector('.cart_bt strong').textContent = data.count;
            const listEl = document.querySelector('.dropdown-menu ul');
            if (listEl) listEl.innerHTML = '';
            let cartTotal = 0;
            data.items.forEach(item => {
              const firstImage = (item.menu_item?.images?.[0]?.image_path) || 'placeholder/placeholder.jpg';
              const name = item.menu_item?.name || 'Item';
              const quantity = item.quantity || 1;
              const price = (item.variations?.[0]?.price) ?? 0;
              cartTotal += price * quantity;

              if (listEl) listEl.innerHTML += `
              <li>
                <figure><img src="{{ asset('storage/${firstImage}') }}" data-src="{{ asset('storage/${firstImage}') }}" alt="" width="50" height="50" class="lazy"></figure>
                    <strong><span>${quantity}x ${name}</span>{{ config('app.currency') }}${price}</strong>
                        <a href="#0" class="action" data-cart-id="${item.id}"><i class="icon_trash_alt"></i></a>
              </li>`;
            })
            document.getElementById('cart_total').textContent = `{{config('app.currency')}}${cartTotal}`;
        } catch (err) {
            console.error(err);
        }
    }

    fetchCartAndRender();

    document.addEventListener('click', async (e) => {
        const a = e.target.closest('a.action[data-cart-id]');
        if (!a) return;
        e.preventDefault();
        try {
            const id = a.getAttribute('data-cart-id');
            const cartToken = localStorage.getItem('cart_token');
            const res = await fetch(`/api/cart/items/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    ...(cartToken ? { 'X-Guest-Id': cartToken } : {}),
                }
            });
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Failed to remove');
            window.showToast('Item removed from cart', { variant: 'warning', delay: 1500 });
            fetchCartAndRender();
        } catch (err) {
            console.error(err);
            window.showToast('Could not remove item', { variant: 'danger' });
        }
    });
</script>