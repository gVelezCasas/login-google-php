<?php
require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// $_POST['g_csrf_token'] = false;
// unset($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in google</title>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <link rel="stylesheet" href="./css/app.css">
</head>
<body>
    <main class="container">
        
        <div class="grid-item">
            <?php
                if(isset($_POST['credential'])){
                    $id_token = $_POST['credential'];

                    $client = new Google_Client(['client_id' => $_ENV['CLIENT_ID']]);  // Specify the CLIENT_ID of the app that accesses the backend
                    
                    $payload = $client->verifyIdToken($id_token);
                    if ($payload) {
                        $result_login =  ['email'=>$payload['email'],'name'=>$payload['given_name'],'last name'=>$payload['family_name'],'picture'=>$payload['picture']];
                    } else {
                        $result_login = ['error'=>'Invalid ID token'];
                    }?>
                    <div >
                        <h1>Información del usuario</h1>
                        <form class="info" action="" method="post">
                            <label for="nombre">
                                Nombre:
                                <input type="text" name="nombre" value="<?php echo $result_login['name'] ?>" id="">
                            </label>
                            <label for="epellidos">
                                Apellidos:
                                <input type="text" name="apellidos" value="<?php echo $result_login['last name'] ?>" id="">
                            </label>
                            <label for="email">
                                Email:
                                <input type="text" name="email" value="<?php echo $result_login['email'] ?>" id="">
                            </label>
                            <button class="boton_submit">submit</button>
                        </form>
                    </div>
                <?php }else{ ?>
                    <div class="grid-item">
                        <div id="g_id_onload"
                            data-client_id="836597504080-i9kk56qtd4p2ljtlol2igvd7e7ocduf0.apps.googleusercontent.com"
                            data-context="signin"
                            data-ux_mode="popup"
                            data-login_uri="http://localhost/login-google/"
                            data-auto_prompt="false">
                        </div>
                        <div class="g_id_signin"
                            data-type="standard"
                            data-shape="pill"
                            data-theme="filled_black"
                            data-text="signup_with"
                            data-size="large"
                            data-logo_alignment="left">
                        </div>
                    </div>
                <?php }
            ?>
        </div>
    </main>
</body>
</html>