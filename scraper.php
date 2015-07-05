<?php
    chdir(__DIR__);
    require_once("settings.php");
    require_once("utils.php");
    require_once("./classes/temperatures.php");
    require_once("./classes/humidity.php");
    $temp = new Temperatures();
    $humid = new Humidity();
   // $temp->get_temperatures();
    Utils::delog("Outside:" . $temp->get_Outside());
    Utils::delog("Roof:" . $temp->get_Roof());
    Utils::delog("Desired Lounge:" . $temp->get_DesiredLounge());
    Utils::delog("Desired Bedroom:" . $temp->get_DesiredBedroom());
    Utils::delog("Lounge:" . $temp->get_Lounge());
    Utils::delog("Bedroom:" . $temp->get_Bedroom());
    
    Utils::delog("HOutside:" . $humid->get_Outside());
    Utils::delog("HRoof" . $humid->get_Roof());
    Utils::delog("HDesiredLounge" . $humid->get_DesiredLounge());
    Utils::delog("HDesiredBedRoom" . $humid->get_DesiredBedroom());
    Utils::delog("HLounge:" . $humid->get_Lounge());
    Utils::delog("HBedroom:" . $humid->get_Bedroom());
     Utils::delog("HRelays:" . $humid->get_Relays());
    Utils::delog("HFan:" . $humid->get_Fan());
    Utils::delog("HAirSource:" . $humid->get_AirSource()); 
    
    // add to database
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $values = array('outsidetemp' => $temp->get_Outside(),
                    'time' => date('Y-m-d H:i:s'),
                    'rooftemp' => $temp->get_Roof(),
                    'desiredloungetemp' =>  $temp->get_DesiredLounge(),
                    'desiredbedroomtemp' => $temp->get_DesiredBedroom(),
                    'loungetemp' => $temp->get_Lounge(),
                    'bedroomtemp' => $temp->get_Bedroom(),
                    'outsidehumid' => $humid->get_Outside(),
                    'roofhumid' => $humid->get_Roof(),
                    'desiredloungehumid' => $humid->get_DesiredLounge(),
                    'desiredbedroomhumid' => $humid->get_DesiredBedroom(),
                    'loungehumid' => $humid->get_Lounge(),
                    'bedroomhumid' => $humid->get_Bedroom(),
                    'fan' => $humid->get_Fan(),
                    'airsource' => $humid->get_AirSource(),
                );
    $sql = "INSERT INTO logging (`time`, `outside_temp`, `roof_temp`, `desiredlounge_temp`, `desiredbedroom_temp`, `lounge_temp`, `bedroom_temp`, `outside_humid`, `roof_humid`, `desiredlounge_humid`, `desiredbedroom_humid`, `lounge_humid`, `bedroom_humid`, `fan`, `airsource`) VALUES (:time, :outsidetemp, :rooftemp, :desiredloungetemp, :desiredbedroomtemp, :loungetemp, :bedroomtemp, :outsidehumid, :roofhumid, :desiredloungehumid, :desiredbedroomhumid, :loungehumid, :bedroomhumid, :fan, :airsource)";
    $query = $db->prepare($sql);
    $query->execute($values);
    
?>