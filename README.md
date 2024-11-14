### randomogg

randomogg returns the absolute path to a random song in a music collection. 
It is assumed that the music source is a nested directroy of arbitrary length 
and depth. It's pretty naive, trusting files ending in .ogg to be Ogg Vorbis 
files. That's faster than polling the OS for its opinion regarding the mimetype
of each file.
 
Notice the shebang at the top, and that it is supposed to be outside of the 
PHP tags. I wanted to use this like a binary program, so I changed the 
file permissions to 755. I copied it to /usr/local/bin/randomogg on my 
machine, so calling randomogg gets the full path to a random song in the 
collection. When you run the script this way, there is no need to add the PHP 
file extension. 

I'm using this with the IceS 2 source server, and the playlist input plugin, 
where type=script and program=/usr/local/bin/randomogg
