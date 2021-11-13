<?php

    session_start();
    header("Content-Type:application/json");

    $response = array();
    $temp = array();
    $data = array();

    //  Validations
    require_once 'validator.php';
    $validator = new contacts_validator;

    $singlePageRows = 10;

    require_once "./authorization.php";
    require_once "./config.php";

    // Check if user is legitimate
    if (check_admin_api()) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Fetch data
            if(isset($_POST['action']) && $_POST['action'] === "fetch") {

                // Validations
                $validation = $validator->page_validations($_POST);

                // If Validation Is success
                if (gettype($validation) === "array") {
                                
                    $page_no = $validation["page_no"];

                    // Modals
                    $fetch_modal = "SELECT `id`, `name`, `email`, `subject`, `message` FROM `contacts` LIMIT ?,$singlePageRows";
                    $totalRows_modal = "SELECT COUNT(*) AS total_rows FROM contacts";

                    $start_from = intval($page_no);
                    $start_from = ($page_no * $singlePageRows) - $singlePageRows ;
                    
                    $stmt = $conn -> prepare($fetch_modal);
                    $stmt->bind_param("s", $start_from);

                    $stmt->execute();

                    $stmt->store_result();
                            
                    if ($stmt->num_rows === 0) {
                        $response['error'] = true;
                        $response['message'] = 'There are no registered contacts !!';
                    }
                    else
                    {

                        $stmt->bind_result($id, $name, $email, $subject, $message);
                        
                        $response['error'] = false;
                        $response['message'] = 'fetched successfully'; 

                        // output data of each row
                        while($stmt->fetch()) 
                        {
                            
                            $temp['id']  = $id;
                            $temp['name']  = $name;
                            $temp['email']  = $email;
                            $temp['subject'] = $subject;
                            $temp['message'] = $message;
                            
                            //Push the data to the array
                            array_push($data,$temp);
                        }

                        // Data assign to response
                        $response['data'] = $data;

                        // Pagination
                        $totalRows = $totalRows_modal;
                        $execs = $conn -> prepare($totalRows);

                        $execs->execute();
                        $execs->store_result();

                        $execs->bind_result($total_rows);
                        $execs->fetch();
                        
                        $response['pageNo']= $page_no;
                        $response['totalRows'] = $total_rows;
                        $response['singlePageRows'] = $singlePageRows;

                    }

                }
                else {
                    $response['error'] = true;
                    $response['message'] = $validation;
                }

            }

            // Search
            else if(isset($_POST['action']) && $_POST['action'] === "search") {

                // Validations
                $validation = $validator->search_validations($_POST);

                // If Validation Is success
                if (gettype($validation) === "array") {
                                
                    $searching_text = $validation["searching_text"];
                    
                    // Modal
                    $search_modal = "SELECT `id`, `name`, `email`, `subject`, `message` FROM `contacts` WHERE `name` LIKE ? OR `email` LIKE ? OR `subject` LIKE ? OR `message` LIKE ? LIMIT $singlePageRows";
                    $stmt = $conn -> prepare($search_modal);
                    $stmt->bind_param("ssss", $searching_text, $searching_text, $searching_text, $searching_text);

                    $stmt->execute();

                    $stmt->store_result();
                            
                    if ($stmt->num_rows === 0) {
                        $response['error'] = true;
                        $response['message'] = 'Not found  !!';
                    }
                    else
                    {

                        $stmt->bind_result($id, $name, $email, $subject, $message);
                        
                        $response['error'] = false;
                        $response['message'] = 'fetched successfully'; 

                        // output data of each row
                        while($stmt->fetch()) 
                        {
                            
                            $temp['id']  = $id;
                            $temp['name']  = $name;
                            $temp['email']  = $email;
                            $temp['subject'] = $subject;
                            $temp['message'] = $message;
                            
                            //Push the data to the array
                            array_push($data,$temp);
                        }
            
                        // Data assign to response
                        $response['data'] = $data;

                    }

                }

                else {
                    $response['error'] = true;
                    $response['message'] = $validation;
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

    }
    else {
        $response['error'] = true;
        $response['message'] = 'Invalid request Please try again';
    }


    $json_response = json_encode($response);
    echo $json_response; 

?>