<?php
require("/students/15080900/projectapp/php/initalise.php");
require_once("droneClass.php");
//check that all feilds are set and user is logged in
if(array_filter($_POST) && isset($_SESSION['user']))
{
    $drone = new drone();
    $droneID = $drone->AddDrone($_SESSION['user'],$_POST['DroneName']);
    //$droneID = $drone->insertDroneMainData(16,"test");
    
    if($droneID)
    {
        //insert drone designation
        if($drone->addDesegnation($droneID,$_POST['ModelName'],$_POST['Manufacturer'],$_POST['DroneType']))
        {   //insert drone characteristics
            if($drone->addCharacteristics($droneID,$_POST['FlightModes'],$_POST['MaxOperatingSpeed'],$_POST['LaunchType'],$_POST['maxFlightTime']))
            {   //insert environmental limits
                
                if($drone->addEnvLimits($droneID,$_POST['MaxHeight'],$_POST['MaxRadius'],$_POST['MaxWind'],$_POST['TempRangeMin'],$_POST['TempRangeMax'],$_POST['OperatingWeather']))
                {   //insert battery specs
                    
                    if($drone->addBatterySpecs($droneID,$_POST['Chemistry'],$_POST['BatteryWeight'],$_POST['PowerOutput']))
                    {   //insert tech specs
                        if($drone->addTechSpecs($droneID,$_POST['Height'],$_POST['Width'],$_POST['Length'],$_POST['Weight'],$_POST['MaxTakeOffWeight'],$_POST['MotorType'],$_POST['MotorSpeed'],$_POST['ControlDataLink'],$_POST['VideoDataLink'],$_POST['FlightController']))
                        {   //insert remote pilot station details
                            if($drone->addRPSDetails($droneID,$_POST['DataLink'],$_POST['VideoLink'],$_POST['AntennaType']))
                            {   //insert payload
                                if($drone->addPayloadDetails($droneID,$_POST['PayloadName'],$_POST['PayloadMinTemp'],$_POST['PayloadMaxTemp']))
                                {
                                  echo "it WORKS";
                                }else
                                {
                            
                                }
                                
                            }else
                            {
                        
                            }

                        }else
                        {
                    
                        }

                    }else
                    {
                
                    }

                }else
                {
            
                }

            }else
            {
        
            }

        }else
        {
    
        }

    }
    else
    {

    }
}




?>