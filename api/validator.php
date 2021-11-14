<?php

    //  Validations
    require_once 'validations.php';
    use inputValidations as validations;
    
    // Essentials
    class essential_validations {

        public function page_validator($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";

            // Check if variable are POSTED
            $page_no = isset($_POST['page_no']) ? $_POST['page_no'] : false ;
            
            // Page Number
            $validatedPageNo = validations\validate_page_no($page_no);
            if (!$validatedPageNo) {
                $isError = true;
                $msg = "Please use valid page number";
            }
            else {
                $validatedInputs["page_no"] = $validatedPageNo;
            }
            
            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }

        }

        public function search_validator($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";

            // Check if variable are POSTED
            $searching_text = isset($_POST['searching_text']) ? $_POST['searching_text'] : false ;
            
            // Search
            $validatedSearchText = validations\validate_search_text($searching_text);
            if (!$validatedSearchText) {
                $isError = true;
                $msg = "Please use valid search keyword";
            }
            else {

                $validatedSearchText = "%". $validatedSearchText ."%"; 
                $validatedInputs["searching_text"] = $validatedSearchText;
            }
            
            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }

        }

    }

    // Users
    class users_validator extends essential_validations {

        function page_validations($inputs) {

           return $this->page_validator($inputs);
        }

        function search_validations($inputs) {

            return $this->search_validator($inputs);
        }

        function new_user_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
    
            // Check if variable are POSTED
            $name = isset($inputs['name']) ? $inputs['name'] : false ;
            $email = isset($inputs['email']) ? $inputs['email'] : false ;
            $password = isset($inputs['password']) ? $inputs['password'] : false ;
            $confirm_password = isset($inputs['confirm_password']) ? $inputs['confirm_password'] : false ;

            // Capitalize
            $name = ucwords(strtolower($name));
            
            // Name
            $validatedName = validations\validate_name($name);
            if (!$validatedName) {
                $isError = true;
                $msg = "Please use valid name";
            }
            else {
                $validatedInputs["name"] = $validatedName;
            }
           
            // Email
            $validatedEmail = validations\validate_name($email);
            if (!$validatedEmail) {
                $isError = true;
                $msg = $email ." - Please use valid emaiel";
            }
            else {
                $validatedInputs["email"] = $validatedEmail;
            }
            
            // Password
            $validatedPassword = validations\validate_password($password, $confirm_password);
            if (!$validatedPassword) {
                $isError = true;
                $msg = "Please use valid password";
            }
            else {
                $validatedInputs["password"] = $validatedPassword;
            }
            
            
            if ($isError) {
                return $msg;
            }
            else {
               return $validatedInputs; 
            }
            
    
        }
    
        function edit_user_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $editing_id = isset($inputs['editing_id']) ? $inputs['editing_id'] : false ;
            $name = isset($inputs['name']) ? $inputs['name'] : false ;
            $email = isset($inputs['email']) ? $inputs['email'] : false ;
            $password = isset($inputs['password']) ? $inputs['password'] : false ;
            $confirm_password = isset($inputs['confirm_password']) ? $inputs['confirm_password'] : false ;

            // Capitalize
            $name = ucwords(strtolower($name));

            // Id
            $editing_id = validations\validate_number_id($editing_id);
            if (!$editing_id) {
                $isError = true;
                $msg = "Please use valid user id";
            }
            else {
                $validatedInputs["editing_id"] = $editing_id;
            }
            
            // Name
            $validatedName = validations\validate_name($name);
            if (!$validatedName) {
                $isError = true;
                $msg = "Please use valid name";
            }
            else {
                $validatedInputs["name"] = $validatedName;
            }
           
            // Email
            $validatedEmail = validations\validate_name($email);
            if (!$validatedEmail) {
                $isError = true;
                $msg = $email ." - Please use valid emaiel";
            }
            else {
                $validatedInputs["email"] = $validatedEmail;
            }
            
            // Password
            $validatedPassword = validations\validate_editing_password($password, $confirm_password);
            if (!$validatedPassword) {
                $isError = true;
                $msg = "Please use valid password";
            }
            else {
                $validatedInputs["password"] = $validatedPassword;
            }
            
            if ($isError) {
                return $msg;
            }
            else {
               return $validatedInputs; 
            }
            
        }    

        function delete_user_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $deleting_id = isset($inputs['id']) ? $inputs['id'] : false ;

            // Deleting Id
            $deleting_id = validations\validate_number_id($deleting_id);
            if (!$deleting_id) {
                $isError = true;
                $msg = "Please use valid user";
            }
            else {
                $validatedInputs["deleting_id"] = $deleting_id;
            }
            
            if ($isError) {
                return $msg;
            }
            else {
               return $validatedInputs; 
            }
            
        }    

    }

    // Graduations
    class graduations_validator extends essential_validations {

        function page_validations($inputs) {

           return $this->page_validator($inputs);
        }

        function search_validations($inputs) {

            return $this->search_validator($inputs);
        }

        function new_graduation_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
    
            // Check if variable are POSTED
            $title = isset($inputs['title']) ? $inputs['title'] : false ;
            $body = isset($inputs['body']) ? $inputs['body'] : false ;

            $facebook = isset($inputs['facebook']) ? $inputs['facebook'] : false ;
            $youtube = isset($inputs['youtube']) ? $inputs['youtube'] : false ;
            $instagram = isset($inputs['instagram']) ? $inputs['instagram'] : false ;
            $twitter = isset($inputs['twitter']) ? $inputs['twitter'] : false ;

            $image = isset($inputs['image']) ? $inputs['image'] : false ;

            // Title
            $validatedTitle = validations\validate_title($title);
            if (!$validatedTitle) {
                $isError = true;
                $msg = "Please use valid title";
            }
            else {
                $validatedInputs["title"] = $validatedTitle;
            }

            // Body
            $validatedBody = validations\validate_body($body);
            if (!$validatedBody) {
                $isError = true;
                $msg = "Please use valid body";
            }
            else {
                $validatedInputs["body"] = $validatedBody;
            }

            // Facebook
            $validatedFacebook = validations\validate_social_media($facebook);
            $validatedInputs["facebook"] = $validatedFacebook;
        
            // Youtube
            $validatedYoutube = validations\validate_social_media($youtube);
            $validatedInputs["youtube"] = $validatedYoutube;
                        
            // Instagram
            $validatedInstagram = validations\validate_social_media($instagram);
            $validatedInputs["instagram"] = $validatedInstagram;

            // Twitter
            $validatedTwitter = validations\validate_social_media($twitter);
            $validatedInputs["twitter"] = $validatedTwitter;            
            
            // Image Validation
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];

            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg','jpg','png','gif'); // valid extensions

            // Check if image uploaded
            if(empty($imgFile)) {
                $isError = true;
                $msg = "Please upload image file";
            }
            else {

                // Check if extension is allowed
                if(!in_array($imgExt, $valid_extensions)) {
                    $isError = true;
                    $msg = $imgFile ." is not an Image file, only JPG, PNG and GIF are allowed";
                }
                else {

                    if($imgSize > 5000000) {
                        $isError = true;
                        $msg = $imgSize ." is large file, please use file with size less than 5MB";    
                    }   
                    else {
                        $validatedInputs["file_data"] = $tmp_dir;
                        $validatedInputs["file_extension"] = $imgExt;
                    }


                }

            }



            if ($isError) {
                return $msg;
            }
            else {
               return $validatedInputs; 
            }
            
    
        }
        
        function edit_graduation_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $editing_id = isset($inputs['editing_id']) ? $inputs['editing_id'] : false ;
            $editing_image = isset($inputs['editing_image']) ? $inputs['editing_image'] : false ;

            $title = isset($inputs['title']) ? $inputs['title'] : false ;
            $body = isset($inputs['body']) ? $inputs['body'] : false ;

            $facebook = isset($inputs['facebook']) ? $inputs['facebook'] : false ;
            $youtube = isset($inputs['youtube']) ? $inputs['youtube'] : false ;
            $instagram = isset($inputs['instagram']) ? $inputs['instagram'] : false ;
            $twitter = isset($inputs['twitter']) ? $inputs['twitter'] : false ;

            $image = isset($inputs['image']) ? $inputs['image'] : false ;

            // Editing Id
            $editing_id = validations\validate_number_id($editing_id);
            if (!$editing_id) {
                $isError = true;
                $msg = "Please use valid graduation info";
            }
            else {
                $validatedInputs["editing_id"] = $editing_id;
            }

            // Editing File
            $editing_image = validations\validate_file_name($editing_image);
            if (!$editing_image) {
                $isError = true;
                $msg = "Please use valid graduation info";
            }
            else {
                $validatedInputs["editing_image"] = $editing_image;
            }
                  
            // Title
            $validatedTitle = validations\validate_title($title);
            if (!$validatedTitle) {
                $isError = true;
                $msg = "Please use valid title";
            }
            else {
                $validatedInputs["title"] = $validatedTitle;
            }

            // Body
            $validatedBody = validations\validate_body($body);
            if (!$validatedBody) {
                $isError = true;
                $msg = "Please use valid body";
            }
            else {
                $validatedInputs["body"] = $validatedBody;
            }

            // Facebook
            $validatedFacebook = validations\validate_social_media($facebook);
            $validatedInputs["facebook"] = $validatedFacebook;
        
            // Youtube
            $validatedYoutube = validations\validate_social_media($youtube);
            $validatedInputs["youtube"] = $validatedYoutube;
                        
            // Instagram
            $validatedInstagram = validations\validate_social_media($instagram);
            $validatedInputs["instagram"] = $validatedInstagram;

            // Twitter
            $validatedTwitter = validations\validate_social_media($twitter);
            $validatedInputs["twitter"] = $validatedTwitter;            
            
            // Image Validation
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];

            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg','jpg','png','gif'); // valid extensions

            // Check if image uploaded
            if(empty($imgFile)) {           
                $validatedInputs["new_file_name"] = "";
            }

            else {

                // Check if extension is allowed
                if(!in_array($imgExt, $valid_extensions)) {
                    $isError = true;
                    $msg = $imgFile ." is not allowed, only PDF files are allowed";
                }
                else {

                    if($imgSize > 5000000) {
                        $isError = true;
                        $msg = $imgSize ." is large file, please use file with size less than 5MB";    
                    }   
                    else {
                        $validatedInputs["new_file_name"] = $imgFile;
                        $validatedInputs["file_data"] = $tmp_dir;
                        $validatedInputs["file_extension"] = $imgExt;
                    }


                }

            }
            
            
            if ($isError) {
                return $msg;
            }
            else {
               return $validatedInputs; 
            }
            
        }    

        function delete_graduation_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $deleting_id = isset($inputs['id']) ? $inputs['id'] : false ;
            $deleting_filename = isset($inputs['deleting_filename']) ? $inputs['deleting_filename'] : false ;

            // Deleting Id
            $deleting_id = validations\validate_number_id($deleting_id);
            if (!$deleting_id) {
                $isError = true;
                $msg = "Please use valid graduation info";
            }
            else {
                $validatedInputs["deleting_id"] = $deleting_id;
            }
            
            // Deleting File
            $deleting_file = validations\validate_file_name($deleting_filename);
            if (!$deleting_file) {
                $isError = true;
                $msg = "Please use valid graduation";
            }
            else {
                $validatedInputs["deleting_filename"] = $deleting_file;
            }
            

            if ($isError) {
                return $msg;
            }
            else {
               return $validatedInputs; 
            }
            
        }    

    }

    // Keynotes
    class keynotes_validator extends essential_validations {

        function page_validations($inputs) {

            return $this->page_validator($inputs);
        }

        function search_validations($inputs) {

            return $this->search_validator($inputs);
        }

        function new_keynote_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";

            // Check if variable are POSTED
            $title = isset($inputs['title']) ? $inputs['title'] : false ;
            $body = isset($inputs['body']) ? $inputs['body'] : false ;

            $facebook = isset($inputs['facebook']) ? $inputs['facebook'] : false ;
            $youtube = isset($inputs['youtube']) ? $inputs['youtube'] : false ;
            $instagram = isset($inputs['instagram']) ? $inputs['instagram'] : false ;
            $twitter = isset($inputs['twitter']) ? $inputs['twitter'] : false ;

            $image = isset($inputs['image']) ? $inputs['image'] : false ;

            // Title
            $validatedTitle = validations\validate_title($title);
            if (!$validatedTitle) {
                $isError = true;
                $msg = "Please use valid title";
            }
            else {
                $validatedInputs["title"] = $validatedTitle;
            }

            // Body
            $validatedBody = validations\validate_body($body);
            if (!$validatedBody) {
                $isError = true;
                $msg = "Please use valid body";
            }
            else {
                $validatedInputs["body"] = $validatedBody;
            }

            // Facebook
            $validatedFacebook = validations\validate_social_media($facebook);
            $validatedInputs["facebook"] = $validatedFacebook;
      
            // Youtube
            $validatedYoutube = validations\validate_social_media($youtube);
            $validatedInputs["youtube"] = $validatedYoutube;
                        
            // Instagram
            $validatedInstagram = validations\validate_social_media($instagram);
            $validatedInputs["instagram"] = $validatedInstagram;

            // Twitter
            $validatedTwitter = validations\validate_social_media($twitter);
            $validatedInputs["twitter"] = $validatedTwitter;            

            // Image Validation
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];

            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg','jpg','png','gif'); // valid extensions

            // Check if image uploaded
            if(empty($imgFile)) {
                $isError = true;
                $msg = "Please upload image file";
            }
            else {

                // Check if extension is allowed
                if(!in_array($imgExt, $valid_extensions)) {
                    $isError = true;
                    $msg = $imgFile ." is not an Image file, only JPG, PNG and GIF are allowed";
                }
                else {

                    if($imgSize > 5000000) {
                        $isError = true;
                        $msg = $imgSize ." is large file, please use file with size less than 5MB";    
                    }   
                    else {
                        $validatedInputs["file_data"] = $tmp_dir;
                        $validatedInputs["file_extension"] = $imgExt;
                    }


                }

            }



            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }
            

        }
        
        function edit_keynote_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $editing_id = isset($inputs['editing_id']) ? $inputs['editing_id'] : false ;
            $editing_image = isset($inputs['editing_image']) ? $inputs['editing_image'] : false ;

            $title = isset($inputs['title']) ? $inputs['title'] : false ;
            $body = isset($inputs['body']) ? $inputs['body'] : false ;

            $facebook = isset($inputs['facebook']) ? $inputs['facebook'] : false ;
            $youtube = isset($inputs['youtube']) ? $inputs['youtube'] : false ;
            $instagram = isset($inputs['instagram']) ? $inputs['instagram'] : false ;
            $twitter = isset($inputs['twitter']) ? $inputs['twitter'] : false ;

            $image = isset($inputs['image']) ? $inputs['image'] : false ;

            // Editing Id
            $editing_id = validations\validate_number_id($editing_id);
            if (!$editing_id) {
                $isError = true;
                $msg = "Please use valid keynotes info";
            }
            else {
                $validatedInputs["editing_id"] = $editing_id;
            }

            // Editing File
            $editing_image = validations\validate_file_name($editing_image);
            if (!$editing_image) {
                $isError = true;
                $msg = "Please use valid graduation info";
            }
            else {
                $validatedInputs["editing_image"] = $editing_image;
            }
                    
            // Title
            $validatedTitle = validations\validate_title($title);
            if (!$validatedTitle) {
                $isError = true;
                $msg = "Please use valid title";
            }
            else {
                $validatedInputs["title"] = $validatedTitle;
            }

            // Body
            $validatedBody = validations\validate_body($body);
            if (!$validatedBody) {
                $isError = true;
                $msg = "Please use valid body";
            }
            else {
                $validatedInputs["body"] = $validatedBody;
            }

            // Facebook
            $validatedFacebook = validations\validate_social_media($facebook);
            $validatedInputs["facebook"] = $validatedFacebook;
        
            // Youtube
            $validatedYoutube = validations\validate_social_media($youtube);
            $validatedInputs["youtube"] = $validatedYoutube;
                        
            // Instagram
            $validatedInstagram = validations\validate_social_media($instagram);
            $validatedInputs["instagram"] = $validatedInstagram;

            // Twitter
            $validatedTwitter = validations\validate_social_media($twitter);
            $validatedInputs["twitter"] = $validatedTwitter;

            // Image Validation
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];

            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg','jpg','png','gif'); // valid extensions

            // Check if image uploaded
            if(empty($imgFile)) {           
                $validatedInputs["new_file_name"] = "";
            }

            else {

                // Check if extension is allowed
                if(!in_array($imgExt, $valid_extensions)) {
                    $isError = true;
                    $msg = $imgFile ." is not allowed, only PDF files are allowed";
                }
                else {

                    if($imgSize > 5000000) {
                        $isError = true;
                        $msg = $imgSize ." is large file, please use file with size less than 5MB";    
                    }   
                    else {
                        $validatedInputs["new_file_name"] = $imgFile;
                        $validatedInputs["file_data"] = $tmp_dir;
                        $validatedInputs["file_extension"] = $imgExt;
                    }


                }

            }
            
            
            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }
            
        }    

        function delete_keynote_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $deleting_id = isset($inputs['id']) ? $inputs['id'] : false ;
            $deleting_filename = isset($inputs['deleting_filename']) ? $inputs['deleting_filename'] : false ;

            // Deleting Id
            $deleting_id = validations\validate_number_id($deleting_id);
            if (!$deleting_id) {
                $isError = true;
                $msg = "Please use valid graduation info";
            }
            else {
                $validatedInputs["deleting_id"] = $deleting_id;
            }
            
            // Deleting File
            $deleting_file = validations\validate_file_name($deleting_filename);
            if (!$deleting_file) {
                $isError = true;
                $msg = "Please use valid graduation";
            }
            else {
                $validatedInputs["deleting_filename"] = $deleting_file;
            }
            

            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }
            
        }    

    }

    // Contacts
    class contacts_validator extends essential_validations {

        function page_validations($inputs) {

            return $this->page_validator($inputs);
        }

        function search_validations($inputs) {

            return $this->search_validator($inputs);
        }

        function delete_contacts_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";
                
            // Check if variable are POSTED
            $deleting_id = isset($inputs['id']) ? $inputs['id'] : false ;

            // Deleting Id
            $deleting_id = validations\validate_number_id($deleting_id);
            if (!$deleting_id) {
                $isError = true;
                $msg = "Please use valid contacts info";
            }
            else {
                $validatedInputs["deleting_id"] = $deleting_id;
            }
                        

            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }
            
        }    

    }
    
    // Signin
    class signin_validator {

        function signin_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";

            // Check if variable are POSTED
            $email = isset($_POST['email']) ? $_POST['email'] : false ;
            $password = isset($_POST['password']) ? $_POST['password'] : false ;

            // Email
            $validatedEmail = validations\validate_name($email);
            if (!$validatedEmail) {
                $isError = true;
                $msg = "Email or password is wrong";
            }
            else {

                $validatedInputs["email"] = $validatedEmail;
            }
             
            // Password
            $validatedPassword = validations\validate_signin_password($password);
            if (!$validatedPassword) {
                $isError = true;
                $msg = "Email or password is wrong";
            }
            else {

                $validatedInputs["password"] = $validatedPassword;
            }
            
            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }


        }

    }
    

?>