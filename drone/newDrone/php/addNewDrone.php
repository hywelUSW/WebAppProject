<?php
//check that all feilds are set and user is logged in
if(array_filter($_POST) && isset($_SESSION['user']))
{   
    require_once($root."php/drone/droneClass.php");
    $drone = new drone();
    $droneID = $drone->insertDroneMainData($_SESSION['user'],$_POST['DroneName']);
    if($droneID)
    {
        //insert drone designation
        if($drone->addDesegnation($droneID,$_POST['ModelName'],$_POST['Manufacturer'],$_POST['DroneType']))
        {   //insert drone characteristics
            if($drone->addCharacteristics($droneID,$_POST['FlightModes'],$_POST['MaxOperatingSpeed'],$_POST['LaunchType'],$_POST['maxFlightTime']))
            {   //insert environmental limits
                
                if($drone->addEnvLimits($droneID,$_POST['MaxHeight'],$_POST['MaxRadius'],$_POST['MaxWind'],$_POST['TempRangeMin'],$_POST['TempRangeMax'],$_POST['OperatingWeather']))
                {  //insert tech specs
                    if($drone->addTechSpecs($droneID,$_POST['Height'],$_POST['Width'],$_POST['Length'],$_POST['Weight'],$_POST['MaxTakeOffWeight'],$_POST['MotorType'],$_POST['MotorSpeed'],$_POST['ControlDataLink'],$_POST['VideoDataLink'],$_POST['FlightController']))
                    {   //insert remote pilot station details
                        if($drone->addRPSDetails($droneID,$_POST['DataLink'],$_POST['VideoLink'],$_POST['AntennaType']))
                        {   //insert payload
                            if($drone->addPayloadDetails($droneID,$_POST['PayloadName'],$_POST['PayloadMinTemp'],$_POST['PayloadMaxTemp']))
                            {
                            $droneAdded = true;
                            }
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

?>