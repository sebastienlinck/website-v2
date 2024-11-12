<?php
$svgDirectory = '../img/';
$svgs = [];

if (is_dir($svgDirectory)) {
    $dirHandle = opendir($svgDirectory);
    while (($file = readdir($dirHandle)) !== false) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'svg') {
            $svgs[] = [
                'path' => $svgDirectory . $file,
                'name' => pathinfo($file, PATHINFO_FILENAME)
            ];
        }
    }
    closedir($dirHandle);
}

header('Content-Type: application/json');
echo json_encode($svgs);
?>

