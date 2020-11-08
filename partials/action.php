<?php
    session_start();
    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
        header('location:index.php');
    }
    include('functions.php');
    
    if(isset($_POST['certificatePreviewBtn'])) {
        
        $target_dir = "certificates/";
        $certificateTemplate = $_FILES['certificateTemplate']['name'];
        $target_file = $target_dir.$certificateTemplate;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
        move_uploaded_file($_FILES["certificateTemplate"]["tmp_name"], $target_file);

        $participantName = $_POST['participantName'];

        if(!empty($participantName)) {
            $participant_fontsize = $_POST['participant_fontsize'];
            $participant_x_axis = $_POST['participant_x_axis'];
            $participant_y_axis = $_POST['participant_y_axis'];
        }
        
        if($imageFileType == 'png') {
            header("content-type:image/png");
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($target_file);
            $color = imagecolorallocate($image,19,21,22);
            $name = "Naman Kumar";
            
            $date_complete = "01-Oct-2020";
            $str = "This is to certify that ".$name." successfully completed the \n\n                         Cyber Security Training,\n\n                             On ".$date_complete;
            
            imagettftext($image,40,0,170,427,$color,$font,$str);
    
            // $date_current = "01-Oct-2020";
            // imagettftext($image,30,0,148,900,$color,$font,$date_current);
            imagepng($image);
            imagedestroy($image);
        } else {
            header("content-type:image/jpeg");
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($target_file);
            $color = imagecolorallocate($image,19,21,22);
            $name = "Naman Kumar";
            
            $date_complete = "01-Oct-2020";
            $str = "This is to certify that ".$name." successfully completed the \n\n                         Cyber Security Training,\n\n                             On ".$date_complete;
            
            imagettftext($image,40,0,170,427,$color,$font,$str);
    
            // $date_current = "01-Oct-2020";
            // imagettftext($image,30,0,148,900,$color,$font,$date_current);
            imagejpeg($image);
            imagedestroy($image);
        }

        unlink($target_file);
    }

    if(isset($_POST['documentId'])) {
        $certificateTemplate = basename(time().$_FILES['doc']['name']);
        $target_dir = "certificates/";
        $target_file = $target_dir.$certificateTemplate;
        $target_file_pdf = "certificates_pdf/".basename(time().'certificatePdf.pdf');

        move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file);

        $_SESSION['template'] = $target_file;
        $_SESSION['template_pdf'] = $target_file_pdf;

        $response = array(
            'template' => $target_file,
            'template_pdf' => $target_file_pdf
        );

        echo json_encode($response);
    }

    if(isset($_POST['participantBtn']) || isset($_POST['participantSave'])) {
        $participantName = $_POST['participantName'];
        $participant_fontsize = $_POST['participant_fontsize'];
        $participant_x_axis = $_POST['participant_x_axis'];
        $participant_y_axis = $_POST['participant_y_axis'];

        $imageFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 

        if($imageFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$participant_fontsize,0,$participant_x_axis,$participant_y_axis,$color,$font,$participantName);
            if(isset($_POST['participantSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
            
        } else {        
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$participant_fontsize,0,$participant_x_axis,$participant_y_axis,$color,$font,$participantName);
    
            if(isset($_POST['participantSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['eventBtn']) || isset($_POST['eventSave'])) {
        $eventName = $_POST['eventName'];
        $event_fontsize = $_POST['event_fontsize'];
        $event_x_axis = $_POST['event_x_axis'];
        $event_y_axis = $_POST['event_y_axis'];

        $imageFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 

        if($imageFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$event_fontsize,0,$event_x_axis,$event_y_axis,$color,$font,$eventName);
            if(isset($_POST['eventSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
        } else {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$event_fontsize,0,$event_x_axis,$event_y_axis,$color,$font,$eventName);
    
            if(isset($_POST['eventSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['resultBtn']) || isset($_POST['resultSave'])) {
        $resultName = $_POST['resultName'];
        $result_fontsize = $_POST['result_fontsize'];
        $result_x_axis = $_POST['result_x_axis'];
        $result_y_axis = $_POST['result_y_axis'];

        $imageFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 

        if($imageFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$result_fontsize,0,$result_x_axis,$result_y_axis,$color,$font,$resultName);

            if(isset($_POST['resultSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
        } else {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$result_fontsize,0,$result_x_axis,$result_y_axis,$color,$font,$resultName);
    
            if(isset($_POST['resultSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['descriptionBtn']) || isset($_POST['descriptionSave'])) {
        $descriptionName = nl2br2($_POST['descriptionName']);
        $description_fontsize = $_POST['description_fontsize'];
        $description_x_axis = $_POST['description_x_axis'];
        $description_y_axis = $_POST['description_y_axis'];

        $imageFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 

        if($imageFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$description_fontsize,0,$description_x_axis,$description_y_axis,$color,$font,$descriptionName);

            if(isset($_POST['descriptionSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
        } else {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$description_fontsize,0,$description_x_axis,$description_y_axis,$color,$font,$descriptionName);
    
            if(isset($_POST['descriptionSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['dateBtn']) || isset($_POST['dateSave'])) {
        $dateName = $_POST['dateName'];
        $date_fontsize = $_POST['date_fontsize'];
        $date_x_axis = $_POST['date_x_axis'];
        $date_y_axis = $_POST['date_y_axis'];

        $imageFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 

        if($imageFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$date_fontsize,0,$date_x_axis,$date_y_axis,$color,$font,$dateName);

            if(isset($_POST['dateSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
        } else {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$date_fontsize,0,$date_x_axis,$date_y_axis,$color,$font,$dateName);
    
            if(isset($_POST['dateSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['organiserBtn']) || isset($_POST['organiserSave'])) {
        $organiserName = $_POST['organiserName'];
        $organiser_fontsize = $_POST['organiser_fontsize'];
        $organiser_x_axis = $_POST['organiser_x_axis'];
        $organiser_y_axis = $_POST['organiser_y_axis'];

        $imageFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 

        if($imageFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$organiser_fontsize,0,$organiser_x_axis,$organiser_y_axis,$color,$font,$organiserName);

            if(isset($_POST['organiserSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
        } else {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $color = imagecolorallocate($image,19,21,22);
            imagettftext($image,$organiser_fontsize,0,$organiser_x_axis,$organiser_y_axis,$color,$font,$organiserName);
    
            if(isset($_POST['organiserSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['signId'])) {
        $signTemplate = basename(time().$_FILES['doc']['name']);
        $target_dir = "signes/";
        $target_file = $target_dir.$signTemplate;

        move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file);

        $_SESSION['sign'] = $target_file;

        echo true;
    }

    if(isset($_POST['signPosBtn']) || isset($_POST['signPosSave'])) {
        $signPos_x_axis = $_POST['signPos_x_axis'];
        $signPos_y_axis = $_POST['signPos_y_axis'];

        $certificateFileType = strtolower(pathinfo($_SESSION['template'],PATHINFO_EXTENSION)); 
        $signFileType = strtolower(pathinfo($_SESSION['sign'],PATHINFO_EXTENSION)); 

        if($certificateFileType == 'png' && $signFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $im2 = imagecreatefrompng($_SESSION['sign']);

            imagecopy($image, $im2, $signPos_x_axis, $signPos_y_axis, 0, 0, imagesx($im2), imagesy($im2));

            if(isset($_POST['signPosSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
            imagedestroy($im2);

        } else if(($certificateFileType == 'jpg' || $certificateFileType == 'jpeg') && $signFileType == 'png') {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $im2 = imagecreatefrompng($_SESSION['sign']);

            imagecopy($image, $im2, $signPos_x_axis, $signPos_y_axis, 0, 0, imagesx($im2), imagesy($im2));

            if(isset($_POST['signPosSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
            imagedestroy($im2);

        }  else if($certificateFileType == 'png' && ($signFileType == 'jpg' || $signFileType == 'jpeg')) {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefrompng($_SESSION['template']);
            $im2 = imagecreatefromjpeg($_SESSION['sign']);

            imagecopy($image, $im2, $signPos_x_axis, $signPos_y_axis, 0, 0, imagesx($im2), imagesy($im2));

            if(isset($_POST['signPosSave'])) {
                imagepng($image, $_SESSION['template']);
            }else{
                header("content-type:image/png");
                imagepng($image);
            }
            imagedestroy($im2);
        } else {
            $font = realpath("fonts/font1.ttf");
            $image = imagecreatefromjpeg($_SESSION['template']);
            $im2 = imagecreatefromjpeg($_SESSION['sign']);

            imagecopy($image, $im2, $signPos_x_axis, $signPos_y_axis, 0, 0, imagesx($im2), imagesy($im2));

            if(isset($_POST['signPosSave'])) {
                imagejpeg($image, $_SESSION['template']);
            }else{
                header("content-type:image/jpeg");
                imagejpeg($image);
            }
            imagedestroy($im2);
        }

        pdf_generater($image);
        imagedestroy($image);
        echo $_SESSION['template'];

    }

    if(isset($_POST['recieverEmail'])) {
        $recieverEmail = $_POST['recieverEmail'];
        $recieverSubject = $_POST['recieverSubject'];
        $recieverBody = $_POST['recieverBody'];
        $recieverImage = $_POST['recieverImage'];
        $recieverPDF = $_POST['recieverPDF'];

        $mailResponse = send_Mail($recieverEmail, $recieverSubject, $recieverBody, $recieverImage, $recieverPDF);

        if($mailResponse) {
            echo true;
        } else {
            echo -1;
        }
    }
?>