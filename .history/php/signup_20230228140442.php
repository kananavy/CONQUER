    <?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
   

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // let's check user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //if email is valid
            // let's check that email already exit in the database or not
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){ //if email already exist
            echo "$email - This email already exist!";
        }else{
            //let's check user upload file or not
            if(isset($_FILES['image'])){ // if file is uploaded
                $img_name = $_FILESimage']['name']; //getting user uploaded img name
                $tmp_name = $_FILES['image']['tmp_name']; //this temporary name is used to save/move file in our folder

                //let's explode image and get the last extension like jpg png
                $img_explode = explode('.'[', $img_name);
                $img_ext = end($img_explode); //here we get the extension of an user uploaded img file

                $extensions = ['png', 'jpeg', 'jpg']; //these are sone valid img ext and we've store them in array
                if(in_array($img_ext, $extensions) === true){ //if user uploaded img ext iss matched with anu array extension
                    $time = time(); //this will return us current time..
                                    //we need this time because when you uploading user img to in our folder we rename user file with current time
                                    //so all the image file will have a unique name
                 // let's move the user uploaded img to our particular folder
                    $new_img_name = $time.$img_name;
                       
                    if(move_uploaded_file($tmp_name, "images/".$new_img_name)){// if user upload img move to our folder successfully
                        $status = "Active now"; //once user signed up then his status will be active now
                        $random_id = rand(time(), 10000000); //crating random id for user

                        //let's insert all user data inside table
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                            VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                        if($sql2){ //if these data inserted
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user Unique_id in other php file
                                echo "success";

                            }  
                        }else{
                            echo "Something went wrong!";  
                        }
                 } 
                 
                }else{
                    echo "Please select a Image file - jpeg, jpg, png!";  
                }

            }else{
                echo "Please select a Image file!"; 
            }
        }
    }else{
            echo "$email - This is not valid email";
        }
    }else{
        echo "All input field are required!";
    }
        
 ?>


