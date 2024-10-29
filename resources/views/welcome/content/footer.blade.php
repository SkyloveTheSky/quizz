<!-- info section -->
<section class="info_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info_logo">
                    <div>
                        <a href="">
                            <img src="images/logo.png" alt="" />
                            <span>
                                Brighton
                            </span>
                        </a>
                    </div>
                    <p>
                        There are many variations of passages of Lorem Ipsum available,
                        but the majority have suffered alteration
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_links ">
                    <h5>
                        Contact Us
                    </h5>
                    <p class="pr-0 pr-md-4 pr-lg-5">
                        Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing
                        elit. Donec
                        odio. Quisque volutpat mattis eros
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_insta">
                    <h5>
                        INFORMATION
                    </h5>
                    <p class="pr-0 pr-md-4 pr-md-5">
                        Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing
                        elit. Donec
                        odio. Quisque volutpat mattis eros
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pl-0 pl-lg-5 pl-md-4">
                    <h5>
                        MY ACCOUNT

                    </h5>
                    <p>
                        Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing
                        elit. Donec
                        odio. Quisque volutpat mattis eros
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- end info_section -->

<!-- footer section -->
<section class="container-fluid footer_section">
    <p>
        &copy; 2024 All Rights Reserved
    </p>
</section>
<!-- footer section -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

    <script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>

<script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
        // Australia.
        function initMap() {
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 11,
        center: {
            lat: 40.645037,
        lng: -73.880224
            }
        });

        var image = "images/maps-and-flags.png";
        var beachMarker = new google.maps.Marker({
            position: {
            lat: 40.645037,
        lng: -73.880224
            },
        map: map,
        icon: image
        });
    }
</script>

<script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
    }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
    }
</script>
