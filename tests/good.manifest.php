<?php header( 'Content-type: text/cache-manifest' ); ?>CACHE MANIFEST # Comments are OK here
# Generated: <?php echo date( 'o-m-d' ); ?>T<?php echo date( 'H:i:s.u' ); echo "\n";?>
# Random: <?php echo rand(); echo "\n"; ?>
 # Spaces before comments shouldn't matter

assets/test.css

assets/test.html
assets/test.js # Comments are OK out here.

NETWORK: # Comments are OK here too.
http://manifesto.ericdelabar.com/tests/assets/test.gif
http://www.google.com/

 CACHE:
 assets/test.png

FALLBACK:
assets/test.png assets/test2.png # Comment ok here?
*.jpg assets/test.jpg

CACHE:
assets/test.jpg
/tests/assets/test.gif
assets/test.gif

NETWORK:
*