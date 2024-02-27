<header>
    <a href="/"><img src="/images/site/logo.png" alt="PHP Motors logo" id="logo"></a>
    <?php
        if (isset($_SESSION['clientData'])) {
            $clientData = $_SESSION['clientData'];
            echo "<span id='welcome-msg'>Welcome, <a href='/accounts/?action=logged-in'>$clientData[clientFirstname]</a> | <a href='/accounts/?action=logout'>Logout</a></span>";
        } else {
            echo '<a href="/accounts/" id="my-account">My Account</a>';
        }
     ?>
    <nav>
        <button>&#9776; Menu</button>
        <?php echo $navList; ?>
    </nav>
</header>
