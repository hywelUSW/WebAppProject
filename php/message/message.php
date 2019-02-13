<?php
class message{
    //send email to admin
    function sendEmail($emailRecipient,$subject,$message)
    {
        //stops 
        $text = str_replace("\n.", "\n..", $text);
        $emailSender = "15080900@students.southwales.ac.uk";
        $header = "From:" . $from;
    
        if(mail($emailRecipient,$subject,$message, $headers))
        {
            echo "true";
            return true;
        } 
        else 
        {
            echo ("<script>alert('email function is disabled, due to being hosted on university servers.');</script>");
            return false;
        }
        
    }
}
$message = new message();
$message->sendEmail("15080900@students.southwales.ac.uk","test","test");
   
?>
