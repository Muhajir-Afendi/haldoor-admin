<?php

    session_start();
    header("Content-Type:application/json");

    $response = array();
    $temp = array();
    $data = array();

    //  Validations
    require_once 'validator.php';
    $validator = new keynotes_validator;

    $singlePageRows = 10;

    // Upload Resource Directory
    $upload_directory = '../uploads/keynotes/'; 

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
                    $fetch_modal = "SELECT `id`, `title`, `body`, `image` FROM `keynotes` LIMIT ?,$singlePageRows";
                    $totalRows_modal = "SELECT COUNT(*) AS total_rows FROM keynotes";

                    $start_from = intval($page_no);
                    $start_from = ($page_no * $singlePageRows) - $singlePageRows ;
                    
                    $stmt = $conn -> prepare($fetch_modal);
                    $stmt->bind_param("s", $start_from);

                    $stmt->execute();

                    $stmt->store_result();
                            
                    if ($stmt->num_rows === 0) {
                        $response['error'] = true;
                        $response['message'] = 'There are no registered keynotes !!';
                    }
                    else
                    {

                        $stmt->bind_result($id, $title, $body, $image);
                        
                        $response['error'] = false;
                        $response['message'] = 'fetched successfully'; 

                        // output data of each row
                        while($stmt->fetch()) 
                        {
                            
                            $temp['id']  = $id;
                            $temp['title']  = $title;
                            $temp['body']  = $body;
                            $temp['image'] = $image;
                            
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
                    $search_modal = "SELECT `id`, `title`, `body`, `image` FROM `keynotes` WHERE `title` LIKE ? OR  `body` LIKE ? LIMIT $singlePageRows";
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

                        $stmt->bind_result($id, $title, $body, $image);
                        
                        $response['error'] = false;
                        $response['message'] = 'fetched successfully'; 

                        // output data of each row
                        while($stmt->fetch()) 
                        {
                            
                            $temp['id']  = $id;
                            $temp['title']  = $title;
                            $temp['body']  = $body;
                            $temp['image'] = $image;
                            
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
                $validation = $validator->new_keynote_validations($_POST);            
                
                // If Validation Is success
                if (gettype($validation) === "array") {
                                
                    $title = $validation["title"];
                    $body = $validation["body"];
        
                    $uploading_file_data = $validation["file_data"];
                    $ext = $validation["file_extension"];
                    $filename = rand(100,100000) .".". $ext;
        
                    $INSERT = "INSERT INTO `keynotes`(`title`, `body`, `image`) VALUES (?,?,?)";
                    $stmt = $conn -> prepare($INSERT);
                    $stmt->bind_param("sss", $title, $body, $filename);

                    if($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'Saved Successfully';
                        
                        // Save The file
                        move_uploaded_file($uploading_file_data,$upload_directory.$filename);

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
            
            // Edit
            else if(isset($_POST['action']) && $_POST['action'] === "edit") {

                // Validations
                $validation = $validator->edit_keynote_validations($_POST);
                
                // If Validation Is success
                if (gettype($validation) === "array") {
                    
                    $editing_id = $validation["editing_id"];
                    $editing_image = $validation["editing_image"];
                    $title = $validation["title"];
                    $body = $validation["body"];
            
                    $new_file_name = $validation["new_file_name"];

                    if ($new_file_name !== "") {

                        $uploading_file_data = $validation["file_data"];
                        $ext = $validation["file_extension"];
                        $filename = rand(100,100000) .".". $ext;

                        $UPDATE = "UPDATE `keynotes` SET `title`=?,`body`=?,`image`=? WHERE `id`=?";
                        $stmt = $conn -> prepare($UPDATE);
                        $stmt->bind_param("ssss", $title, $body, $filename, $editing_id);    
                    }
                    else {
                        $UPDATE = "UPDATE `keynotes` SET `title`=?,`body`=? WHERE `id`=?";
                        $stmt = $conn -> prepare($UPDATE);
                        $stmt->bind_param("sss", $title, $body, $editing_id);    
                    }

                
                    if($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'Updated Successfully';  
                        
                        // If New file uploaded
                        if ($new_file_name !== "") {

                            // Delete Previous file
                            unlink($upload_directory.$editing_image);

                            // Upload new file
                            move_uploaded_file($uploading_file_data,$upload_directory.$filename);

                        }

                    }

                    else {

                        if(mysqli_errno($conn) === 1062) {
                            $response['error'] = true;
                            $response['message'] = 'This graduation info is already registered <br> PLEASE CHECK AND TRY AGAIN '; 
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
                $validation = $validator->delete_keynote_validations($_POST);

                // If Validation Is success
                if (gettype($validation) === "array") {                

                    $deleting_id = $validation['deleting_id'];
                    $deleting_filename = $validation['deleting_filename'];

                    $DELETE = "DELETE FROM `keynotes` WHERE `id` = ?";
                    $stmt = $conn -> prepare($DELETE);
                    $stmt->bind_param("s", $deleting_id);

                    if($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'Removed Successfully';    
                        
                        // Delete File
                        unlink($upload_directory.$deleting_filename);

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