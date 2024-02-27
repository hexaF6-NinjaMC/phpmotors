<?php
    $regex = '/My name is /i';

    $test_string = 'My name is Aaron Bechtel.';
    echo "<p>$test_string</p>";
    $test_string = preg_replace($regex, 'Hello. I am ', $test_string);
    echo "<p>$test_string</p>";

    echo "<hr>";

    $test_string_two = 'How are you today, John?';
    echo "<p>$test_string_two</p>";
    $test_string_two = preg_replace($regex, 'Greetings. ', $test_string_two);
    echo "<p>$test_string_two</p>";
?>