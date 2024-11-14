#!/usr/bin/env php
<?php 
/**
 * randomogg returns the absolute path to a random song in a music collection. 
 * It is assumed that the music source is a nested directroy of arbitrary length 
 * and depth. It's pretty naive, trusting files ending in .ogg to be Ogg Vorbis 
 * files. That's faster than polling the OS for its opinion regarding the mimetype
 * of each file.
 * 
 * Notice the shebang at the top, and that it is supposed to be outside of the 
 * PHP tags. I wanted to use this like a binary program, so I changed the 
 * file permissions to 755. I copied it to /usr/local/bin/randomogg on my 
 * machine, so calling randomogg gets the full path to a random song in the 
 * collection. Bitbucket.org wants to put a ".php" on the end of this, since I 
 * indicated it was a PHP script, but when you run the script this way, there is 
 * no need to add the PHP file extension. 
 * 
 * I'm using this with the IceS 2 source server, and the playlist input plugin, 
 * where type=script and program=/usr/local/bin/randomogg
 *  
 */ 
// only for debugging purposes
// set_time_limit(0);
// ini_set('memory_limit','-1');

$startpath = "/path/to/music/collection";
$arr = [];

function traverse($dir, &$arr) {
    
    $objects = scandir($dir);
    
    foreach ($objects as $object) {
        
        if ('.' != $object && '..' != $object) {
            
            $item = $dir . '/' . $object;
            
            if (is_dir($item)) {
                
                traverse($item, $arr);
            }
            else {
                
                $arr[] = $item;
            }
        }
    }
}

function callback($var) {
    
    $a = explode('.', $var);
    $ext = array_pop($a);
    
    return ('ogg' === strtolower($ext));
}

traverse($startpath, $arr);

$arr = array_filter($arr, 'callback');
$key = array_rand($arr, 1);

exit($arr[$key]);