<?php
    include "config.php";
    include "toper.php"; 
 ?>
        <div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="#" method="post">
                                                <input name="user_email" placeholder="Email" id="login_email" type="email">
                                                <br><span id="field_error" class="email_error"></span>
                                                <input type="user_password" id="login_password" name="user-password" placeholder="Password">
                                                <br><span id="field_error" class="password_error"></span>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox">
                                                        <label>Remember me</label>
                                                        <a href="#">Forgot Password?</a>
                                                    </div>
                                                    <button type="button" onclick ="login('login')"><span>Login</span></button>
                                                    <br><span id="field_error" class="login_failed"></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="#" method="post">
                                                <input type="text" name="user-name" id="name" placeholder="Username">
                                                <br><span id="field_error" class="name_error"></span>

                                                <input name="email" placeholder="Email" id="email" type="email">
                                                <br><span id="field_error" class="email_error"></span>
                                                
                                                <input type="number" name="mobile" id="mobile" placeholder="Mobile">
                                                <br><span id="field_error" class="mobile_error"></span>

                                                <input type="password" name="user-password" id="password" placeholder="Password">
                                                <br><span id="field_error" class="password_error"></span>
                                                <div class="button-box">
                                                    <button onclick="register()" type="button"><span>Register</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include "footer.php"; ?>
