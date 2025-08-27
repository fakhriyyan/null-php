<?php
/*
 *  Barcode generator tanpa GD (output SVG)
 *  Author: David S. Tufts (modified)
 *  Updated: 2025
 *  Usage:
 *    <img src="barcode.php?text=12345&codetype=code128&print=true" />
 */

$text       = $_GET["text"]       ?? "0";
$size       = $_GET["size"]       ?? "50"; // tinggi barcode
$orientation= $_GET["orientation"]?? "horizontal";
$code_type  = $_GET["codetype"]   ?? "code128";
$print      = isset($_GET["print"]) && $_GET["print"] === "true";
$sizefactor = $_GET["sizefactor"] ?? 2;

echo barcode_svg($text, $size, $orientation, $code_type, $print, $sizefactor);

function barcode_svg($text="0", $height=50, $orientation="horizontal", $code_type="code128", $print=false, $sizefactor=2) {
    $code_array = [
        "0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212",
        "6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122","A"=>"111323","B"=>"131123",
        "C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113",
        "I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321",
        "O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311",
        "U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311",
    ];

    $pattern = "";
    $text = strtoupper($text);

    for ($i=0; $i<strlen($text); $i++) {
        $char = $text[$i];
        if (isset($code_array[$char])) {
            $pattern .= $code_array[$char];
        }
    }

    $width = strlen($pattern) * $sizefactor;
    $totalHeight = $print ? $height + 20 : $height;

    header("Content-Type: image/svg+xml");
    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='{$width}' height='{$totalHeight}'>";

    $x = 0;
    for ($i=0; $i<strlen($pattern); $i++) {
        $barWidth = intval($pattern[$i]) * $sizefactor;
        if ($i % 2 == 0) { // bar hitam
            $svg .= "<rect x='{$x}' y='0' width='{$barWidth}' height='{$height}' fill='black'/>";
        }
        $x += $barWidth;
    }

    if ($print) {
        $svg .= "<text x='50%' y='".($height+15)."' font-family='Arial' font-size='14' text-anchor='middle'>{$text}</text>";
    }

    $svg .= "</svg>";

    return $svg;
}
