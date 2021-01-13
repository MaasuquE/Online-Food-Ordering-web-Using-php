<?php
    ob_start();
    include "config.php";
    include "toper.php";
?>
    <div id="delivery">
        <div class="container deliver_container">
        <div class="delivery_title">
            <h3>Register For Deliver Boy</h3>
        </div>
        <form action="#" method="post" class="del_form">
            <input type="text" name="name" id="name" placeholder="Username">
            <br><span id="field_error" class="name_error"></span>

            <input name="email" placeholder="Email" id="email" type="email">
            <br><span id="field_error" class="email_error"></span>

            <input type="password" name="password" id="password" placeholder="Password">
            <br><span id="field_error" class="password_error"></span>

            <input type="number" name="mobile" id="mobile" placeholder="Mobile">
            <br><span id="field_error" class="mobile_error"></span>

            
            <div class="button-box">
                <button onclick="dboy_submit()" type="button"><span>SUBMIT</span></button>
            </div>
        </form>
        </div>
    </div>
<?php                                
    include "footer.php";
?>