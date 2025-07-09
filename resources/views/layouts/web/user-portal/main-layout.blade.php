<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="FooYes - Quality delivery or takeaway food">
    <meta name="author" content="Ansonika">
    <title>{{ config('app.name') }} - Quality delivery or takeaway food</title>

    <x-web.header-link />
    @yield('header')
</head>

<body>
    {{-- @yield('navbar') --}}
    <x-web.navbar />

    <main>
        @yield('main')

    </main>
    <!-- /main -->

    <div id="toTop"></div><!-- Back to top button -->

    @yield('elements')

    <!-- COMMON SCRIPTS -->
    <x-web.footer-js-links />

    @yield('custom-js')

    <!-- Autocomplete -->
    <script>
        function initMap() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap">
    </script>

</body>

</html>
