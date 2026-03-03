<?php

// $file=fopen("data.txt","w");
// var_dump($file);

// fwrite($file,"Hello World");

// fclose($file);

//w= emptiy to write w+ empity write and read
//a=append coresser is donen a+ append and read
//r=read only r+ read and write
fopen("data.txt","r");
$data=fgets($file);

rewind($file);
fseek($file,5);
ftell($file);
echo "<ul>";
while(!feof($file)){
    $data=fgets($file);
    echo "<li>".$data."</li>";
}
echo "</ul>";
fclose($file);

file_put_contents("data.txt","Hello World Again");//to write can append 
file_get_contents("data.txt");//to get
var_dump($data);//string

$file_data=file("data.txt");
var_dump($file_data);//array

readfile("data.txt");//to read and print
?>