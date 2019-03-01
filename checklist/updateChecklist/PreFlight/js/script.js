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
var weatherWarnings= [];
var temp;
var weatherCond;
function getWeather(lat, long)
{
    
    
    $.ajax({
        //api key: 6a234ab97760be692958e294d6cb512f
        url: "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=166826fbc7bd89eac6c5fabcde57e926",
        success: function (weatherResult)
        {
            if(DroneEnvDetails != null)
            {
                
                temp = weatherResult.main.temp - 273.15;
                temp = temp.toFixed(2);
                if(DroneEnvDetails.maxWind < weatherResult.wind.speed)
                {
                    weatherWarnings.push("Wind speed is" +(weatherResult.wind.speed - DroneEnvDetails.maxWind)+"m/s above drone limit!");
                }
                if(temp > DroneEnvDetails.maxTemp)
                {//too hot
                    weatherWarnings.push();  
                }
                if(temp < DroneEnvDetails.minTemp)
                {//too hot
                    weatherWarnings.push();  
                }
                if(temp > DroneEnvDetails.payloadMaxTemp)
                {
                    weatherWarnings.push();  
                }
                if(temp < DroneEnvDetails.payloadMinTemp)
                {
                    weatherWarnings.push();  
                }
                //https://openweathermap.org/weather-conditions
                
                if(weatherWarnings.length == 0)
                {
                   
                }
                else
                {

                }
                $('#weatherCond').text("Weather: " + weatherResult.weather[0].main)
                $('#Temp').text("Temperature: " + temp + "°C");
                $('#windSpeed').text("Wind Speed: " + weatherResult.wind.speed + " m/s");
                weatherCond = [weatherResult.weather[0].main,temp,weatherResult.wind.speed];
                $('input[name=WeatherCheck]').val(weatherCond);
                test = weatherResult;
            }
            else
            {
                //drone details not available!
            }

        },
        fail:function()
        {
            alert("unable to get weather!");
        }

    });
    

}