<?php

/* since I'm using two APIS, i have to first check which authentication method the user has used
 by checking if user logged in with social or mojoauth */

//  getting the data that i passed when user used MojoAuth. I set it up to identify the method. 
if (isset($_GET['issuer']) == "mojoauth") {


    $googleConnect = false;
    $fbConnect = false;

    // if the user logged in with Mojoauth, require the configuration file for mojoauth.
    require_once(__DIR__ . "/config.php");

    /*  creating the a bool function to check if the user is truly logged in.  */
    function mojoauthSessionNotEmpty()
    {
        //   since the response of the MojoAuth API is stored in a session, it was checked if it's empty. 
        if (!(isset($_SESSION["mj_user_profile"])) || empty($_SESSION["mj_user_profile"])) {
            return true; //indicates that the session is not empty, user is logged in
        } else {
            return false; //user is not logged in
        }
    }


    // if session is empty, return to the login page and if its not, store the data to $mojoAuthUser.
    if (mojoauthSessionNotEmpty()) {
        header("Location: index.php");
    } else {

        $mojoAuthUser =  json_decode($_SESSION["mj_user_profile"]);
        // print_r($mojoAuthUser);
    }

    // if it's not connected to mojoauth that means its connected to social logins
} else {

    // skipping warnings that indicates there's undefined variable
    error_reporting(E_ERROR | E_PARSE);

    // including the required files
    require_once 'config-hybridauth.php';

    // i have to include these as it need to access the adapter in able to display data
    include_once 'google.php';
    include_once 'fb.php';

    // setting the variables to default false
    $googleConnect = false;
    $fbConnect = false;


    // based on the conditions, make them true. The variables in the condition if check the connection in social provider
    // is authenticated. It's a built in function
    if ($isConnectedGoogle) {
        $googleConnect = true;
    } else if ($isConnectedFB) {
        $fbConnect = true;
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/profile.css?version=51" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

    <nav>MOJOAUTH API & HYBRIDAUTH 3 </nav>


    <div class="body animate__animated animate__slideInDown">

        <img src="img/bg2.png" class="bg" />

        <div class="welcome ">


            <!-- if user is logged in to a social provider, show
    their photo -->
            <?php if ($googleConnect) {
                echo '<img class="social-photo" src="' . $userProfileGoogle->photoURL . '" />';
            } else if ($fbConnect) {
                echo '<img class="social-photo" src="' . $userProfileFB->photoURL . '" />';
            }

            ?>
            <p class="login-indicator">YOU
                ARE LOGGED IN!
            </p>

            <!-- displaying the details based on their provider's responses -->
            <!-- all responses of the providers are in stored in objects that could be called -->
            <h1 class="animate__animated animate__fadeIn animate__repeat-2	animate__slower">Welcome,</h1>
            <h2> <?php if ($googleConnect) {
                        echo  $userProfileGoogle->email;
                    } else if ($fbConnect) {
                        echo  $userProfileFB->email;
                    } else {
                        echo  $mojoAuthUser->identifier;
                    } ?></h2>



            <!-- if user is logged in to a social provider, show
    their details using the objects from HybridAuth API   -->

            <?php if ($googleConnect) {
            ?>

            <!-- if logged in with google -->
            <div class="additional-details">
                <p>Full Name: <?php echo  $userProfileGoogle->displayName; ?> </p>
                <p>First Name: <?php echo  $userProfileGoogle->firstName; ?> </p>
                <p>Last Name: <?php echo  $userProfileGoogle->lastName; ?> </p>
            </div>

            <?php } else if ($fbConnect) { ?>

            <!-- if logged in with FB -->
            <div class="additional-details">
                <p>Full Name: <?php echo  $userProfileFB->displayName; ?> </p>
                <p>First Name: <?php echo  $userProfileFB->firstName; ?> </p>
                <p>Last Name: <?php echo  $userProfileFB->lastName; ?> </p>
            </div>

            <?php } else { ?>

            <!-- for mojoauth -->
            <div class="additional-details">

                <?php if (!empty($mojoAuthUser->auth_type)) { ?>
                <p>Authentication type: <?php echo   ucfirst($mojoAuthUser->auth_type); ?> </p>
                <?php } ?>

            </div>


            <?php  } ?>


            <!-- Finding out the provider of the authentication and sending them to the logout page -->
            <?php

            if ($googleConnect) {
                $issuer = "google";
            } else if ($fbConnect) {
                $issuer = "facebook";
            } else {
                $issuer = "mojoauth";
            }

            ?>
            <a id="logout" href="logout.php?issuer=<?php echo $issuer ?>" class="button">Logout</a>

        </div>

    </div>


    <!-- Additional Content | Information about the API -->
    <div class="about">
        <h1>An authentication built easy!</h1>
        <h2 class="api-desc">ABOUT THE APIs</h2>

        <div class="api-container">

            <div class="api-card">
                <img src="img/mojoauthlogo.png" style="width: 25%" />
                <h2>ABOUT MOJOAUTH</h2>
                <p>MojoAuth offers free passwordless authentication in your apps. They offer Magic Link or OTP, Social
                    logins, WebAuthn,
                    SMS Authentication and MFA.</p>
                <a href="https://mojoauth.com/">More information</a>
            </div>


            <div class="api-card">
                <img src="img/hybridauth.png" style="width: 30%" />
                <h2>ABOUT HYBRIDAUTH</h2>
                <p>HybridAuth is an open soure social sign on
                    php library. It enable developers to easily build
                    social applications to engage websites vistors and customers on a social level by implementing
                    social
                    signin, social sharing, users profiles, friends list, activities stream, status updates and more.
                </p>
                <a href="https://hybridauth.github.io/index.html">More information</a>
            </div>
        </div>
    </div>
</body>

</html>