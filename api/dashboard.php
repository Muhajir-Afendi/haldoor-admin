<?php

    session_start();
    header("Content-Type:application/json");

    $response = array();
    $temp = array();
    $data = array();

    require_once "./authorization.php";
    require_once "./config.php";

    // Check if user is legitimate
    if (check_admin_api()) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Modals
            $fetch_modal = "SELECT IFNULL(count(id), 0) AS graduations, (SELECT IFNULL(count(id), 0) AS graduations from keynotes) AS keynotes, (SELECT IFNULL(count(id), 0) AS achievements from achievements) AS achievements FROM graduations";
            
            $stmt = $conn -> prepare($fetch_modal);
            $stmt->execute();
            $stmt->store_result();
                    
            if ($stmt->num_rows === 0) {
                $response['error'] = true;
            }
            else   {

                $stmt->bind_result($graduations, $keynotes, $achievements);
                
                $response['error'] = false;
                $response['message'] = 'fetched successfully'; 

                // output data of each row
                while($stmt->fetch()) 
                {
                    
                    $temp['graduations']  = $graduations;
                    $temp['keynotes']  = $keynotes;
                    $temp['achievements']  = $achievements;
                    
                    //Push the data to the array
                    array_push($data,$temp);
                }

                // Data assign to response
                $response['data'] = $data;

            }
            

        }    
        else {
            $response['error'] = true;
            $response['message'] = 'Invalid request Please try again';
        }

    }
    else {
        $response['error'] = true;
        $response['message'] = 'Invalid request Please try again';
    }


    $json_response = json_encode($response);
    echo $json_response; 

?>