$("#getWeather").click(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos){
            getWeather(pos.coords.latitude,pos.coords.longitude);
        },
        //failiure
        getIPWeather());
      }
      else 
      {
        getIPWeather()
      }   
});
function getIPWeather()
{

}
function getWeather(lat, long)
{

    $.ajax({
        //api key: 6a234ab97760be692958e294d6cb512f
        url: "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=166826fbc7bd89eac6c5fabcde57e926",
        success: function (weatherResult)
        {
            test = weatherResult;
            $.ajax({
                url:"php/getDroneEnvDetails.php",
                type:"POST",
                
            })

        },
        fail:function()
        {
            alert("unable to get weather!");
        }

    });

}