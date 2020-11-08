<?php
    function pdf_generater($image) {
        require('../libs/fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf-> Addpage();
        $pdf-> Image($_SESSION['template'],0,0,210,165);
        $pdf->Output($_SESSION['template_pdf'],"F");
    }   

    function send_Mail($recieverEmail, $recieverSubject, $recieverBody, $recieverImage, $recieverPDF) {
        include('../libs/smtp/PHPMailerAutoload.php');

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = $_SESSION['userEmail'];
        $mail->Password = $_SESSION['userPassword'];
        $mail->setFrom($_SESSION['userEmail']);
        $mail->addAddress($recieverEmail);
        $mail->isHTML(true);
        $mail->Subject = $recieverSubject;
        $mail->Body = $recieverBody;

        if($recieverImage == 'imageSet') {
            $mail->addAttachment($_SESSION['template']);
        }

        if($recieverPDF == 'pdfSet') {
            $mail->addAttachment($_SESSION['template_pdf']);
        }

        $mail->SMTPOptions = array("ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            "allow_self_signed"=>false,
        ));

        if($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    function nl2br2($string) { 
        $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string); 
        return $string; 
    }
?>