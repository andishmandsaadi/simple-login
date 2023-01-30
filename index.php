<?php 

require_once realpath("vendor/autoload.php");
session_start();

?>
<!doctype html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <style>
            @media (min-width: 768px) {
                .container-small {
                    width: 300px;
                }
            } 
            @media (min-width: 992px) {
                .container-small {
                    width: 500px;
                }
            } 
            .container-small{
                width: 700px;
            }
            body {
                background-image: url("src/assets/bg3.jpg");
                background-color: #FFF;
                color: #FFF;
                padding: 10%;
            }
        </style>
</head>
    <body>
        <?php if(isset($_SESSION["userDatail"])){
            echo 'Hello '.$_SESSION["userDatail"];
        ?>
            <button type="button" class="btn btn-primary" onclick="logout()">Log Out</button>
        <?php
        }else{
        ?>
        <div class="container-sm container-small">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                aria-controls="pills-login" aria-selected="true" onclick="toggleTabs('login');">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="false" onclick="toggleTabs('register');">Register</button>
            </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <form id="loginform" method="post">

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" required/>
                    <label class="form-label" for="email">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="passworrd" name="password" class="form-control" required/>
                    <label class="form-label" for="passworrd">Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <form id="signupform" method="post">

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="name" name="name" class="form-control" required/>
                    <label class="form-label" for="name">Name</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" required/>
                    <label class="form-label" for="email">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required/>
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
                </form>
            </div>
            </div>
            <!-- Pills content -->
        </div>
        <?php
        }
        ?>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#loginform').submit(function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    
                    url: 'src/ajax/login.php',
                    
                    data: $(this).serialize(),

                    success: function(response)
                    {
                        var jsonData = JSON.parse(response);
                        
                        if (jsonData.success == "1")
                        {
                            location.reload();
                        }
                        else
                        {
                            alert('Invalid Credentials!');
                        }
                }
            });
            });
            $('#signupform').submit(function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    
                    url: 'src/ajax/signup.php',
                    
                    data: $(this).serialize(),

                    success: function(response)
                    {
                        var jsonData = JSON.parse(response);
                        
                        if (jsonData.success == "1")
                        {
                            location.reload();
                        }
                        else
                        {
                            alert('Invalid Credentials!');
                        }
                }
            });
            });
        });
        function logout(){
            $.ajax({
                type: "POST",
                
                url: 'src/ajax/logout.php',
                
                data: {},

                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1")
                    {
                        location.reload();
                    }
                    else
                    {
                        alert('Error!');
                    }
                }
            });
        }

        function toggleTabs(tabName){
            if(tabName == 'register'){
                $('#pills-register').addClass('show');
                $('#pills-register').addClass('active');
                $('#pills-login').removeClass('active');
                $('#pills-login').removeClass('show');
                $('.nav-link').removeClass('active');
                $('#tab-register').addClass('active');
                
            }else{
                $('#pills-login').addClass('show');
                $('#pills-login').addClass('active');
                $('#pills-register').removeClass('active');
                $('#pills-register').removeClass('show');
                $('.nav-link').removeClass('active');
                $('#tab-login').addClass('active');
            }
        }

    </script>
</body>
</html>