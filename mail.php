<?php
include 'header.php';
//check if the $_POST array isset and not empty and is an array otherwise show error message
if(isset($_POST) && !empty($_POST) && is_array($_POST)){
//put the values from the $post[key] and Convert the special characters to HTML entities and put that in a variable
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $email = htmlspecialchars($_POST['email']);
//put the value from $_post['question'] with and Wraps the string to a 50 number of characters and put it in $question
    $question = wordwrap($_POST['question'],50,"\r\n");

//    Additional headers
    $headers = "From: Fletcher Hotels website \r\n";
    $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
    $headers .= "CC: rivahoen79@hotmail.com\r\n";
//    To send HTML mail, the Content-type header must be set
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

//    the message with html and the values from the variabels with stripped tags
    $contend = '<html><body>';
    $contend .= 'De gegevens zijn:<BR><BR>';
    $contend .= '<table rules="all" style="border: #666666;" cellpadding="10">';
    $contend .= "<tr style='background: #E3E3E3;'><td><strong></strong> </td><td>Gegevens</td></tr>";
    $contend .= "<tr><td><strong>Van :</strong> </td><td>" . strip_tags($name) . "</td></tr>";
    $contend .= "<tr><td><strong>Adres :</strong> </td><td>" . strip_tags($address) . "</td></tr>";
    $contend .= "<tr><td><strong>Woonplaats:</strong> </td><td>" . strip_tags($city) . "</td></tr>";
    $contend .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($email) . "</td></tr>";
    $contend .= "<tr><td><strong>De vraag is:</strong> </td><td>" . $question . "</td></tr>";
    $contend .= "</table></body></html>";

//    and mail it
    $respons = mail('rivahoen79@hotmail.com', 'U heeft een nieuwe vraag ontvangen.',$contend, $headers);

//    check if it is send and show a succes message otherwise an error message
    if($respons === true){
        echo '<p>Uw email is verzonden.</p>';
    }
    else{
        echo "<p>Er is iets mis gegaan.</p>";
    }
}
else{
    echo '<p>Er is iets mis gegaan.</p>';
}
include 'footer.php';
?>