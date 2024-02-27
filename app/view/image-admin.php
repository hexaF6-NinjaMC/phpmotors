<?php
    if (!$_SESSION['loggedin'] or $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /');
    } else {
        $title = "Image Management | PHP Motors, Inc.";
        $main = "<h1>Image Management</h1>";

        $main .= "<br><p>Welcome! Please use one of the options below:</p>";

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <form action="/app/uploads/" method="post" enctype="multipart/form-data">
                <label for="invId">Vehicle</label>
        XML;

        if (isset($prodSelect)) {
            $main .= $prodSelect;
        } else {
            $main .= '';
        }

        $main .= <<<XML
            <fieldset>
                <p>Is this the main image for the vehicle?</p>
                <label for="priYes" class="pImage">Yes</label>
                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                <label for="priNo" class="pImage">No</label>
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
            </fieldset>
            <label for="file1">Upload Image:</label>
            <input type="file" name="file1" id="file1">
            <button type="submit" value="submit" class="regbtn">Upload</button>
            <input type="hidden" name="action" value="upload">
            </form>
            
            <hr class="length-eighth-less">
            <section>
                <h2 class="mb-two pl-two">Existing Images</h2>
                <p class="message notice mb-two">If deleting an image, delete the thumbnail too and vice versa.</p>
        XML;

        if (isset($imageDisplay)) {
            $main .= $imageDisplay;
        }

        $main .= '</section>
        <hr class="length-eighth-less">
        <br>';

        $extras = True;

        require $_SERVER['DOCUMENT_ROOT'].'/app/view/template.php';
    }
?>
