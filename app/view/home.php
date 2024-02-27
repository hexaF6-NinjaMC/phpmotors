<?php
    $DELOREAN = '/phpmotors/images/vehicles/delorean.jpg';
    $FLUX_IMG = '/phpmotors/images/upgrades/flux-cap.png';
    $FLAME_DECAL_IMG = '/phpmotors/images/upgrades/flame.jpg';
    $BUMPER_STICKER_IMG = '/phpmotors/images/upgrades/bumper_sticker.jpg';
    $HUB_CAP_IMG = '/phpmotors/images/upgrades/hub-cap.jpg';
    $title = "Home | PHP Motors";
?>

<?php
$main = "
    <h1>Welcome to PHP Motors!</h1>
    <div class='wrapper top'>
        <section id='features'>
            <h2>DMC Delorean</h2>
            <ul>
                <li>3 Cup holders</li>
                <li>Superman doors</li>
                <li>Fuzzy dice!</li>
            </ul>
        </section>
        
        <button id='own-it'>Own Today</button>
        <img src=\"$DELOREAN\" alt='The DMC Delorean, a beauty to behold.'>
    </div>
    <div class='wrapper bottom'>
        <section id='reviews'>
            <h3>DMC Delorean Reviews</h3>
            <ul class='review-list'>
                <li>\"So fast its almost like traveling in time.\" (4/5)</li>
                <li>\"Coolest ride on the road.\" (4/5)</li>
                <li>\"Im feeling Marty McFly!\" (5/5)</li>
                <li>\"The most futuristic ride of our day.\" (4.5/5)</li>
                <li>\"80s livin and I love it!\" (5/5)</li>
            </ul>
        </section>
        <section id='upgrades'>
            <h3>Delorean Upgrades</h3>
            <ul class='upgrade-list'>
                <li><div><img src=\"$FLUX_IMG\" alt='Get a Flux Capacitor and travel through time!'></div><a href='#'>Flux Capacitor</a></li>
                <li><div><img src=\"$FLAME_DECAL_IMG\" alt='Add a snazzy Flame Decal to you Delorean!'></div><a href='#'>Flame Decal</a></li>
                <li><div><img src=\"$BUMPER_STICKER_IMG\" alt='Show off in style with Bumper Stickers!'></div><a href='#'>Bumper Stickers</a></li>
                <li><div><img src=\"$HUB_CAP_IMG\" alt='Style your futuristic ride with Hub Caps!'></div><a href='#'>Hub Caps</a></li>
            </ul>
        </section>
    </div>
    <hr class='length-eighth-less'>
    <br>";
?>

<?php
    require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/template.php';
?>