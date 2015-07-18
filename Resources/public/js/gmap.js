(function($) {
  $.fn.gMapType = function(settings) {
    return this.each(function() {
      var mapElement = $(this);
      mapElement.data('map', new GoogleMap(settings, mapElement));
      mapElement.data('map').initMap();
    });
  };

  function GoogleMap(settings, mapElement) {
    var settings = $.extend({
      'search_input_el': null,
      'search_action_el': null,
      'search_error_el': null,
      'current_position_el': null,
      'default_lat': '1',
      'default_lng': '-1',
      'default_zoom': 5,
      'lat_field': null,
      'lng_field': null,
      'callback': function(location, gmap) {
      },
      'error_callback': function(status) {
        $this.settings.search_error_el.text(status);
      }
    }, settings);
    this.settings = settings;
    this.mapElement = mapElement;
    this.geocoder = new google.maps.Geocoder();
  }

  GoogleMap.prototype = {
    initMap: function(center) {
      var center = new google.maps.LatLng(this.settings.default_lat,
        this.settings.default_lng);
      var mapOptions = {
        zoom: this.settings.default_zoom,
        center: center,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.TERRAIN
      };
      this.map = new google.maps.Map(this.mapElement[0],
        mapOptions);
      this.addMarker(center);
      var $this = this;
      google.maps.event.addListener(this.marker, 'dragend',
        function(event) {
          var point = $this.marker.getPosition();
          $this.map.panTo(point);
          $this.updateLocation(point);
        });
      google.maps.event.addListener(this.map, 'click',
        function(event) {
          $this.insertMarker(event.latLng);
        });
      this.settings.search_action_el.click($.proxy(this.searchAddress,
        $this));
      this.settings.current_position_el.click($.proxy(this.currentPosition,
        $this));
    },
    searchAddress: function(e) {
      e.preventDefault();
      var $this = this;
      var address = this.settings.search_input_el.val();
      this.geocoder.geocode({
        'address': address
      }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          $this.map.setCenter(results[0].geometry
            .location);
          $this.map.setZoom(16);
          $this.insertMarker(results[0].geometry.location);
        } else {
          $this.settings.error_callback(status);
        }
      });
    },
    currentPosition: function(e) {
      e.preventDefault();
      var $this = this;
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var clientPosition = new google.maps.LatLng(
            position.coords.latitude,
            position.coords.longitude);
          $this.insertMarker(clientPosition);
          $this.map.setCenter(clientPosition);
          $this.map.setZoom(16);
        }, function (error) {
          $this.settings.error_callback(error);
        });
      } else {
        $this.settings.search_error_el.text(
          'Your broswer does not support geolocation'
        );
      }
    },
    updateLocation: function (location) {
      this.settings.lat_field.val(location.lat());
      this.settings.lng_field.val(location.lng());
      var $this = this;
      this.geocoder.geocode({
        'latLng': location
      }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          $this.settings.country_field.val($this.getAddressComponent(
            'country', results[0],
            false));
          $this.settings.city_field.val($this.getAddressComponent(
            'locality', results[0],
            false));
          $this.settings.zipcode_field.val($this.getAddressComponent(
            'postal_code', results[0],
            false));
          $this.settings.streetname_field.val(
            $this.getAddressComponent(
              'route', results[0], false)
          );
          $this.settings.streetnumber_field.val(
            $this.getAddressComponent(
              'street_number', results[0],
              false));
        }
      });
      this.settings.callback(location, this);
    },
    addMarker: function(center) {
      if (this.marker) {
        this.marker.setMap(this.map);
        this.marker.setPosition(center);
      } else {
        this.marker = new google.maps.Marker({
          map: this.map,
          position: center,
          draggable: true
        });
      }
    },
    insertMarker: function(position) {
      this.removeMarker();
      this.addMarker(position);
      this.updateLocation(position);
    },
    removeMarker: function() {
      if (this.marker != undefined) {
        this.marker.setMap(null);
      }
    },
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
    getAddressComponent: function(type, geocodeResponse, shortName) {
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
    }
  };
})(jQuery);
