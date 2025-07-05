@extends('web.web-layout')
@section('header')
    <link href="{{ asset('assets/web/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/detail-page.css') }}" rel="stylesheet">
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
                <input type="text" value="1" id="qty_1" class="qty2 form-control" name="quantity">
            </div>
            <div id="modal-variation-list" class="ul-box">
            </div>
            <div class="bg-body-secondary d-flex justify-content-between rounded px-2 py-3 mb-2">
                <h5 class="mb-0">Total</h5>
                <h5 class="mb-0">@php echo $_ENV['CURRENCY'] @endphp <span id="total">0</span></h5>
            </div>
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
<script>

    // function showItemDetails(itemId) {
    //     fetch(`/item/${itemId}`)
    //     .then(response => response.json())
    //     .then(data => {
    //         document.getElementById('modal-item-name').textContent = data.name;
    //         const variationList = document.getElementById('modal-variation-list');
    //         variationList.innerHTML = '';
            
    //         data.grouped_variations.forEach(variation => {
    //             // Create variation type heading
    //             const heading = document.createElement('h5');
    //             heading.textContent = variation.variation_type_name;
                
    //             // Create UL for variation options
    //             const ul = document.createElement('ul');
    //             ul.className = 'clearfix';
                
    //             // Add radio buttons for each variation option
    //             variation.variations.forEach(eachvariation => {
    //                 const li = document.createElement('li');
    //                 li.innerHTML = `
    //                     <label class="container_radio">
    //                         ${eachvariation.name}
    //                         <span>+ @php echo $_ENV['CURRENCY'] @endphp ${eachvariation.price}</span>
    //                         <input type="radio" value="${eachvariation.id}" name="variation_${variation.variation_type_id}" onchange="updateTotal(${eachvariation.price}, this)">
    //                         <span class="checkmark"></span>
    //                     </label>`;
    //                 ul.appendChild(li);
    //             });
                
    //             // Append heading and list to the container
    //             variationList.appendChild(heading);
    //             variationList.appendChild(ul);
    //         });
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //     });
    // }

    // const updateTotal = (price, element) => {
    //     if (element.checked) {
    //         const total = document.getElementById('total');
    //         total.textContent = parseInt(total.textContent) + parseInt(price);
    //     }
    // }

    // =========================================================================

    // Track selected prices by variation group
    // const selectedPrices = {};

    // function showItemDetails(itemId) {
    //     // Reset selected prices when showing new item
    //     Object.keys(selectedPrices).forEach(key => delete selectedPrices[key]);
    //     document.getElementById('total').textContent = '0.00';
        
    //     fetch(`/item/${itemId}`)
    //     .then(response => response.json())
    //     .then(data => {
    //         document.getElementById('modal-item-name').textContent = data.name;
    //         const variationList = document.getElementById('modal-variation-list');
    //         variationList.innerHTML = '';
            
    //         data.grouped_variations.forEach(variation => {
    //             // Create variation type heading
    //             const heading = document.createElement('h5');
    //             heading.textContent = variation.variation_type_name;
                
    //             // Create UL for variation options
    //             const ul = document.createElement('ul');
    //             ul.className = 'clearfix';
                
    //             // Add radio buttons for each variation option
    //             variation.variations.forEach(eachvariation => {
    //                 const li = document.createElement('li');
    //                 li.innerHTML = `
    //                     <label class="container_radio">
    //                         ${eachvariation.name}
    //                         <span>+ @php echo $_ENV['CURRENCY'] @endphp ${parseFloat(eachvariation.price).toFixed(2)}</span>
    //                         <input type="radio" 
    //                             value="${eachvariation.id}" 
    //                             name="variation_${variation.variation_type_id}" 
    //                             data-price="${eachvariation.price}"
    //                             onchange="updateTotal('${variation.variation_type_id}', this)">
    //                         <span class="checkmark"></span>
    //                     </label>`;
    //                 ul.appendChild(li);
    //             });
                
    //             // Append heading and list to the container
    //             variationList.appendChild(heading);
    //             variationList.appendChild(ul);
    //         });
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //     });
    // }

    // function updateTotal(variationTypeId, element) {
    //     const totalElement = document.getElementById('total');
    //     const newPrice = parseFloat(element.dataset.price) || 0;
    //     const currentTotal = parseFloat(totalElement.textContent) || 0;
        
    //     // If there was a previous selection for this variation type, subtract its price
    //     if (selectedPrices[variationTypeId] !== undefined) {
    //         totalElement.textContent = (currentTotal - selectedPrices[variationTypeId] + newPrice).toFixed(2);
    //     } else {
    //         // No previous selection, just add the new price
    //         totalElement.textContent = (currentTotal + newPrice).toFixed(2);
    //     }
        
    //     // Update the selected price for this variation type
    //     selectedPrices[variationTypeId] = newPrice;
    // }

    // =========================================================================

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

</script>
    <script src="{{ asset('assets/web/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/specific_detail.js') }}"></script>
@endsection
