<?php
    $title = "Login | PHP Motors";
    
    $main = '<h1>Login</h1>';

    if (isset($_SESSION['message'])) {
        $main .= $_SESSION['message'];
    }

    $main .= <<<XML
        <form method="post" action="/accounts/">
            <p><span>*</span>: Required</p>
            <label for="clientEmail">Email<span>*</span>:</label>
    XML;

    if (isset($clientEmail)) {
        $main .= "<input type='email' name='clientEmail' id='clientEmail' required class='form-control' placeholder='email@domain.com' value='$clientEmail'>";
    } else {
        $main .= "<input type='email' name='clientEmail' id='clientEmail' required class='form-control' placeholder='email@domain.com'>";
    }

    $main .= <<<XML
            <span class="warning-text">Password must have at least 1 number, 1 uppercase letter, 1 special character, and be at least 8 characters long.</span>
            <label for="clientPassword">Password<span>*</span>:</label>
            <div>
                <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" class="form-control" placeholder="Password">
                <span><label for="showPassword">Show Password?</label>
                <input type="checkbox" name="showPassword" id="showPassword"></span>
            </div>
            <button type="submit" value="submit">Submit</button>
            <!-- Add the action name/value pair -->
            <input type="hidden" name="action" value="Login">
            <p>No account? <a href="/accounts/?action=registration">Sign Up!</a></p>
        </form>
        <hr class="length-eighth-less">
        <br>
    XML;

    $scriptAdditions = <<<XML
        <script src="../js/showPass.js"></script>
    XML;
    
    require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
?>
