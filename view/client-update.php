<?php
    if (!$_SESSION['loggedin']) {
        header('Location: /');
    } else {
        $title = "Update Account Info | PHP Motors";

        $clientData = $_SESSION['clientData'];

        $main = <<<XML
            <h1>Update Account Information</h1>
        XML;

        $main .= "<h2 class='pl-two'>Update your basic account information below.</h2>";

        if (isset($accountInfoMessage)) {
            $main .= $accountInfoMessage;
        }

        // Change Account "Safe" Info form
        $main .= <<<XML
            <form method="post" action="/accounts/">
                <p><span>*</span>: Required</p>
                <label for='clientFirstname'>First name<span>*</span>:</label>
        XML;

        if (isset($clientFirstname)) {
            $main .= "<input type='text' name='clientFirstname' class='form-control' id='clientFirstname' required value='$clientFirstname' placeholder='At least 2 characters' minlength='2'>";
        } elseif (isset($clientData['clientFirstname'])) {
            $main .= "<input type='text' name='clientFirstname' class='form-control' id='clientFirstname' required value='$clientData[clientFirstname]' placeholder='At least 2 characters' minlength='2'>";
        } else {
            $main .= "<input type='text' name='clientFirstname' class='form-control' id='clientFirstname' required' placeholder='At least 2 characters' minlength='2'>";
        }

        $main .= <<<XML
                <label for='clientLastname'>Last name<span>*</span>:</label>
        XML;

        if (isset($clientLastname)) {
            $main .= "<input type='text' name='clientLastname' class='form-control' id='clientLastname' required value='$clientLastname' placeholder='At least 2 characters' minlength='2'>";
        } elseif (isset($clientData['clientLastname'])) {
            $main .= "<input type='text' name='clientLastname' class='form-control' id='clientLastname' required value='$clientData[clientLastname]' placeholder='At least 2 characters' minlength='2'>";
        } else {
            $main .= "<input type='text' name='clientLastname' class='form-control' id='clientLastname' required' placeholder='At least 2 characters' minlength='2'>";
        }

        $main .= <<<XML
                <label for='clientEmail'>Email<span>*</span>:</label>
        XML;

        if (isset($clientEmail)) {
            $main .= "<input type='email' name='clientEmail' class='form-control' id='clientEmail' required value='$clientEmail' placeholder='email@domain.com'>";
        } elseif (isset($clientData['clientEmail'])) {
            $main .= "<input type='email' name='clientEmail' class='form-control' id='clientEmail' required value='$clientData[clientEmail]' placeholder='email@domain.com'>";
        } else {
            $main .= "<input type='email' name='clientEmail' class='form-control' id='clientEmail' required' placeholder='email@domain.com'>";
        }

        $main .= <<<XML
                <button type="submit" value="submit">Update Info</button>
        XML;

        $main .= "<input type='hidden' name='clientId' value='$clientData[clientId]'>";

        $main .= <<<XML
                <input type='hidden' name='action' value='updateSafeInfo'>
            </form>
            <hr class="length-eighth-less">
            <br>
        XML;

        $main .= "<h2 class='pl-two'>Change your password below.</h2>";

        if (isset($accountPasswordMessage)) {
            $main .= $accountPasswordMessage;
        }

        // Change Password ("Unsafe") form
        $main .= <<<XML
            <form method="post" action="/accounts/">
                <p><span>*</span>: Required</p>
                <span class="warning-text">Password must have at least 1 number, 1 uppercase letter, 1 special character, and be at least 8 characters long.</span>
                <label for='clientPassword'>Password<span>*</span>:</label>
                <div>
                    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" class="form-control" placeholder="Password" minlength="8">
                    <span><label for="showPassword">Show Password?</label>
                    <input type="checkbox" name="showPassword" id="showPassword"></span>
                </div>
        XML;
        
        $main .= <<<XML
                <p class="warning">
                    <label for="acknowledgement">
                    <input type="checkbox" name="acknowledgement" id="acknowledgement" required>By clicking "Change Password" below, I understand that I will need to use the new password.</label>
                </p>
                <button type="submit" value="submit">Change Password</button>
        XML;

        $main .= "<input type='hidden' name='clientId' value='$clientData[clientId]'>";

        $main .= <<<XML
                <input type='hidden' name='action' value='updateUnsafeInfo'>
            </form>
            <hr class="length-eighth-less">
            <br>
        XML;

        $scriptAdditions = <<<XML
            <script src="../js/showPass.js"></script>
        XML;
    }
    require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
?>
