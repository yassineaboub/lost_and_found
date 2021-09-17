(function ($) {
    "use strict"; // Start of use strict
    //
    $("#news-slider8").owlCarousel({
        items: 3,
        loop: true,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 2],
        itemsMobile: [600, 1],
        autoplay: true,
        autoPlaySpeed: 1000,
        autoPlayTimeout: 1000,
        autoplayHoverPause: true
    });

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 54)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        $('.navbar-collapse').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: 56
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

    var lat = 48.852969;
    var lon = 2.349903;
    var macarte = null;

    function initMap() {
        if ($('#map').length) {
            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            macarte = L.map('map').setView([lat, lon], 11);
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(macarte);
        }

    }

    function initMapNew() {
        if ($('#new').length) {
            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            macarte = L.map('new', {zoomControl: false}).setView([lat, lon], 11);
            L.control.zoom({
                position: 'bottomright'
            }).addTo(macarte);
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(macarte);
            macarte.on('click', onMapClick);


        }

    }


    // click circle:
    var clickCircle;

    function onMapClick(e) {

        if (clickCircle != undefined) {
            macarte.removeLayer(clickCircle);
        }
        ;
        clickCircle = L.circle(e.latlng, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 200
        }).addTo(macarte);
        var curPos = clickCircle.getLatLng();
        $('.lat').val(curPos.lat);
        $('.lng').val(curPos.lng);
    }


    function fileName() {
        $('#customFileLang').on('change', function () {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        $("#imageUpload").change(function () {
            readURL(this);
        });
    }

    function initMapDetail() {
        if ($('#mapdetail').length) {
            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            macarte = L.map('mapdetail').setView([34.740318, 10.756943], 16);
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(macarte);
            var circle = L.circle([34.740318, 10.756943], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 200
            }).addTo(macarte);
        }
    }

    function Stepper() {
        var current = 1, current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function () {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function () {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);

        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    }

    function datatableInit() {
        $(document).ready(function () {
            var table = $('#example').DataTable({
                'orderCellsTop': true,
                'select': 'api',
                "columnDefs": [
                    {className: 'text-center'},
                    {"orderable": false, "targets": 0},
                    {"orderable": false, "targets": 5}
                ]
            });

            // Handle click event on a checkbox
            $('#example').on('click', 'thead .column-selector th input[type="checkbox"]', function (e) {
                e.stopPropagation();
                //alert('hi');
                var colIdx = $(this).closest('th').index();
                console.log(colIdx);
                if (this.checked) {
                    table.column(colIdx).select();
                } else {
                    table.column(colIdx).deselect();
                }
            });

            // Handle click event on header cell containg a checkbox
            $('#example').on('click', 'thead .column-selector th', function (e) {
                $('input[type="checkbox"]', this).trigger('click');
            });
        });

    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function comfirmPassword() {
        $('.note').hide();
        $('form').on('submit', function (e) {
            // validation code here
            if (!($('.pass').val() === $('.comfpass').val())) {
                e.preventDefault();
                $('.note').show();
            }
        });
    }

    function disableQuestion() {
        var val1 = $("select[name='question-1']").val();
        $("select[name^='question'] option[value="+val1+"]").attr('disabled', 'disabled');
        $("select[name^='question']").change(function () {
            var val = $(this).val();
            $("select[name^='question'] option[value="+val+"]").attr('disabled', 'disabled');
            $("option[value="+val+"]", this).removeAttr('disabled');
        });

    }

    function hideSubCat() {
        if ($('.object-cat').val() !== 'please choose') {
            $('.object-sub-cat').attr('disabled', 'disabled');
        }
        $('.object-cat').change(function () {
            if ($(this).val() !== 'please choose') {
                var id = $(this).find(':selected').data('id');
                $('.object-sub-cat').removeAttr('disabled');
                $(".object-sub-cat option").hide();
                $(".object-sub-cat option[data-parent='" + id + "']").show();

            }
            else {
                $('.object-sub-cat').attr('disabled', 'disabled');

            }
        });
    }
    disableQuestion();
    fileName();
    hideSubCat();
    comfirmPassword();
    Stepper();
    initMap();
    initMapDetail();
    initMapNew();
    datatableInit();

    $('.marker').on('click', function (e) {
        e.preventDefault();
        var lat = $(this).data('lat');
        var long = $(this).data('long');
        var circle = L.circle([lat, long], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 200
        }).addTo(macarte);
        macarte.panTo(new L.LatLng(lat, long));
        macarte.setZoom(16);
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    })
})(jQuery); // End of use strict
