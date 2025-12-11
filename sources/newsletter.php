<?php
/* Newsletter */
    if(isset($_POST['mail_type']))
    {
        $responseCaptcha = $_POST['recaptcha_response_mail'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (isset($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (isset($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (isset($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        if(($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true)
        {
            $data = array();
            $data['ten'] = (isset($_REQUEST['mail_name']) && $_REQUEST['mail_name'] != '') ? htmlspecialchars($_REQUEST['mail_name']) : '';
            $data['email'] = (isset($_REQUEST['mail_email']) && $_REQUEST['mail_email'] != '') ? htmlspecialchars($_REQUEST['mail_email']) : '';
            $data['dienthoai'] = (isset($_REQUEST['mail_phone']) && $_REQUEST['mail_phone'] != '') ? htmlspecialchars($_REQUEST['mail_phone']) : '';
            $data['diachi'] = (isset($_REQUEST['mail_address']) && $_REQUEST['mail_address'] != '') ? htmlspecialchars($_REQUEST['mail_address']) : '';
            $data['chude'] = (isset($_REQUEST['mail_topic']) && $_REQUEST['mail_topic'] != '') ? htmlspecialchars($_REQUEST['mail_topic']) : '';
            $data['ngaytao'] = time();
            $data['type'] = $_POST['mail_type'];

            if($d->insert('newsletter',$data))
            {
                $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.",$config_base);
            }
            else
            {
                $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
            }
        }
        else
        {
            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
        }
    }
?>