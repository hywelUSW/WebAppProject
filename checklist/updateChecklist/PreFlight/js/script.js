$("#getWeather").click(function(){
    $.ajax({
        url:
    });
});
function constructURL()
{
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos){

        },
        function(){//Geolocate failed

        });
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
   var url =  "api.openweathermap.org/data/2.5/forecast/daily?lat="+lat+"&lon="+long+"&cnt=1";
}