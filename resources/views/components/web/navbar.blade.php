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
                            <div class="clearfix add_bottom_15"><strong>Total</strong><span id="cart_total"></span></div>
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
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#0">Listing</a></li>
                <li><a href="#0">Other Pages</a></li>
                <li><a href="{{ route('categories') }}">Categories</a></li>
            </ul>
        </nav>
    </div>
</header>
<script>
    // Helper: read cookie by name
    function getCookie(name) {
        const match = document.cookie.split('; ').find(row => row.startsWith(name + '='));
        return match ? decodeURIComponent(match.split('=')[1]) : null;
    }

    const isLoggedIn = {{ Auth::check() ? Auth::check() : 'false' }};
    let headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };
    
    if (isLoggedIn) {
        headers['X-User-Id'] = '{{ Auth::id() }}';
    } else {
        headers['X-Guest-Id'] = getCookie('guest_identifier');
    }

    async function fetchCartAndRender() {
        try {
            const guestId = getCookie('guest_identifier');
            const res = await fetch('/api/cart/items', {
                headers: headers,
            });
            
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
            const guestId = getCookie('guest_identifier');
            const res = await fetch(`/api/cart/items/${id}`, {
                method: 'DELETE',
                headers: headers,
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