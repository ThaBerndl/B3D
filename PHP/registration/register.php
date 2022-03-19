<?

  require_once "config.php";  

// Define variables and initialize with empty values
$vname = $nname = $username = $password = $confirm_password = "";
$vname_err = $nname_err = $username_err = $password_err = "";
 
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM Users WHERE nickname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate VName
    if(empty(trim($_POST["vorname"]))){
      $vname_err = "Please enter first name.";     
    }
    $param_vname = $_POST["vorname"];

    // Validate NName
    if(empty(trim($_POST["nachname"]))){
      $vname_err = "Please enter last name.";     
    }
    $param_nname = $_POST["nachname"];

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($vname_err)&& empty($vname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (vName, nName, nickname, passwort) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss",$param_vname,$param_vname, $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = $_POST["password"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../pages/dashboard.html");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
?>