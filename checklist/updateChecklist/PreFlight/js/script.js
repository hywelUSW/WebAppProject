
var temp;
var weatherCond;
var droneCond = DroneEnvDetails.operatingWeather.split(",");
$("#getWeather").click(function(){
   $("#weatherWarnings").remove();
    
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
var coords;
function getIPWeather()
{
$.ajax({
    url: "https://ipinfo.io/json",
    success: function(data){
        coords = (data.loc).split(",");
       $("#weather").append("<p id='IPwarning'>Weather measurement may not be accurate</p>");
        getWeather(coords[0],coords[1]);
        
    },
    fail: function(){
        $("#weatherWarnings").append("<p id='WeatherWarnings'>Could not get weather. Try again later.</p>");
    }
});
}

function getWeather(lat, long)
{
    var weatherWarnings= [];
    $.ajax({
        //api key: 6a234ab97760be692958e294d6cb512f
        url: "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=166826fbc7bd89eac6c5fabcde57e926",
        success: function (weatherResult)
        {
            if(DroneEnvDetails != null)
            {
                //coverrt kelvin to celcius 
                temp = weatherResult.main.temp - 273.15;
                temp = temp.toFixed(2);
                if(DroneEnvDetails.maxWind < weatherResult.wind.speed)
                {
                    weatherWarnings.push("Wind speed is above drone limit!");//" +(weatherResult.wind.speed - DroneEnvDetails.maxWind)+"m/s 
                }
                if(temp > DroneEnvDetails.maxTemp)
                {//too hot
                    weatherWarnings.push("temperature above drone limits");  
                }
                if(temp < DroneEnvDetails.minTemp)
                {//too hot
                    weatherWarnings.push("Temperature below drone limits");  
                }
                if(temp > DroneEnvDetails.payloadMaxTemp)
                {
                    weatherWarnings.push("temperature above payload limits");  
                }
                if(temp < DroneEnvDetails.payloadMinTemp)
                {
                    weatherWarnings.push("Temperature below payload limits");  
                }
                //https://openweathermap.org/weather-conditions
                if(!droneCond.includes(weatherResult.weather[0].main))
                {
                    weatherWarnings.push("Unsafe weather conditions!");
                }
                if(weatherWarnings.length >0)
                {
                   $('#weather').append("<ul id='weatherWarnings'>Warning: weather unsuitable for drone!<br><br></ul>");
                   for(var i = 0; i < weatherWarnings.length;i++)
                   {
                       $("#weatherWarnings").append("<li>"+weatherWarnings[i]+"</li>");
                   }
                }
                else
                {

                }
                $('#weatherCond').text("Weather: " + weatherResult.weather[0].main)
                $('#Temp').text("Temperature: " + temp + "°C");
                $('#windSpeed').text("Wind Speed: " + weatherResult.wind.speed + " m/s");
                weatherCond = [weatherResult.weather[0].main,temp,weatherResult.wind.speed];
                $('input[name=WeatherCheck]').val(weatherCond);
            }
            else
            {
                $('#weatherCond').text("Weather: " + weatherResult.weather[0].main)
                $('#Temp').text("Temperature: " + temp + "°C");
                $('#windSpeed').text("Wind Speed: " + weatherResult.wind.speed + " m/s");
                weatherCond = [weatherResult.weather[0].main,temp,weatherResult.wind.speed];
                $('input[name=WeatherCheck]').val(weatherCond);
            }

        },
        fail:function()
        {
            alert("unable to get weather!");
        }

    });
    

}