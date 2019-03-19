<?php
//check that all feilds are set and user is logged in
$droneData = array_filter($_POST);
if(array_filter($_POST) && isset($_SESSION['user']) && 1 == 2)
{   
    require_once($root."php/drone/droneClass.php");
    $drone = new drone();
    $droneID = $drone->insertDroneMainData($_SESSION['user'],$droneData['DroneName']);
    if($droneID)
    {
        //insert drone designation
        if($drone->addDesegnation($droneID,$droneData['ModelName'],$droneData['Manufacturer'],$droneData['DroneType']))
        {   //insert drone characteristics
            if($drone->addCharacteristics($droneID,$droneData['FlightModes'],$droneData['MaxOperatingSpeed'],$droneData['LaunchType'],$droneData['maxFlightTime']))
            {   //insert environmental limits
                
                if($drone->addEnvLimits($droneID,$droneData['MaxHeight'],$droneData['MaxRadius'],$droneData['MaxWind'],$droneData['TempRangeMin'],$droneData['TempRangeMax'],$droneData['OperatingWeather']))
                {  //insert tech specs
                    if($drone->addTechSpecs($droneID,$droneData['Height'],$droneData['Width'],$droneData['Length'],$droneData['Weight'],$droneData['MaxTakeOffWeight'],$droneData['MotorType'],$droneData['MotorSpeed'],$droneData['ControlDataLink'],$droneData['VideoDataLink'],$droneData['FlightController']))
                    {   //insert remote pilot station details
                        if($drone->addRPSDetails($droneID,$droneData['DataLink'],$droneData['VideoLink'],$droneData['AntennaType']))
                        {   //insert payload
                            if($drone->addPayloadDetails($droneID,$droneData['PayloadName'],$droneData['PayloadMinTemp'],$droneData['PayloadMaxTemp']))
                            {
                            $droneAdded = true;
                            }
                        }
                    }
                }

            }

        }
        //delete records if a partial faliure occoured
        if(!droneAdded)
        {
            if($droneID)
            {
                $drone->deleteDrone($droneID);
            }
            $errMsg = "there was an error adding the drone!";
        }
    }
    
}
else
{
    $errMsg = "Please complete the form!";
}
  


?>