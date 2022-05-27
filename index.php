<!DOCTYPE html>
<html lang="en">


<!-- READ ME!! -->
<!-- PLEASE MAKE SURE THAT THE DIRECTORY OF THIS APPLICATION IS MOJOAUTH, DO NOT PUT IT IN ANOTHER FOLDER ONLY AS IT IS THE SET CALLBACK,
SO IT MUST BE TO :http://localhost/mojoauth/ OTHERWISE THERE WILL BE ERRORS  -->


<?php
require_once(__DIR__ . "/config.php");


?>
<html>

<head>
    <script src="https://cdn.mojoauth.com/js/mojoauth.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

    <div class="container">


        <div class="left ">


            <div class="titles animate__animated  animate__slideInDown ">
                <p class="api-title">MOJOAUTH & HYBRIDAUTH API</p>
                <h1>Sign in or <br class="br">
                    register your <br class="br">
                    account</h1>
                <p class="small-text">without a password!</p>
            </div>

            <div class="login-holder animate__animated   animate__slideInUp ">



                <!-- adding the inbuilt form made by MojoAuth -->
                <div id="mojoauth-passwordless-form"></div>


                <div class="divider">
                    <p class="or"> <span class="line">OR</span> </p>
                </div>

                <div class="footer" id="footer">



                    <div class="social-logins">

                        <div class="social gmail">

                            <a href="google.php">
                                <img src="img/google.png" width="40" height="35" />
                            </a>

                        </div>


                        <div class="social fb">
                            <a href="fb.php">
                                <img src="img/fb.png" width="20" height="35" />
                            </a>
                        </div>
                    </div>
                </div>



            </div>


        </div>

        <div class="right ">
            <h2 class="animate__animated  animate__slideInDown">A secure, <br>
                passwordless, <br>
                authentication.</h2>

            <div class="img-holder animate__animated   animate__slideInUp">

                <img src="img/login.png" class="login-img" />
            </div>
        </div>

    </div>

    <script>
    // instatiating MojoAuth to render the form
    const mojoauth = new MojoAuth("<?php echo MOJOAUTH_APIKEY ?>", {
        language: "<?php echo MOJOAUTH_LANG ?>",
        redirect_url: "<?php echo MOJOAUTH_TOKEN_HANDLER ?>",
        source: [{
            type: "email",
            feature: "magiclink"
        }, ],
    })


    // redirecting users to the profile page after authentication
    mojoauth.signIn().then((response) => {
        var footer = document.getElementById('footers').style.display = "none";
        var footer = document.getElementById('footers').style.display = "none";


        if (response.authenticated == true) {


            postTokenAtServer(response.oauth.access_token, function(data) {
                if (data.status = "success") {
                    window.location.href = "<?php echo MOJOAUTH_REDIRECTION_URL ?>";
                } else {
                    $('body').html(data.message);
                }
            });
        }
    });

    // creating tokens for users
    function postTokenAtServer(access_token, callback) {
        $.post("tokenhandler.php", {
                access_token: access_token
            },
            function(data, status) {
                callback(data);
            });
    }
    </script>

    <script src="js.js"></script>
</body>

</html>