<?php
include_once 'psl-config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name 
    $secure = FALSE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    if(!isset($_SESSION)) 
    { 
        session_name($session_name);
        session_start(); 
        session_regenerate_id();    // regenerated the session, delete the old one. 
    } 
}


    function login_check() {
        include '../notation/Includes/connect.php';
        // Check if all session variables are set 
        if (isset($_SESSION['id'], $_SESSION['login_string'])) {
     
            $user_id = $_SESSION['id'];
            $login_string = $_SESSION['login_string'];
     
            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
     
            if ($stmt = $conn->prepare("SELECT password 
                                          FROM personne 
                                          WHERE id = :ID LIMIT 1")) {
                $stmt->execute(array("ID"=>$user_id));   // Execute the prepared query.
     
                if ($stmt->rowCount() == 1) {
                    // If the user exists get variables from result.
                    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

                    $password = $row['password'];

                    $login_check = hash('sha512', $password . $user_browser);
     
                    if (hash_equals($login_check, $login_string) ){
                        // Logged In!!!! 
                        return true;
                    } else {
                        // Not logged in 
                        return false;
                    }
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    }

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}



?>