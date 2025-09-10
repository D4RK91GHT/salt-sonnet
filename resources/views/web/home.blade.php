@extends('web.web-layout')
@section('header')
    <link href="{{ asset('assets/web/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/detail-page.css') }}" rel="stylesheet">
    {{-- <style>
        /* Ensure toast sits above Magnific Popup (.mfp-wrap/.mfp-bg z-index: 999999) */
        #liveToastContainer { 
            z-index: 2147483647 !important; /* max 32-bit */
            position: fixed; 
            top: 0; 
            right: 0; 
            pointer-events: none; /* container ignores clicks */
        }
        #liveToastContainer .toast { 
            pointer-events: auto; /* but toast remains clickable */
            position: relative;
            z-index: inherit;
        }
        /* Counter Magnific Popup blur rule: .mfp-wrap ~ * { filter: blur(...) } */
        .mfp-wrap ~ #liveToastContainer { 
            -webkit-filter: none !important; 
            -moz-filter: none !important; 
            -o-filter: none !important; 
            -ms-filter: none !important; 
            filter: none !important; 
            backdrop-filter: none !important;
        }
        .mfp-wrap ~ #liveToastContainer * { 
            -webkit-filter: none !important; 
            -moz-filter: none !important; 
            -o-filter: none !important; 
            -ms-filter: none !important; 
            filter: none !important; 
            backdrop-filter: none !important;
        }
      </style> --}}
@endsection
@section('main')
    <x-web.home-hero />

    <x-web.home-categories :categories="$categories" />

    <x-web.popular-items :items="$mostOrderedItems" />
    
    <x-web.first-banner />

    <x-web.large-cards-slider />

    {{-- @dd($categoryWithItems) --}}
    <x-web.item-list :categorywithitems="$categoryWithItems" />
    

@endsection

@section('elements')
    <!-- Modal item order -->
    <div id="modal-dialog" class="zoom-anim-dialog mfp-hide">
        <div class="small-dialog-header">
            <h3 id="modal-item-name">Cheese Quesadilla</h3>
        </div>
        <div class="content">
            <h5>Quantity</h5>
            <div class="numbers-row">
                <input type="text" value="1" onchange="updateTotalPrice()" id="item_qty" class="qty2 form-control" name="quantity">
            </div>
            <div id="modal-variation-list" class="ul-box">
            </div>
            <div class="bg-body-secondary d-flex justify-content-between rounded px-2 py-3 mb-2">
                <h5 class="mb-0">Total</h5>
                <h5 class="mb-0">@php echo config('app.currency') @endphp <span id="total">0</span></h5>
            </div>
        </div>
        <div class="footer">
            <div class="row small-gutters">
                <div class="col-md-4">
                    <button type="reset" class="btn_1 outline full-width mb-mobile">Cancel</button>
                </div>
                <div class="col-md-8">
                    <button type="reset" class="btn_1 full-width" id="add-to-cart">Add to cart</button>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </div>
    <!-- /Modal item order -->
@endsection

@section('custom-js')
<script>

    // Track selected prices by variation group
const selectedPrices = {};

function showItemDetails(itemId) {
    // Reset selected prices when showing new item
    Object.keys(selectedPrices).forEach(key => delete selectedPrices[key]);
    document.getElementById('total').textContent = '0.00';
    
    fetch(`/item/${itemId}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('modal-item-name').textContent = data.name;
        document.getElementById('modal-item-name').dataset.productId = data.id;
        const variationList = document.getElementById('modal-variation-list');
        variationList.innerHTML = '';
        
        data.grouped_variations.forEach(variation => {
            // Create variation type heading
            const heading = document.createElement('h5');
            heading.textContent = variation.variation_type_name;
            
            // Create UL for variation options
            const ul = document.createElement('ul');
            ul.className = 'clearfix';
            
            // Add radio buttons for each variation option
            variation.variations.forEach(eachvariation => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <label class="container_radio">
                        ${eachvariation.name}
                        <span>+ @php echo $_ENV['CURRENCY'] @endphp ${parseFloat(eachvariation.price).toFixed(2)}</span>
                        <input type="radio" 
                               value="${eachvariation.id}" 
                               name="variation_${variation.variation_type_id}" 
                               data-price="${eachvariation.price}"
                               onclick="handleVariationClick(event, '${variation.variation_type_id}', this)">
                        <span class="checkmark"></span>
                    </label>`;
                ul.appendChild(li);
            });
            
            // Append heading and list to the container
            variationList.appendChild(heading);
            variationList.appendChild(ul);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateTotalPrice() {
    const quantity = parseInt(document.getElementById('item_qty').value);
    console.log(quantity);
    const totalElement = document.getElementById('total');
    
    // Calculate sum of all selected variation prices
    let variationsTotal = 0;
    const variationInputs = document.querySelectorAll('input[name^="variation_"]:checked');
    variationInputs.forEach(input => {
        // console.log(input.dataset.price);
        variationsTotal += parseFloat(input.dataset.price) || 0;
    });
    
    // const variationsTotal = Array.from(variationInputs).map(input => ({
    //     variation_type_id: input.name.split('_')[1], // Extract the ID after the underscore,
    //     variation_id: input.value
    // }));

    console.log((quantity+1) * variationsTotal);
    // Calculate new total (base price + variations) * quantity
    // const newTotal = (basePrice + variationsTotal) * quantity;
    // totalElement.textContent = newTotal.toFixed(2);
}

