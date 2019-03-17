function initMap()
{
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 52.5, lng: -2.5},
        zoom: 5,
        mapTypeId: 'hybrid',
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        fullscreenControl: false
      });

          
}
