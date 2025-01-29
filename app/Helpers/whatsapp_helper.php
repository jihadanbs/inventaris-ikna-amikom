<?php
if (!function_exists('sendWhatsappMessage')) {
    function sendWhatsappMessage($phone, $message, $redirect_url)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $waUrl = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . urlencode($message);

        echo "<script>
            window.location.href = '$waUrl';
    
            window.onpopstate = function() {
                window.location.href = '$redirect_url';
            };
    
            setTimeout(function() {
                window.location.href = '$redirect_url';
            }, 1000);
        </script>";
        exit;
    }
}
