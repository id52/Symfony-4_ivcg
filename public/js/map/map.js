$(function () {
    var markers = [];
    $.get('/get-maps', function(data) {
        $.each(data, function( index, map ) {
            var marker = {};
            marker.latLng = [map.latitude, map.longitude];
            marker.name   = map.city;
            marker.attribute = 'image';
            marker.photo_uri = map.photo_uri;
            markers.push(marker);
        });

        $('#ru-map').vectorMap(
            {
                map: 'ru_merc',
                regionStyle: {
                    initial: {
                        fill: '#116CC9',
                        stroke: '#0F5097',
                        "stroke-width": 1
                    },

                },
                backgroundColor: 'trans',
                markersSelectable: true,
                zoomOnScroll: false,
                normalizeFunction: 'polynomial',
                markers: markers,
                markerStyle: {
                    initial: {
                        "image": "/img/marker.png",
                    },
                    // hover: {
                    //     "image": '/img/marker_circles.png',
                    // },

                },

                onRegionTipShow: function(event, label, index){
                    event.preventDefault();
                },

                onMarkerTipShow: function (event, label, index) {
                    var map  = markers[index];
                    var html = '<div class="marker">';
                    html+='<img class="marker-image" src="'+map.photo_uri+'"><br>';
                    html+='<span class="marker-city">'+map.name+'</span><br>'
                    html+='</div>';
                    label.html(html);

                },
            }
        );

    });
});