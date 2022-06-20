<?php

/** create XML file */ 

$mysqli = new mysqli("localhost", "root", "", "carrentalp");


/* check connection */
if ($mysqli->connect_errno) {
   echo "Connect failed ".$mysqli->connect_error;
   exit();
}



$query = "SELECT id, customer_username, car_id, driver_id, booking_date, fare FROM rentedcars";

$booksArray = array();

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {

       array_push($booksArray, $row);
    }
  
    if(count($booksArray)){

         createXMLfile($booksArray);

     }

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

function createXMLfile($booksArray){
  
   $filePath = 'book.xml';

   $dom     = new DOMDocument('1.0', 'utf-8'); 

   $root      = $dom->createElement('books'); 

   for($i=0; $i<count($booksArray); $i++){
     
     $bookId        =  $booksArray[$i]['id'];  

     $bookName      =  htmlspecialchars($booksArray[$i]['customer_username']); 

     $bookAuthor    =  $booksArray[$i]['car_id']; 

     $bookPrice     =  $booksArray[$i]['driver_id']; 

     $bookISBN      =  $booksArray[$i]['booking_date']; 

     $bookCategory  =  $booksArray[$i]['fare'];	

     $book = $dom->createElement('book');

     $book->setAttribute('id', $bookId);

     $name     = $dom->createElement('title', $bookName); 

     $book->appendChild($name); 

     $author   = $dom->createElement('author', $bookAuthor); 

     $book->appendChild($author); 

     $price    = $dom->createElement('price', $bookPrice); 

     $book->appendChild($price); 

     $isbn     = $dom->createElement('ISBN', $bookISBN); 

     $book->appendChild($isbn); 
     
     $category = $dom->createElement('category', $bookCategory); 

     $book->appendChild($category);
 
     $root->appendChild($book);

   }

   $dom->appendChild($root); 

   $dom->save($filePath); 

 } 