
var gMarkers = [];
var kMarkers = [];
var markers = [

//
//Skole markører
//
    ['Campus Fjerdingen', 59.916224, 10.759697, 0, 'school', 'sirkelmarker.png', 'http://facebook.com', 'infovindu-bilder/fjerdingen.jpg', 'Adresse: Chr. Krohgs gate 32, 0186 Oslo', '08.00 – 24.00', '10.00 – 23.00'],
    ['Campus Vulkan', 59.9233391, 10.7503081, 1, 'school', 'sirkelmarker.png', 'http://facebook.com', 'infovindu-bilder/vulkan.jpg', 'Adresse: Vulkan 19, 0178 Oslo', '08.00 – 22.00', '10.00-18.00'],
    ['Campus Brenneriveien', 59.920352, 10.7506041, 2, 'school', 'sirkelmarker.png', 'http://facebook.com', 'infovindu-bilder/brenneriveien.jpg', 'Adresse: Brenneriveien 9, 0182 Oslo', '07.30 – 24.00', '10.00 – 23.00'],
    ['Campus Kvadraturen', 59.911015, 10.7439543, 3, 'school', 'sirkelmarker.png', 'http://facebook.com', 'infovindu-bilder/hk.jpg', 'Adresse: Kirkegata 24-26, 0153 Oslo', '08.00 – 23.00', '09.00 – 17.00'],
//
//Spisested markører
//
    ['Talor og Jørgen', 59.9149799, 10.7504415, 4, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/t&j.jpg', 'Adresse: Youngs gate 9, 0181 Oslo', '07.30 - 17.00', '12.00 - 17.00'],
    ['Mathallen', 59.922217, 10.749852, 5, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/mathallen.jpg', 'Adresse: Vulkan 5, 0178 Oslo', '10.00 - 20.00 (stengt mandag)', '11.00 - 18.00'],
    ['Taco República', 59.9170294, 10.7509215, 6, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/taco-republica.jpg', 'Adresse: Torggata 30, 0183 Oslo', '16.00 - 23.00 (stengt mandag)', '12.00 - 00.30'],
    ['Freddy Fuego', 59.9178054, 10.7515039, 7, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/t&j.jpg', 'Adresse: Hausmanns gate 31a, 0182 Oslo', '11.00 - 21.00', '11.00 - 23.00'],
    ['Peloton', 59.9174132, 10.7522924, 8, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/peloton.jpg', 'Adresse: Torggata 35, 0183 Oslo', '08.00 - 11.30', '11.00 - 03.30'],
    ['Munchies', 59.91638, 10.7490935, 9, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/munchies.jpg', 'Adresse:  Torggata 18c, 0181 Oslo', '11.00 - 22.00', '11.00 - 03.00'],
    ['Haralds Vaffler', 59.913759, 10.745212, 10, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/vafler.jpg', 'Adresse: Torggata 7, 0181 Oslo', '11.00 - 20.00', '11.00 - 20.00'],
    ['Würst', 59.9137012, 10.7465163, 11, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/wurst.jpg', 'Adresse: Torggata 11, 0181 Oslo', '13.00 - 00.30', '13.00 - 03.00'],
    ['Bari Pizza', 59.9166197, 10.7527744, 12, 'food', 'food-marker.png', 'http://facebook.com', 'infovindu-bilder/bari-pizza.jpg', 'Adresse: Torggata 23, 0183 Oslo', '12.00 - 00.00', '12.00 - 03.00'],
//
//Bar/utested markører
//
    ['Cafe Sara', 59.9176068, 10.754149, 13, 'bar', 'bar-marker.png', 'http://facebook.com', 'infovindu-bilder/cafe-sara.jpg', 'Adresse: Hausmanns gate 29, 0182 Oslo', '11.00 - 03.30', '11.00 - 03.30'],
    ['Verkstedet', 59.9177192, 10.7517947, 14, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/verkstedet.jpg', 'Adresse:  Hausmanns gate 29, 0182 Oslo', '19.00 - 03.00 (stengt man, tirs, ons)', '19.00 - 03.00'],
    ['Cafe Sør', 59.9141846, 10.7461596, 15, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/cafe-&-sor.jpg', 'Adresse: Torggata 11, 0181 Oslo', '11:00 — 00:30', '11:00—  03:30'],
    ['Crow bar', 59.9171999, 10.7512208, 16, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/crow.jpg', 'Adresse: Torggata 32, 0183 Oslo', '15.00 - 03.00', '15.00 - 03.00'],
    ['Tilt', 59.9162015, 10.7485173, 17, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/tilt.jpg', 'Adresse:  Badstugata 6, 0183 Oslo', '15.00 - 03.30', '15.00 - 03.30'],
    ['Angst', 59.9139828, 10.7465088, 18, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/angst.jpg', 'Adresse: Torggata 11, 0181 Oslo', '12.00 - 01.30', '12.00 - 03.00'],
    ['Peretroska', 59.9135765, 10.7470165, 19, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/peretroika.jpg', 'Adresse: Storgata 13, 0155 Oslo', '16.00 - 03.30', '16.00 - 03.30'],
    ['Kniven', 59.9163927, 10.7490339, 20, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/kniven.jpg', 'Adresse:  Bernt Ankers gate 5, 0183 Oslo', '14.00 - 03.30', '18.00 - 03.30'],
    ['Oslo Bar & Bowling', 59.9158823, 10.7485441, 21, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/bar-&-bowling.jpg', 'Adresse: Torggata 16, 0181 Oslo', '11.00 - 00.00', '11.00 - 02.00'],
    ['Kulturhuset', 59.9146546, 10.7486177, 22, 'bar', 'bar-marker.png', 'http://dogs.com', 'infovindu-bilder/kulturhuset.jpg', 'Adresse: Youngs gate 6, 0181 Oslo', '08.00 - 03.30', '11.00 - 03.30'],
//
//Treningssentre
//
    ['Actic Storgata', 59.91618200000001, 10.757546, 23, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/actic.jpg', 'Adresse: Storgata 38, 0182 Oslo', '05.00 - 23.00', '08.00 - 23.00'],
    ['Haralds Gym', 59.9157868, 10.7587026, 24, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/haralds-gym.jpg', 'Adresse: Hausmanns gate 6, 0186 Oslo', '06.00 - 12.00', '06.00 - 12.00'],
    ['SATS Schous plass', 59.9188379, 10.7603446, 25, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/sats.jpg', 'Adresse: Trondheimsveien 2D, 0560 Oslo', '06.00 - 22.30', '08.30 - 19.00'],
    ['EVO Grünerløkka', 59.9199906, 10.7598709, 26, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/evo.png', 'Adresse: Thorvald Meyers gate 72, 0552 Oslo', '05.00 - 12.00', '05.00 - 12.00'],
    ['SATS Spektrum', 59.9128297, 10.7549285, 27, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/sats.jpg', 'Adresse: Sonja Henies plass 4, 0185 Oslo', '06.15 - 21.30', '10.00 - 17.00'],
    ['SiO Athletica Vukan', 59.9231517, 10.7500041, 28, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/athletica.jpg', 'Adresse: Vulkan 15, 0178 Oslo', '06.00 - 22.00', '09.00 - 18.00'],
    ['SiO Athletica Centrum', 59.9186627, 10.731186, 29, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/athletica.jpg', 'Adresse: Holbergs gate 21, 0166 Oslo', '07.00 - 22.00', '11.00 - 18.00'],
    ['24Fitness AS', 59.91266, 10.743449, 30, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/24hourfitness.png', 'Adresse: Karl Johans gate 17, 0159 Oslo', '05.00 - 00.00', '05.00 - 00.00'],
    ['SATS Akersgata', 59.914745, 10.7432694, 31, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/sats.jpg', 'Adresse: Akersgata 51, 0180 Oslo', '06.00 - 21.30', '10.00 - 19.00'],
    ['Fresh Fitness St Hanshaugen', 59.925468, 10.7454316, 32, 'gym', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/fresh.png', 'Waldemar Thranes gate 25, 0171 Oslo', '05.00 - 23.00', '05.00 - 23.00'],
//
//Matbutikk
//
    ['REMA 1000', 59.9140393, 10.7567231, 33, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/rema.png', 'Adresse: Christian Krohgs gate 1-11, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['REMA 1000', 59.9137399, 10.7471823, 34, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/rema.png', 'Adresse: Torggata 2, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['MENY Oslo City', 59.9126314, 10.752499, 35, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/meny.jpg', 'Adresse: Stenersgata 1, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['REMA 1000', 59.919193, 10.7470611, 36, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/rema.png', 'Adresse: Fredensborgveien 24, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['REMA 1000', 59.9200256, 10.7386707, 37, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/rema.png', 'Adresse: Pilestredet Park 31, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['Rema 1000 Vulkan', 59.92329949999999, 10.7512015, 38, 'matbutikk', 'supermarket.png', 'gym-marker.png', 'http://dogs.com', 'infovindu-bilder/rema.png', 'Adresse: Maridalsveien 15, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['Bunnpris Gunerius', 59.9138834, 10.7536016, 39, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/bunnpris.png', 'Adresse: Storgata 32, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)'],
    ['Food Express Grocery', 59.9161715, 10.7595113, 40, 'matbutikk', 'supermarket.png', 'http://dogs.com', 'infovindu-bilder/foodexpress.jpg', 'Adresse: Storgata 32, Oslo', '06.00 - 24.00', '07.00 - 24.00 (stengt søndag)']
];
var kollektivtMarkers = [
    //kollektivt
    ['Heimdalsgata',    59.918500, 10.761413, 'holdeplass', ['fjerdingen'],             ['trikk', 'buss'], ['17'],                  ['30', '31', '31E', 'N390']],
    ['Hausmannsgate',   59.918339, 10.760560, 'holdeplass', ['fjerdingen'],             ['trikk', 'buss'], ['11', '12', '13', '17'],['30', '31', '31E', 'N11', 'N12', 'N390']],
    ['Lakkegata skole', 59.920629, 10.768365, 'holdeplass', ['fjerdingen'],             ['trikk', 'buss'], ['17'],                  ['31', '31E', 'N390']],
    ['Vahls gate',      59.916069, 10.763558, 'holdeplass', ['fjerdingen'],             ['buss'],          [],                      ['380', '390', '390E'], []],
    ['Grønland T-bane', 59.918339, 10.760560, 'holdeplass', ['fjerdingen'],             ['t-bane'],        [],                      [],                             ['1', '2', '3', '4', '5']],
    ['Brugata',         59.914780, 10.753317, 'holdeplass', ['fjerdingen'],             ['trikk', 'buss'], ['11', '12', '13', '17'],['30', '31', '31E', '34', '54', 'N11', 'N12', 'N390']],
    ['Hammersborggata', 59.915000, 10.752212, 'holdeplass', ['fjerdingen'],             ['buss'],          [],                      ['150', '160', '250', '250E', '255E', '265E', 'N1', 'N2', 'N11', 'N18', 'N130', 'N140', 'N250']],
    ['Dronningensgate', 59.910753, 10.746503, 'holdeplass', ['kvadradturen'],           ['trikk'],         ['12', '13', '19'],      [], []],
    ['Øvre Slottsgate', 59.912216, 10.741954, 'holdeplass', ['kvadradturen'],           ['trikk'],         ['12', '13', '19'],      [], []],
    ['Wessels Plass',   59.912087, 10.738758, 'holdeplass', ['kvadradturen'],           ['trikk'],         ['12', '13', '19'],      [], []],
    ['Stortinget',      59.913797, 10.740925, 'holdeplass', ['kvadradturen'],           ['t-bane'],        [],                      [],                               ['1', '2', '3', '4', '5']],
    ['Møllerveien',     59.920786, 10.751499, 'holdeplass', ['vulkan'],                 ['buss'],                                   ['34', '54']],
    ['Schous Plass',    59.921044, 10.759481, 'holdeplass', ['vulkan', 'fjerdingen'],   ['trikk'], ['11', '12', '13', '19']],
    ['Jernbanetorget',  59.912022, 10.750408, 'holdeplass', ['fjerdingen', 'kvadradturen', 'vulkan', 'brenneriveien'], ['trikk', 'buss', 't-bane'], ['11', '12', '13', '17', '18', '19'],['30', '31', '31E', '36E', '54', 'N5', 'N12', 'N30'], ['1', '2', '3', '4', '5']]
];

var bysykkelMarkers = [];
var center = {
    lat: 0,
    lng: 0
};


var options = {
    zoom: 15,
    maxZoom : 17,
    minZoom: 13,
    center: {
        lat: center.lat,
        lng: center.lng
    },
    styles:[
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#444444"
                }
            ]
        },
        {
            "featureType": "administrative.country",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "saturation": "0"
                },
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "administrative.country",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#55646c"
                },
                {
                    "weight": "2.39"
                }
            ]
        },
        {
            "featureType": "administrative.neighborhood",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#767e89"
                },
                {
                    "weight": "2.90"
                },
                {
                    "gamma": "4.29"
                }
            ]
        },
        {
            "featureType": "administrative.neighborhood",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#6f8189"
                }
            ]
        },
        {
            "featureType": "administrative.land_parcel",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "administrative.land_parcel",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#7e92a3"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#f2f2f2"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#8896a7"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#cfdce2"
                },
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#76909b"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "landscape.natural.landcover",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#8194ab"
                }
            ]
        },
        {
            "featureType": "landscape.natural.terrain",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#6c8795"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "poi.medical",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#a7b7c0"
                }
            ]
        },
        {
            "featureType": "poi.medical",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#a9b3bc"
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#c9d4da"
                }
            ]
        },
        {
            "featureType": "poi.place_of_worship",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#a0b2ba"
                }
            ]
        },
        {
            "featureType": "poi.place_of_worship",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#bbc4ca"
                }
            ]
        },
        {
            "featureType": "poi.school",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#c2cad2"
                }
            ]
        },
        {
            "featureType": "poi.school",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#b9c8d0"
                }
            ]
        },
        {
            "featureType": "poi.sports_complex",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#bbcace"
                }
            ]
        },
        {
            "featureType": "poi.sports_complex",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#c2ccd2"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": 45
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "road.highway.controlled_access",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "road.highway.controlled_access",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit.station.bus",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#73959d"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#9aadb5"
                },
                {
                    "visibility": "on"
                }
            ]
        }

    ],
    gestureHandling: 'greedy',
    zoomControl: true,
    mapTypeControl : false
};

var fjerdingenMarker = new google.maps.Marker({
    position: {
        lat: 59.916224,
        lng: 10.759697
    }
});
var vulkanMarker = new google.maps.Marker({
    position: {
        lat: 59.9233391,
        lng: 10.7503081
    }
});
var kvadratturenMarker = new google.maps.Marker({
    position: {
        lat: 59.911015,
        lng: 10.7439543
    }
});
var brenneriveienMarker = new google.maps.Marker({
    position: {
        lat: 59.920352,
        lng: 10.7506041
    }
});

var map;
var icon;
var infowindow = new google.maps.InfoWindow();

var userPosition;
var userMarker;

//bysykkel
var stations = [];
var availability = [];
var availabilityInterval;
const config = {
    size: 78,
    strokeWidth: 3,
    font: {
        family: 'Graphik-Semibold',
        weight: 700,
        size: 56
    }
}
const font = config.font.weight + ' ' + config.font.size + 'px ' + config.font.family
const defaultTheme = {

}
const themes = {
    noBikes: {
        background: '#5F0000',
        border: '#005FD1',
        text: '#FFFFFF'
    },
    defaultTheme: {
        background: '#005FD1',
        border: '#005FD1',
        text: '#FFFFFF'
    }
}
const textCache = {}
const textDimension = function (text, font, radius) {
    const id = text + ':' + font + ':' + radius
    if (typeof textCache[id] === 'object') { return textCache[id] }
    const canvas = document.createElement('canvas')
    canvas.width = radius
    canvas.height = radius
    const context = canvas.getContext('2d')
    context.font = font
    context.fillStyle = '#000'
    const x = 10
    context.fillText(text, x, radius - 20)
    const textData = context.getImageData(0, 0, radius, radius).data
    let c = radius + 1
    let l = -1
    let f = -1
    let d = radius + 1
    for (let h = 0; h < radius; h++) {
        for (let p = 0; p < radius; p++) {
            let m = 4 * (h * radius + p)
            let g = textData[m]
            let v = textData[m + 1]
            let y = textData[m + 2]
            let b = textData[m + 3]
            if (!(g === 0 && v === 0 && y === 0 && b === 0)) {
                if (c > p) {
                    c = p
                }
                if (l < p) {
                    l = p
                }
                if (d > h) {
                    d = h
                }
                if (f < h) {
                    f = h
                }
            }
        }
    }
    const width = l - c
    const height = f - d
    textCache[id] = {
        width,
        height,
        xDelta: c - x
    }
    return textCache[id]
}
const generateCircle = (theme) => {
    const canvas = document.createElement('canvas')
    canvas.width = config.size
    canvas.height = config.size
    const context = canvas.getContext('2d')
    context.beginPath()
    context.fillStyle = theme.background
    context.strokeStyle = theme.border
    context.lineWidth = config.strokeWidth
    context.arc(config.size / 2, config.size / 2, config.size / 2 - config.strokeWidth / 2, 0, 2 * Math.PI, !1)
    context.fill()
    context.stroke()
    return canvas
}

//directions
var directionsDisplay = new google.maps.DirectionsRenderer;
directionsDisplay.setOptions({
    preserveViewport: true
});
var directionsService = new google.maps.DirectionsService;
var travelModes = {
    bike : 'BICYCLING',
    walk : 'WALKING',
    drive : 'DRIVING',
    transit : 'TRANSIT'
};


//functions
function filterMarkers(category)    {
    var categories = $(".chk-btn").toArray().filter(function(elm){
        return elm.checked
    }).map(function (value) {
        return value.id
    });
        for(i = 0; i < markers.length; i++){
            var marker = gMarkers[i];
            category = markers[i][4];

           if(categories.includes(category)){
                marker.setVisible(true);
            }
            else{
                marker.setVisible(false);
            }
        }
            if(categories.includes("bysykkel")){
                filterBysykkelStationsOnDistance();
            }
            else{
                bysykkelMarkers.forEach(s => {
                    s.setVisible(false);
                })
            }

            if(categories.includes("kollektivt")){
                kMarkers.forEach(s => s.setVisible(true));
            }
            else{
                kMarkers.forEach(s => {
                    s.setVisible(false);
                })
            }
    }

window.onload = function () {
    map = new google.maps.Map(document.getElementById('map'), options);
    initMap();
};

$(".chk-btn").on('change', filterMarkers)

function initMap() {
    findUserPosition();
    findCenter();
    initMarkers();
    initKollektivMarkers();
    initDirections();
    Promise.all([
        bysykkelImportStations(),
        bysykkelLoadAvailability()
    ])
        .then(() => {
            bysykkelStationsWithAvailability();
            initBysykkelMarkers();
        });
    availabilityInterval = setInterval(() => {
            bysykkelLoadAvailability()
        },
        6000);
}

function findCenter() {
    for (var i = 0; i < 4; i++) {
        center.lat += markers[i][1];
        center.lng += markers[i][2];
    }
    center.lng = center.lng / 4;
    center.lat = center.lat / 4;
}

function initMarkers() {
    for (var i = 0; i < markers.length; i++) {

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(markers[i][1], markers[i][2]),
            label: {
                text: markers[i][0],
                color: 'black',
                fontSize: '12px',

            },
            map: map,
            icon: icon = {
                scaledSize: new google.maps.Size(30, 30),
                url: markers[i][5],
                labelOrigin: new google.maps.Point(15, 40)
            }
        });

        marker.setVisible(false);

        if (i < 4) {
            marker.setVisible(true)
        }

        google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {

            var infoWindowContent = (
                '<div    id="window">' +
                '<img    id="infoImg" src=' + markers[i][7] + '>' +
                '<p      id="stedsNavn" class="windowTekst"> ' + markers[i][0] + '</p>' +
                '<p      id="adresse" class="windowTekst"> ' + markers[i][8] + '</p>' +
                '<p      id="apninstidUke" class="windowTekst">' + markers[i][9] + '</p>' +
                '<p      id="apninstidHelg" class="windowTekst">' + markers[i][10] + '</p>' +
                '<button id="bike-btn" class="windowBtnClass" onclick="findDirectionsFromButton(' + i + ', travelModes.bike)">Sy</button>' +
                '<button id="walk-btn"  class="windowBtnClass" onclick="findDirectionsFromButton(' + i + ', travelModes.walk)">Gå</button>' +
                '<button id="drive-btn"  class="windowBtnClass" onclick="findDirectionsFromButton(' + i + ', travelModes.drive)">Mi</button>' +
                '<button id="transit-btn"  class="windowBtnClass" onclick="findDirectionsFromButton(' + i + ', travelModes.transit)">Of</button>' +
                '<button id="info-btn"  class="windowBtnClass" onclick="infoLink(' + i + ')">Mo</button>' +
                '</div>');

            return function () {
                infowindow.setContent(infoWindowContent);
                infowindow.open(map, marker);
            }
        })(marker, i));

        //TODO skal denne være med?
        google.maps.event.addListener(marker, 'mouseout', (function(marker, i){
            setTimeout(function() {
                infowindow.close()},1000);
            }));

        google.maps.event.addListener(map, 'click', (function (marker, i) {
            return function () {
                infowindow.close(map, marker);
            }
        })(marker, i));

        google.maps.event.addListener(infowindow, 'click', (function (marker, i) {
            return function () {
                infowindow.close(map, marker);
            }
        })(marker, i));
        gMarkers[i] = marker

    }
}
    function initBysykkelMarkers() {
        bysykkelMarkers.forEach(marker => {
            marker.setMap(null);
    })
        ;
        bysykkelMarkers = bysykkelStationsWithAvailability().map(s => {
            return new google.maps.Marker({
                position: {
                    lat: s.center.latitude,
                    lng: s.center.longitude
                },
                icon: MapIconGenerator(s.availability.bikes),
                map: this.map,
            })
        }
    )
        bysykkelMarkers.forEach(s => {
            s.setVisible(false);
    })
    }

    function initKollektivMarkers() {
        var kollektivtMarkers = [
            //kollektivt
            ['Heimdalsgata', 59.918500, 10.761413, 'holdeplass', ['fjerdingen'], ['trikk', 'buss'], ['17'], ['30', '31', '31E', 'N390']],
            ['Hausmannsgate', 59.918339, 10.760560, 'holdeplass', ['fjerdingen'], ['trikk', 'buss'], ['11', '12', '13', '17'], ['30', '31', '31E', 'N11', 'N12', 'N390']],
            ['Lakkegata skole', 59.920629, 10.768365, 'holdeplass', ['fjerdingen'], ['trikk', 'buss'], ['17'], ['31', '31E', 'N390']],
            ['Vahls gate', 59.916069, 10.763558, 'holdeplass', ['fjerdingen'], ['buss'], [], ['380', '390', '390E'], []],
            ['Grønland T-bane', 59.918339, 10.760560, 'holdeplass', ['fjerdingen'], ['t-bane'], [], [], ['1', '2', '3', '4', '5']],
            ['Brugata', 59.914780, 10.753317, 'holdeplass', ['fjerdingen'], ['trikk', 'buss'], ['11', '12', '13', '17'], ['30', '31', '31E', '34', '54', 'N11', 'N12', 'N390']],
            ['Hammersborggata', 59.915000, 10.752212, 'holdeplass', ['fjerdingen'], ['buss'], [], ['150', '160', '250', '250E', '255E', '265E', 'N1', 'N2', 'N11', 'N18', 'N130', 'N140', 'N250']],
            ['Dronningensgate', 59.910753, 10.746503, 'holdeplass', ['kvadradturen'], ['trikk'], ['12', '13', '19'], [], []],
            ['Øvre Slottsgate', 59.912216, 10.741954, 'holdeplass', ['kvadradturen'], ['trikk'], ['12', '13', '19'], [], []],
            ['Wessels Plass', 59.912087, 10.738758, 'holdeplass', ['kvadradturen'], ['trikk'], ['12', '13', '19'], [], []],
            ['Stortinget', 59.913797, 10.740925, 'holdeplass', ['kvadradturen'], ['t-bane'], [], [], ['1', '2', '3', '4', '5']],
            ['Møllerveien', 59.920786, 10.751499, 'holdeplass', ['vulkan'], ['buss'], ['34', '54']],
            ['Schous Plass', 59.921044, 10.759481, 'holdeplass', ['vulkan', 'fjerdingen'], ['trikk'], ['11', '12', '13', '19']],
            ['Jernbanetorget', 59.912022, 10.750408, 'holdeplass', ['fjerdingen', 'kvadradturen', 'vulkan', 'brenneriveien'], ['trikk', 'buss', 't-bane'], ['11', '12', '13', '17', '18', '19'], ['30', '31', '31E', '36E', '54', 'N5', 'N12', 'N30'], ['1', '2', '3', '4', '5']]
        ];

        for (var j = 0; j < kollektivtMarkers.length; j++) {
            var marker = new google.maps.Marker({
                position: {
                    lat: kollektivtMarkers[j][1],
                    lng: kollektivtMarkers[j][2]
                },
                map: this.map,
            })
            kMarkers.push(marker);

            marker.setVisible(false);

            google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {

                var trikkIconSrc = '<img src="bar-marker.png"></img>';
                var bussIconSrc = '<img src="bar-marker.png"></img>';
                var tbaneIconSrc = '<img src="bar-marker.png"></img>';


                var trikkDivString = '';
                var bussDivString = '';
                var tbaneDivString = '';
                var infoWindowHtml = '';

                if (kollektivtMarkers[j][5].includes('trikk')) {
                    trikkDivString = '<div id="trikkDiv">' + trikkIconSrc;

                    if (kollektivtMarkers[j][6] !== undefined) {
                        kollektivtMarkers[j][6].forEach(s => {
                            if(s !== undefined
                    )
                        {
                            trikkDivString += '<div class="boks">' + s + '</div>'
                        }
                    })
                        ;
                        trikkDivString += '</div>';
                    }
                }

                if (kollektivtMarkers[j][5].includes('buss')) {
                    bussDivString = '<div id="bussDiv">' + bussIconSrc;

                    if (kollektivtMarkers[j][7] !== undefined) {
                        kollektivtMarkers[j][7].forEach(s => {
                            if(s !== undefined
                    )
                        {
                            bussDivString += '<div class="boks">' + s + '</div>'
                        }
                    })
                        ;
                        bussDivString += '</div>';
                    }
                }

                if (kollektivtMarkers[j][5].includes('t-bane')) {
                    tbaneDivString = '<div id="tbaneDiv">' + tbaneIconSrc;

                    if (kollektivtMarkers[j][8] !== undefined) {
                        kollektivtMarkers[j][8].forEach(s => {
                            if(s !== undefined
                    )
                        {
                            tbaneDivString += '<div class="boks">' + s + '</div>'
                        }
                    })
                        ;
                        tbaneDivString += '</div>';
                    }
                }

                infoWindowHtml = trikkDivString + bussDivString + tbaneDivString;

                var infoWindowContent = ('<h1>' + kollektivtMarkers[i][0] + '</h1>' + infoWindowHtml);

                return function () {
                    infowindow.setContent(infoWindowContent);
                    infowindow.open(map, marker);
                }
            })(marker, j));

        }
    }

