#!/bin/sh

if [ ! -f uw.rgb ]
then
    # this would be done only once
    convert underwater.jpg -resize 'x3390' -depth 8 -crop 2535x3390+2500+0 uw.rgb
fi

convert CamoTeddy.jpg ct.rgb

php chromakey.php ct.rgb uw.rgb 73 194 97 50 > result.rgb

convert -size 2535x3390 -depth 8 -quality 40 result.rgb result.jpg
