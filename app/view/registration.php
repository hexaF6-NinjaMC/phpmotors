<?php
    $title = "Create Account | PHP Motors";
    
    $main = '<h1>Create Account</h1>';
    
    if (isset($_SESSION['message'])) {
        $main .= $_SESSION['message'];
    }
    
    $main .= <<<XML
    <form method='post' action='/app/accounts/'>
        <p><span>*</span>: Required</p>
        <label for='clientFirstname'>First name<span>*</span>:</label>
    XML;

    if(isset($clientFirstname)) {
        $main .= "<input type='text' name='clientFirstname' id='clientFirstname' required class='form-control' placeholder='At least 2 characters' minlength='2' value='$clientFirstname'>";
    } else {
        $main .= "<input type='text' name='clientFirstname' id='clientFirstname' required class='form-control' placeholder='At least 2 characters' minlength='2'>";
    }

    $main .= <<<XML
        <label for="clientLastname">Last name<span>*</span>:</label>
    XML;

    if(isset($clientLastname)) {
        $main .= "<input type='text' name='clientLastname' id='clientLastname' required class='form-control' placeholder='At least 2 characters' minlength='2' value='$clientLastname'>";
    } else {
        $main .= "<input type='text' name='clientLastname' id='clientLastname' required class='form-control' placeholder='At least 2 characters' minlength='2'>";
    }

    $main .= <<<XML
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
            <input type="hidden" name="action" value="register">
            <p>Already have an account? <a href="/app/accounts/?action=login">Login!</a></p>
        </form>
        <hr class="length-eighth-less">
        <br>
    XML;

    $scriptAdditions = <<<XML
        <script src="../js/showPass.js"></script>
    XML;

    require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
?>
