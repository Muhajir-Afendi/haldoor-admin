<?php

    session_start();
    header("Content-Type:application/json");

    $response = array();
    $temp = array();
    $data = array();

    //  Validations
    require_once 'validator.php';
    $validator = new users_validator;

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
                    $fetch_modal = "SELECT `id`, `name`, `email` FROM `users` LIMIT ?,$singlePageRows";
                    $totalRows_modal = "SELECT COUNT(*) AS total_rows FROM users";

                    $start_from = intval($page_no);
                    $start_from = ($page_no * $singlePageRows) - $singlePageRows ;
                    
                    $stmt = $conn -> prepare($fetch_modal);
                    $stmt->bind_param("s", $start_from);

                    $stmt->execute();

                    $stmt->store_result();
                            
                    if ($stmt->num_rows === 0) {
                        $response['error'] = true;
                        $response['message'] = 'There are no registered users !!';
                    }
                    else
                    {

                        $stmt->bind_result($id, $name, $email);
                        
                        $response['error'] = false;
                        $response['message'] = 'fetched successfully'; 

                        // output data of each row
                        while($stmt->fetch()) 
                        {
                            
                            $temp['id']  = $id;
                            $temp['name']  = $name;
                            $temp['email']  = $email;
                            
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
                    $search_modal = "SELECT `id`, `name`, `email` FROM `users` WHERE `name` LIKE ? OR `email` LIKE ? LIMIT $singlePageRows";
                    $stmt = $conn -> prepare($search_modal);
                    $stmt->bind_param("ss", $searching_text, $searching_text);

                    $stmt->execute();

                    $stmt->store_result();
                            
                    if ($stmt->num_rows === 0) {
                        $response['error'] = true;
                        $response['message'] = 'Not found  !!';
                    }
                    else
                    {

                        $stmt->bind_result($id, $name, $email);
                        
                        $response['error'] = false;
                        $response['message'] = 'fetched successfully'; 

                        // output data of each row
                        while($stmt->fetch()) 
                        {
                            
                            $temp['id']  = $id;
                            $temp['name']  = $name;
                            $temp['email']  = $email;
                            
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
            
            // New
            else if(isset($_POST['action']) && $_POST['action'] === "new") {
                            
                // Validations
                $validation = $validator->new_user_validations($_POST);

                // If Validation Is success
                if (gettype($validation) === "array") {
                                
                    $name = $validation["name"];
                    $email = $validation["email"];
                    $password = $validation["password"];

                    // Hash Password
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $INSERT = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (?,?,?)";
                    $stmt = $conn -> prepare($INSERT);
                    $stmt->bind_param("sss", $name, $email, $password);

                    if($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'Saved Successfully';            
                    }

                    else {

                        if(mysqli_errno($conn) === 1062) {
                            $response['error'] = true;
                            $response['message'] = 'This user already registered <br> PLEASE CHECK AND TRY AGAIN '; 
                        }
                        else {
                            $response['error'] = true;
                            $response['message'] = 'Please check your enteries and try again !!';
                        }

                    }    

                }
                else {
                    $response['error'] = true;
                    $response['message'] = $validation;
                }

            }
            
            // Edit
            else if(isset($_POST['action']) && $_POST['action'] === "edit") {

                // Validations
                $validation = $validator->edit_user_validations($_POST);

                // If Validation Is success
                if (gettype($validation) === "array") {
                    
                    $id = $validation["editing_id"];
                    $name = $validation["name"];
                    $email = $validation["email"];
                    $password = $validation["password"];
        
                    if ($password === "") {
                        $UPDATE = "UPDATE `users` SET `name`=?,`email`=? WHERE `id`=?";
                        $stmt = $conn -> prepare($UPDATE);
                        $stmt->bind_param("sss", $name, $email, $id);    
                    }
                    else {

                        // Hash Password
                        $password = password_hash($password, PASSWORD_DEFAULT);

                        $UPDATE = "UPDATE `users` SET `name`=?,`email`=?,`password`=? WHERE `id`=?";
                        $stmt = $conn -> prepare($UPDATE);
                        $stmt->bind_param("ssss", $name, $email, $password, $id);    
                    }

                
                    if($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'Updated Successfully';            
                    }

                    else {

                        if(mysqli_errno($conn) === 1062) {
                            $response['error'] = true;
                            $response['message'] = 'This user info is already registered by another user <br> PLEASE CHECK AND TRY AGAIN '; 
                        }
                        else {
                            $response['error'] = true;
                            $response['message'] = 'Please check your enteries and try again !!';
                        }

                    }    
                            
                }
                else {
                    $response['error'] = true;
                    $response['message'] = $validation;
                }

            }
            
            // Delete
            else if(isset($_POST['action']) && $_POST['action'] === "remove") {

                // Validations
                $validation = $validator->delete_user_validations($_POST);

                // If Validation Is success
                if (gettype($validation) === "array") {                

                    $deleting_id = $validation['deleting_id'];

                    $DELETE = "DELETE FROM `users` WHERE `id` = ?";
                    $stmt = $conn -> prepare($DELETE);
                    $stmt->bind_param("s", $deleting_id);

                    if($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'Removed Successfully';            
                    }

                    else {

                        $response['error'] = true;
                        $response['message'] = 'Please check your enteries and try again !!';
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