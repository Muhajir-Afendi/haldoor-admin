<?php

    session_start();
    header("Content-Type:application/json");

    $response = array();
    $temp = array();
    $data = array();

    //  Validations
    require_once 'validator.php';
    $validator = new signin_validator;

    require_once "./config.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                
        // Validations
        $validation = $validator->signin_validations($_POST);

        // If Validation Is success
        if (gettype($validation) === "array") {
                        
            $email = $validation["email"];
            $password = $validation["password"];
    
            $INSERT = "SELECT `id`, `name`, `email`, `password` FROM `users` WHERE `email` = ?";
            $stmt = $conn -> prepare($INSERT);
            $stmt->bind_param("s", $email);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows === 0) {
                $response['error'] = true;
                $response['message'] = 'Email or password is wrong';
            }
            else {

                // initialize selected columns to vairable in order to access data
                $stmt->bind_result($id, $name, $email, $pwd);

                // fetch data
                $stmt->fetch();

                // Check if password is right
                if(password_verify($password,$pwd)) {

                    session_regenerate_id();

                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['device'] = $_SERVER['HTTP_USER_AGENT'];

                    $response['error'] = false;
                    $response['message'] = 'Signed successfully';        
                    
                }
                else {
                    $response['error'] = true;
                    $response['message'] = 'Email or password is wrong';    
                }

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


    $json_response = json_encode($response);
    echo $json_response; 

?>