function handleVariationClick(event, variationTypeId, element) {
    const totalElement = document.getElementById('total');
    const currentTotal = parseFloat(totalElement.textContent) || 0;
    const newPrice = parseFloat(element.dataset.price) || 0;
    
    // If clicking the already selected radio button
    if (element.checked && selectedPrices[variationTypeId] === newPrice) {
        element.checked = false;
        // Deduct the price of the deselected option
        totalElement.textContent = (currentTotal - newPrice).toFixed(2);
        delete selectedPrices[variationTypeId];
        return;
    }
    
    // If there was a previous selection for this variation type, subtract its price
    if (selectedPrices[variationTypeId] !== undefined) {
        totalElement.textContent = (currentTotal - selectedPrices[variationTypeId] + newPrice).toFixed(2);
    } else {
        // No previous selection, just add the new price
        totalElement.textContent = (currentTotal + newPrice).toFixed(2);
    }
    
    // Update the selected price for this variation type
    selectedPrices[variationTypeId] = newPrice;
}


    document.getElementById('add-to-cart').addEventListener('click', function() {
        const itemId = document.getElementById('modal-item-name').dataset.productId;
        const quantity = document.getElementById('item_qty').value;
        const total = document.getElementById('total').textContent;
        
        // Get all checked variation inputs
        const variationInputs = document.querySelectorAll('input[name^="variation_"]:checked');

        const variations = Array.from(variationInputs).map(input => ({
            variation_type_id: input.name.split('_')[1], // Extract the ID after the underscore,
            variation_id: input.value
        }));

        // Validation: require at least one variation OR price > 0
        const totalNumber = parseFloat(total);
        if ((variations.length === 0) && (!Number.isFinite(totalNumber) || totalNumber <= 0)) {
            // Show Bootstrap toast (fallback to alert if Bootstrap is unavailable)
            const message = 'Please select at least one variation or ensure the price is more than 0.';
            try {
                window.showToast(message, { variant: 'danger', delay: 4000 }); // default 3000ms
            } catch (e) {
                // Fallback if Bootstrap is not loaded
                alert(message);
            }
            return;
        }

        (async () => {
            try {
                // Ensure guest id exists before request (use cookie instead of localStorage)
                const getCookie = (name) => {
                    const match = document.cookie.split('; ').find(row => row.startsWith(name + '='));
                    return match ? decodeURIComponent(match.split('=')[1]) : null;
                };
                const setCookie = (name, value, days) => {
                    const d = new Date();
                    d.setTime(d.getTime() + (days*24*60*60*1000));
                    document.cookie = `${name}=${encodeURIComponent(value)}; expires=${d.toUTCString()}; path=/; SameSite=Lax`;
                };
                let guestId = getCookie('guest_identifier');
                if (!guestId) {
                    guestId = (crypto.randomUUID ? crypto.randomUUID() : Math.random().toString(36).slice(2));
                    setCookie('guest_identifier', guestId, 30);
                }
                const res = await fetch('/api/cart/items', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        ...(guestId ? { 'X-Guest-Id': guestId } : {}),
                    },
                    body: JSON.stringify({
                        menu_item_id: parseInt(itemId),
                        quantity: parseInt(quantity) || 1,
                        variation_ids: variations.map(v => parseInt(v.variation_id)),
                    }),
                });
                const contentType = res.headers.get('content-type') || '';
                const data = contentType.includes('application/json') ? await res.json() : { message: await res.text() };
                if (!res.ok || data.success === false) {
                    throw new Error(data.message || 'Failed to add to cart');
                }
                // Notify UI
                window.showToast('Added to cart', { variant: 'success', delay: 2000 });
                window.dispatchEvent(new CustomEvent('cart:updated'));
            } catch (err) {
                console.error(err);
                window.showToast('Could not add to cart', { variant: 'danger' });
            }
        })();
    });
</script>
    <script src="{{ asset('assets/web/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/specific_detail.js') }}"></script>
@endsection
