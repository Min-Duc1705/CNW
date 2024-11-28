<?php
function loadFlowers($file = 'flower.json') {
    if (file_exists($file)) {
        $data = file_get_contents($file);
        return json_decode($data, true) ?? [];
    }
    return [];
}

function saveFlowers($flowers, $file = 'flower.json') {
    file_put_contents($file, json_encode($flowers, JSON_PRETTY_PRINT));
}
?>
