<?php
if(isset($_POST['form-name'])){
    if($_POST['form-name']=='contact-page' || $_POST['form-name']=='inquire'){
        session_start();
    }
    $subject = "Mail from aitnashik.com";
    $to = "sumant@accesscadd.com";
    $headers = "From: aitnashikforms@aitnashik.com";
    $reply = '';
    $reply_to_email = "sumant@accesscadd.com";
    switch($_POST['form-name']){
        case "contact-page":
            if($_POST) {
                if(isset($_POST['captcha_challenge'])){
                    if($_POST['captcha_challenge'] == $_SESSION['captcha_text']) {
                        if(isset($_POST['sname']) && isset($_POST['contact']) && isset($_POST['email']) && isset($_POST['comment'])){
                            $msg = "Form details of Contact page form on aitnashik.com.\nName: ".$_POST['sname']."\nContact: ".$_POST['contact']."\nEmail: ".$_POST['email']."\nComment: \n    ".$_POST['comment'];
                            $msg = wordwrap($msg, 70);
                            if(mail($to, $subject, $msg, $headers)){
                                $reply.='Thank you for contacting us. We will reply you ASAP.';
                            }else{
                                $reply.='Unable to connect at the moment.';
                            }
                        }else{
                            $reply.='Please fill all fields.';
                        }
                    } else {
                        $reply.='Incorrect Captcha.';
                    }
                }
                
            } else {
                $reply .= 'Something went wrong.';
            }
            session_destroy();
            header('location: ../pages/contact.php?reply='.$reply.'#contact');
        break;
        case "career-cv":
            if(isset($_POST['email']))
            {
                $from_email         = 'aitnashikforms@aitnashik.com'; //from mail, sender email address
                $recipient_email = $to; //recipient email address
                
                //Load POST data from HTML form
                $fullName = $_POST["name"]; //sender name
                $contact = $_POST["contact"]; //sender email, it will be used in "reply-to" header
                $email = $_POST["email"]; //subject for the email
                    
                /*Always remember to validate the form fields like this
                if(strlen($sender_name)<1)
                {
                    die('Name is too short or empty!');
                }
                */   
                //Get uploaded file data using $_FILES array
                $tmp_name = $_FILES['cv']['tmp_name']; // get the temporary file name of the file on the server
                $name     = $_FILES['cv']['name']; // get the name of the file
                $size     = $_FILES['cv']['size']; // get size of the file for size validation
                $type     = $_FILES['cv']['type']; // get type of the file
                $error     = $_FILES['cv']['error']; // get the error (if any)
                    
                //validate form field for attaching the file
                if($error > 0)
                {
                    die('Upload error or No files uploaded');
                }
                //read from the uploaded file & base64_encode content
                $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
                $content = fread($handle, $size); // reading the file
                fclose($handle);                 // close upon completion
                    
                $encoded_content = chunk_split(base64_encode($content));
                $boundary = md5("random"); // define boundary with a md5 hashed value
                    
                //header
                $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
                $headers .= "From:".$from_email."\r\n"; // Sender Email
                $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
                $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
                $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
                        
                //plain text
                $body = "--$boundary\r\n";
                $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= "Career Form on aitnashik.com.\nName: $fullName\nContact: $contact\nEmail: $email\nCV attached below.\n";
                // $body .= chunk_split(base64_encode($message));
                        
                // attachment
                $body .= "--$boundary\r\n";
                $body .="Content-Type: $type; name=".$name."\r\n";
                $body .="Content-Disposition: attachment; filename=".$name."\r\n";
                $body .="Content-Transfer-Encoding: base64\r\n";
                $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
                $body .= $encoded_content; // Attaching the encoded file with email
                $sentMailResult = mail($recipient_email, $subject, $body, $headers);
                    
                if($sentMailResult)
                {
                    $reply.='File Uploaded Successfully.';
                    // unlink($name); // delete the file after attachment sent.
                }
                else
                {
                    $reply .= 'Unable to upload cv.';
                }
            }else{
                $reply.="please fill all the fields.";
            }
            header('location: ../pages/career.html?reply='.$reply);
        break;
        case 'seminar':
                if($_POST){
                    if(isset($_POST['select']) && isset($_POST['topic']) && isset($_POST['college']) && isset($_POST['branch']) && isset($_POST['students']) && isset($_POST['contact']) && isset($_POST['mobile']) && isset($_POST['email'])){
                        $msg = "Free Seminars & Workshop Form on aitnashik.com.\nRequirement type: ".$_POST['select']."\nTopic / Software: ".$_POST['topic']."\nCollege Name: ".$_POST['college']."\nBranch: ".$_POST['branch']."\nNo. of Students: ".$_POST['students']."\nContact Person: ".$_POST['contact']."\nMobile No.: ".$_POST['mobile']."\nEmail: ".$_POST['email'];
                        $msg = wordwrap($msg, 70);
                        if(mail($to, $subject, $msg, $headers)){
                            $reply.='Thank you for contacting us. We will reply you ASAP.';
                        }else{
                            $reply.='Unable to connect at the moment.';
                        }
                    }else{
                        $reply.='Please fill all fields.';
                    }
                    header('location: ../pages/corporate-training.html?reply='.$reply);
                }
        break;
        case 'training':
                if($_POST){
                    if(isset($_POST['contact']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['note'])){
                        $msg = "Training Requirements Form on aitnashik.com.\nContact Person: ".$_POST['contact']."\nMobile No.: ".$_POST['mobile']."\nEmail: ".$_POST['email']."\nNote:\n  ".$_POST['note'];
                        $msg = wordwrap($msg, 70);
                        if(mail($to, $subject, $msg, $headers)){
                            $reply.='Thank you for contacting us. We will reply you ASAP.';
                        }else{
                            $reply.='Unable to connect at the moment.';
                        }
                    }else{
                        $reply.='Please fill all fields.';
                    }
                    header('location: ../pages/corporate-training.html?reply='.$reply);
                }
        break;
        case 'internship':
                if($_POST){
                    if(isset($_POST['fullname']) && isset($_POST['contact']) && isset($_POST['college']) && isset($_POST['branch']) && isset($_POST['year']) && isset($_POST['email'])){
                        $msg = "Enquire for Internship / In-Plant Form on aitnashik.com.\nFull Name: ".$_POST['fullname']."\nMobile No.: ".$_POST['contact']."\nEmail: ".$_POST['email']."\nCollege Name: ".$_POST['college']."\nBranch: ".$_POST['branch']."\nYear: ".$_POST['year'];
                        $msg = wordwrap($msg, 70);
                        if(mail($to, $subject, $msg, $headers)){
                            $reply.='Thank you for contacting us. We will reply you ASAP.';
                        }else{
                            $reply.='Unable to connect at the moment.';
                        }
                    }else{
                        $reply.='Please fill all fields.';
                    }
                    header('location: ../pages/internship-plant.html?reply='.$reply);
                }
        break;
        case 'career-guidance':
                if($_POST){
                    if(isset($_POST['fullname']) && isset($_POST['contact']) && isset($_POST['stream']) && isset($_POST['wstatus']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['queries'])){
                        $msg = "Free Registration for Career Counselling Form on aitnashik.com.\nFull Name: ".$_POST['fullname']."\nMobile No.: ".$_POST['mobile']."\nEmail: ".$_POST['email']."\nWhatsapp No.: ".$_POST['contact']."\nStream of Education: ".$_POST['stream']."\nWhat are you currently doing?: ".$_POST['wstatus']."\nQueries: ".$_POST['queries'];
                        $msg = wordwrap($msg, 70);
                        if(mail($to, $subject, $msg, $headers)){
                            $reply.='Thank you for contacting us. We will reply you ASAP.';
                        }else{
                            $reply.='Unable to connect at the moment.';
                        }
                    }else{
                        $reply.='Please fill all fields.';
                    }
                    header('location: ../pages/career-guidance.html?reply='.$reply);
                }
        break;
        case 'online-training':
                if($_POST){
                    if(isset($_POST['fullname']) && isset($_POST['contact']) && isset($_POST['stream']) && isset($_POST['email'])){
                        $msg = "Enquire Online Training Form on aitnashik.com.\nFull Name: ".$_POST['fullname']."\nMobile No.: ".$_POST['contact']."\nEmail: ".$_POST['email']."\nStream of Education:\n  ".$_POST['stream'];
                        $msg = wordwrap($msg, 70);
                        if(mail($to, $subject, $msg, $headers)){
                            $reply.='Thank you for contacting us. We will reply you ASAP.';
                        }else{
                            $reply.='Unable to connect at the moment.';
                        }
                    }else{
                        $reply.='Please fill all fields.';
                    }
                    header('location: ../pages/online-training.html?reply='.$reply);
                }
        break;
        case "inquire":
                if($_POST) {
                    if(isset($_POST['captcha_challenge'])){
                        if($_POST['captcha_challenge'] == $_SESSION['captcha_text']) {
                            if(isset($_POST['name']) && isset($_POST['contact']) && isset($_POST['email']) && isset($_POST['course']) && isset($_POST['qualification']) && isset($_POST['stream'])){
                                $msg = "Inquire Now Form on aitnashik.com.\nName: ".$_POST['name']."\nEmail: ".$_POST['email']."\nContact: ".$_POST['contact']."\nCourse: ".$_POST['course']."\nQualification: ".$_POST['qualification']."\nStream: ".$_POST['stream'];
                                $msg = wordwrap($msg, 70);
                                if(mail($to, $subject, $msg, $headers)){
                                    $reply.='Thank you for contacting us. We will reply you ASAP.';
                                }else{
                                    $reply.='Unable to connect at the moment.';
                                }
                            }else{
                                $reply.='Please fill all fields.';
                            }
                        } else {
                            $reply.='Incorrect Captcha.';
                        }
                    }
                    
                } else {
                    $reply .= 'Something went wrong.';
                }
                session_destroy();
                header('location: ../pages/inquire.html?reply='.$reply);
        break;
        case "display-project":
            if(isset($_POST['title']) && isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['college']) && isset($_POST['software']) && isset($_POST['achivement']) && isset($_POST['introduction']))
            {
                $from_email         = 'aitnashikforms@aitnashik.com'; //from mail, sender email address
                $recipient_email = $to; //recipient email address
                
                //Load POST data from HTML form
                $fullName = $_POST["name"]; //sender name
                $contact = $_POST["mobile"]; //sender email, it will be used in "reply-to" header
                    
                /*Always remember to validate the form fields like this
                if(strlen($sender_name)<1)
                {
                    die('Name is too short or empty!');
                }
                */   
                //Get uploaded file data using $_FILES array
                $tmp_name = $_FILES['project']['tmp_name']; // get the temporary file name of the file on the server
                $name     = $_FILES['project']['name']; // get the name of the file
                $size     = $_FILES['project']['size']; // get size of the file for size validation
                $type     = $_FILES['project']['type']; // get type of the file
                $error     = $_FILES['project']['error']; // get the error (if any)
                    
                //validate form field for attaching the file
                if($error > 0)
                {
                    die('Upload error or No files uploaded');
                }
                //read from the uploaded file & base64_encode content
                $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
                $content = fread($handle, $size); // reading the file
                fclose($handle);                 // close upon completion
                    
                $encoded_content = chunk_split(base64_encode($content));
                $boundary = md5("random"); // define boundary with a md5 hashed value
                    
                //header
                $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
                $headers .= "From:".$from_email."\r\n"; // Sender Email
                $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
                $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
                $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
                        
                //plain text
                $body = "--$boundary\r\n";
                $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= "Display My Project Form on aitnashik.com.\nName: $fullName\nContact: $contact\nProject Title: ".$_POST['title']."\nCollege: ".$_POST['college']."\nSoftware: ".$_POST['software']."\nAchivement: ".$_POST['achivement']."\nIntroduction: ".$_POST['introduction']."\nFiles uploaded: \n";
                // $body .= chunk_split(base64_encode($message));
                        
                // attachment
                $body .= "--$boundary\r\n";
                $body .="Content-Type: $type; name=".$name."\r\n";
                $body .="Content-Disposition: attachment; filename=".$name."\r\n";
                $body .="Content-Transfer-Encoding: base64\r\n";
                $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
                $body .= $encoded_content; // Attaching the encoded file with email
                $sentMailResult = mail($recipient_email, $subject, $body, $headers);
                    
                if($sentMailResult)
                {
                    $reply.='Thank You. We will reply you ASAP.';
                    // unlink($name); // delete the file after attachment sent.
                }
                else
                {
                    $reply .= 'Unable to proceed at the moment.';
                }
            }else{
                $reply.="please fill all the fields.";
            }
            header('location: ../pages/student-projects.html?reply='.$reply);
        break;
        case "help-project":
            if(isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['college']) && isset($_POST['software']) && isset($_POST['title']) && isset($_POST['introduction']) && isset($_POST['contact']))
            {
                $from_email         = 'aitnashikforms@aitnashik.com'; //from mail, sender email address
                $recipient_email = $to; //recipient email address
                
                //Load POST data from HTML form
                $fullName = $_POST['name']; //sender name
                $contact = $_POST["mobile"]; //sender email, it will be used in "reply-to" header

                /*Always remember to validate the form fields like this
                if(strlen($sender_name)<1)
                {
                    die('Name is too short or empty!');
                }
                */   
                //Get uploaded file data using $_FILES array
                $tmp_name = $_FILES['project']['tmp_name']; // get the temporary file name of the file on the server
                $name     = $_FILES['project']['name']; // get the name of the file
                $size     = $_FILES['project']['size']; // get size of the file for size validation
                $type     = $_FILES['project']['type']; // get type of the file
                $error     = $_FILES['project']['error']; // get the error (if any)
                    
                //validate form field for attaching the file
                if($error > 0)
                {
                    die('Upload error or No files uploaded');
                }
                //read from the uploaded file & base64_encode content
                $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
                $content = fread($handle, $size); // reading the file
                fclose($handle);                 // close upon completion
                    
                $encoded_content = chunk_split(base64_encode($content));
                $boundary = md5("random"); // define boundary with a md5 hashed value
                    
                //header
                $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
                $headers .= "From:".$from_email."\r\n"; // Sender Email
                $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
                $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
                $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
                        
                //plain text
                $body = "--$boundary\r\n";
                $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= "Help My Project Form on aitnashik.com.\nName: $fullName\nMobile No.: $contact\nContact Person: ".$_POST['contact']."\nCollege: ".$_POST['college']."\nSoftware: ".$_POST['software']."\nProject Title: ".$_POST['title']."\nIntroduction: ".$_POST['introduction']."\nFiles uploaded: \n";
                // $body .= chunk_split(base64_encode($message));
                        
                // attachment
                $body .= "--$boundary\r\n";
                $body .="Content-Type: $type; name=".$name."\r\n";
                $body .="Content-Disposition: attachment; filename=".$name."\r\n";
                $body .="Content-Transfer-Encoding: base64\r\n";
                $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
                $body .= $encoded_content; // Attaching the encoded file with email
                $sentMailResult = mail($recipient_email, $subject, $body, $headers);
                    
                if($sentMailResult)
                {
                    $reply.='Thank You. We will reply you ASAP.';
                    // unlink($name); // delete the file after attachment sent.
                }
                else
                {
                    $reply .= 'Unable to proceed at the moment.';
                }
            }else{
                $reply.="please fill all the fields.";
            }
            header('location: ../pages/student-projects.html?reply='.$reply);
        break;
        default:
            header('location: ../index.html');
    }
}
?>