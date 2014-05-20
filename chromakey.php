<?php

$foreground = fopen($argv[1], 'r');
$background = fopen($argv[2], 'r');
$R = (int) $argv[3];
$G = (int) $argv[4];
$B = (int) $argv[5];
$fuzz = (int) $argv[6];

while (true) {
	if (feof($foreground)) {
		if (!feof($background)) {
			fwrite(STDERR, "Foreground and background are different sizes\n");
			exit(1);
		}
		exit(0);
	}
	if (feof($background)) {
		fwrite(STDERR, "Foreground and background are different sizes\n");
		exit(1);
	}
    $fr = ord(fread($foreground, 1));
    $fg = ord(fread($foreground, 1));
    $fb = ord(fread($foreground, 1));
	// fwrite(STDERR, "$fr $fg $fb\n");
    $br = ord(fread($background, 1));
    $bg = ord(fread($background, 1));
    $bb = ord(fread($background, 1));
	$rdiff = $fr - $R;
	$gdiff = $fg - $G;
	$bdiff = $fb - $B;
    if ($rdiff * $rdiff + $gdiff * $gdiff + $bdiff * $bdiff > $fuzz * $fuzz)
        printf("%c%c%c", $fr, $fg, $fb);
    else
        printf("%c%c%c", $br, $bg, $bb);
}

fclose($foreground);
fclose($background);
?>
