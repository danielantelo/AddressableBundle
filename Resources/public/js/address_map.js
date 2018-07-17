function AddressMap(settings) {
    this.settings = settings;

    // find elements
    this.mapCanvas = document.getElementById(this.settings.mapCanvasId);
    this.searchInput = document.getElementById(this.settings.searchInputId);
    this.searchButton = document.getElementById(this.settings.searchButtonId);
    this.searchError = document.getElementById(this.settings.searchErrorId);
    this.currentPosition = document.getElementById(this.settings.currentPositionId);
    this.latField = document.getElementById(this.settings.latFieldId);
    this.lngField = document.getElementById(this.settings.lngFieldId);
    this.countryField = document.getElementById(this.settings.countryFieldId);
    this.countryFieldAsShortCode = this.settings.countryFieldAsShortCode;
    this.zipCodeField = document.getElementById(this.settings.zipCodeFieldId);
    this.streetNameField = document.getElementById(this.settings.streetNameFieldId);
    this.streetNumberField = document.getElementById(this.settings.streetNumberFieldId);
    this.cityField = document.getElementById(this.settings.cityFieldId);
    this.administrativeAreaLevel1Field = document.getElementById(this.settings.administrativeAreaLevel1FieldId);
    this.administrativeAreaLevel2Field = document.getElementById(this.settings.administrativeAreaLevel2FieldId);
}

AddressMap.prototype.init = function() {
    // load google maps if not present, and proceed to create maps
    if (typeof google === 'object' && typeof google.maps === 'object') {
        this.handleGoogleMapApiReady();
    } else {
        var script = document.createElement("script");
        script.type = 'text/javascript';
        script.src = '//maps.google.com/maps/api/js?v=3.25&key=' + this.settings.googleApiKey + '&callback=' + this.settings.googleMapsLoadedCallback;
        document.body.appendChild(script);
    }

    // set callback functions for api errors
    var _self = this;
    this.settings['errorCallback'] = function(message) {
        _self.searchError.innerHTML = message;
    };
};

AddressMap.prototype.handleGoogleMapApiReady = function() {
    this.geocoder = new google.maps.Geocoder();

    var center = new google.maps.LatLng(this.settings.defaultLat, this.settings.defaultLng);
    var mapOptions = {
        zoom: this.settings.defaultZoom,
        center: center,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    this.map = new google.maps.Map(this.mapCanvas, mapOptions);

    this.addMarker(center);

    this.bindUseCurrentPositionEvent();
    this.bindSearchAddressEvent();
    this.bindMarkerEvents();
};

AddressMap.prototype.bindUseCurrentPositionEvent = function() {
    var _self = this;
    if (!this.currentPosition) {
        return;
    }
    
    this.currentPosition.onclick = function(event) {
        event.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var position = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                _self.addMarker(position);
                _self.updateLocation(position);
                _self.map.setCenter(position);
                _self.map.setZoom(16);
            }, function (error) {
                _self.settings.error_callback(error);
            });
        } else {
            _self.settings.search_error_el.text(
                'Your browser does not support geolocation'
            );
        }
    };
};

AddressMap.prototype.bindSearchAddressEvent = function() {
    var _self = this;
    this.searchButton.onclick = function(event) {
        event.preventDefault();
        var address = _self.searchInput.value;
        _self.geocoder.geocode({
            'address': address
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var position = results[0].geometry.location;
                _self.addMarker(position);
                _self.updateLocation(position);
                _self.map.setCenter(position);
                _self.map.setZoom(16);
            } else {
                _self.settings.error_callback(status);
            }
        });
    };
};

AddressMap.prototype.bindMarkerEvents = function() {
    var _self = this;
    google.maps.event.addListener(this.marker, 'dragend', function() {
        var point = _self.marker.getPosition();
        _self.map.panTo(point);
        _self.updateLocation(point);
    });
};

AddressMap.prototype.addMarker = function(position) {
    if (this.marker) {
        this.marker.setMap(this.map);
        this.marker.setPosition(position);
    } else {
        this.marker = new google.maps.Marker({
            map: this.map,
            position: position,
            draggable: true
        });
    }
};

AddressMap.prototype.updateLocation = function(location) {
    this.latField.value = location.lat();
    this.lngField.value = location.lng();
    var _self = this;
    this.geocoder.geocode({
        'latLng': location
    }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            _self.countryField.value = _self.getAddressComponent('country', results[0], _self.countryFieldAsShortCode);
            // this is needed by several select niceners (select2 chozen etc)
            _self.countryField.dispatchEvent(new Event('change'));
            _self.cityField.value = _self.getAddressComponent('locality', results[0], false);
            _self.zipCodeField.value = _self.getAddressComponent('postal_code', results[0], false);
            _self.streetNameField.value = _self.getAddressComponent('route', results[0], false);
            _self.streetNumberField.value = _self.getAddressComponent('street_number', results[0], false);
            _self.administrativeAreaLevel1Field.value = _self.getAddressComponent('administrative_area_level_1', results[0], false);
            _self.administrativeAreaLevel2Field.value = _self.getAddressComponent('administrative_area_level_2', results[0], false);
            // execute any custom callback code
            _self.settings.callback(location, _self);
        }
    });
};

/**
 *   geocodeResponse is an object full of address data.
 *   This function will "fish" for the right value
 *
 *   example: type = 'postal_code' =>
 *   geocodeResponse.address_components[5].types[1] = 'postal_code'
 *   geocodeResponse.address_components[5].long_name = '1000'
 *
 *   type = 'route' =>
 *   geocodeResponse.address_components[1].types[1] = 'route'
 *   geocodeResponse.address_components[1].long_name = 'Wetstraat'
 */
AddressMap.prototype.getAddressComponent = function(type, geocodeResponse, shortName) {
    for (var i = 0; i < geocodeResponse.address_components.length; i++) {
        for (var j = 0; j < geocodeResponse.address_components[i].types.length; j++) {
            if (geocodeResponse.address_components[i].types[j] === type) {
                if (shortName) {
                    return geocodeResponse.address_components[i].short_name;
                } else {
                    return geocodeResponse.address_components[i].long_name;
                }
            }
        }
    }
    return '';
};
