Fun with Chromakey (Greenscreen)
==

A friend wants to take pictures of people at an event and
have them appear in front of a background (like the Eiffel
Tower or Niagara Falls). So I put together some chromakey
software to do that. It's in PHP so it's not the fastest
thing on earth but it does this example in under a minute
on my Macbook, so it's probably OK for his needs.

All this code is in the public domain.

How do we figure out what parameters to supply to chromakey.php?

```bash
$ convert CamoTeddy.jpg info:-
CamoTeddy.jpg JPEG 2535x3390 2535x3390+0+0 8-bit sRGB 1.218MB 0.190u 0:00.189

$ convert CamoTeddy.jpg -define histogram:unique-colors=true -format %c histogram:info:- | sort | tail -10
     14983: ( 75,195, 98) #4BC362 srgb(75,195,98)
     15258: ( 67,187, 89) #43BB59 srgb(67,187,89)
     15307: ( 70,190, 92) #46BE5C srgb(70,190,92)
     15374: ( 74,194, 97) #4AC261 srgb(74,194,97)
     15536: ( 68,188, 90) #44BC5A srgb(68,188,90)
     15556: ( 70,190, 93) #46BE5D srgb(70,190,93)
     15558: ( 69,189, 91) #45BD5B srgb(69,189,91)
     16052: ( 71,191, 94) #47BF5E srgb(71,191,94)
     16069: ( 73,193, 96) #49C160 srgb(73,193,96)
     16208: ( 72,192, 95) #48C05F srgb(72,192,95)

# Red:    67 to  75
# Green: 187 to 195
# Blue:   89 to  97
```

R, G, and B have a spread of about 8 for the first ten values in the histogram, and we can figure out the
approximate median values. After some tinkering I arrived at the following and it seemed to be OK. At the
moment I don't remember exactly what I did to arrive at the image dimensions I used, but the RGB images
for the foreground and background do need to be the same dimensions.

```bash
php chromakey.php ct.rgb uw.rgb 73 194 97 50
```