function clearFilters() {
    $('.chk-btn#clear').prop('checked', true); // Checks it
    $('.chk-btn').prop('checked', false); // Checks it
    $('.chk-btn#school').prop('checked', true); // Checks it

    filterMarkers();
}

function findUserPosition() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var infoWindow = new google.maps.Marker(
                {
                    position: pos,
                    map: this.map,
                    title: "Her er du",
                    icon: userMarker = {
                        scaledSize: new google.maps.Size(20, 20),
                        url: "blaa-dot.png",
                        labelOrigin: new google.maps.Point(10, 26)
                    },
                    label: {
                        text: 'Her er du',
                        color: 'black',
                        fontSize: '10px',

                    },
                }
            );
            this.map.setCenter(center);
            userPosition = pos;
            userMarker = new google.maps.Marker({
                position: userPosition,
            });
        })
        }
    }

    function initDirections() {
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        /*
        document.getElementById('mode').addEventListener('change', function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
        */
    }

    function findDirectionsFromButton(i, travelMode) {
        var directionRequest = {
            origin: userPosition,
            destination: {
                lat: markers[i][1],
                lng: markers[i][2]
            },
            travelMode: travelMode,
            provideRouteAlternatives: true
        };
        directionsService.route(directionRequest,
            function (response, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        infowindow.close();
    }

    function infoLink(markerNumber) {
        console.log(markerNumber);

        for (var i = 0; i < markers.length; i++) {
            if (markerNumber === markers[i][3]) {
                window.location.replace(markers[i][6]);
            }
        }
        infowindow.close();
    }

//Bysykkel
    function bysykkelImportStations() {
        return axios.get('http://188.166.72.34:8080/stations')
            .then(response => {
            stations = response.data;
    })
    .
        catch(e => {
            this.errors.push(e);
    })
        ;

    }

    function bysykkelLoadAvailability() {
        return axios.get('http://188.166.72.34:8080/stations/availability/')
            .then(response => {
            availability = response.data.reduce((result, item) => {
                result[item.id] = item;
        return result;
    },
        {
        }
    )
        ;
    })
    .
        catch(e => {
            this.errors.push(e);
    })
        ;
    }

    function bysykkelStationsWithAvailability() {
        return stations.map(station => {
            return {...station, availability: availability[station.id]
        }
    })
    }

    function MapIconGenerator(text = null, theme = defaultTheme) {
        text = '' + text
        if (text === '0') {
            theme = themes.noBikes;
        }
        else {
            theme = themes.defaultTheme
        }

        const circle = generateCircle(theme)
        if (text !== null) {
            const context = circle.getContext('2d')
            text = text.substring(0, 3)
            context.beginPath()
            context.font = font
            const textSize = textDimension(text, font, config.size)
            context.fillStyle = theme.text
            context.fillText(text, config.size / 2 - textSize.width / 2 - textSize.xDelta, config.size / 2 + textSize.height / 2)
        }
        return {
            url: circle.toDataURL(),
            scaledSize: {
                height: config.size / 3,
                width: config.size / 3
            }
        }
    }

    function filterBysykkelStationsOnDistance() {

        var markersToFilterBysykkelMarkers = gMarkers.map(m => {
                if(((google.maps.geometry.spherical.computeDistanceBetween(m.getPosition(), fjerdingenMarker.getPosition())) === 0) ||
            ((google.maps.geometry.spherical.computeDistanceBetween(m.getPosition(), vulkanMarker.getPosition())) === 0) ||
            ((google.maps.geometry.spherical.computeDistanceBetween(m.getPosition(), kvadratturenMarker.getPosition())) === 0) ||
            ((google.maps.geometry.spherical.computeDistanceBetween(m.getPosition(), brenneriveienMarker.getPosition())) === 0)
    )
        {
            return m;
        }
    }).
        filter(m => {
            return m !== undefined;
    })
        ;

        markersToFilterBysykkelMarkers.forEach(s => {
            if(s === undefined
    )
        {
            console.log('hei');
        }
    })
        ;

        bysykkelMarkers.forEach(s => {
            if(s === undefined
    )
        {
            console.log('hei');
        }
    })
        ;

        bysykkelMarkers.forEach(bysykkelMarker => {
            markersToFilterBysykkelMarkers.forEach(marker => {
            if((google.maps.geometry.spherical.computeDistanceBetween(marker.getPosition(), bysykkelMarker.getPosition()) < 450) ||
        (google.maps.geometry.spherical.computeDistanceBetween(userMarker.getPosition(), bysykkelMarker.getPosition()) < 450)
    )
        {
            bysykkelMarker.setVisible(true);
        }
    })
    })
        ;


    }







