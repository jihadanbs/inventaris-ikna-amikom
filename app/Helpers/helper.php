<!-- // if (!function_exists('sendWhatsappMessage')) {
// function sendWhatsappMessage($phone, $message)
// {
// $curl = curl_init();

// Hapus karakter selain angka dari nomor telepon
// $phone = preg_replace('/[^0-9]/', '', $phone);

// Tambahkan 62 jika nomor dimulai dengan 0
// if (substr($phone, 0, 1) === '0') {
// $phone = '62' . substr($phone, 1);
// }

// $waUrl = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . urlencode($message);
// curl_setopt_array($curl, array(
// CURLOPT_URL => 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . urlencode($message),
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_ENCODING => '',
// CURLOPT_MAXREDIRS => 10,
// CURLOPT_TIMEOUT => 0,
// CURLOPT_FOLLOWLOCATION => true,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => 'GET',
// ));

// $response = curl_exec($curl);
// curl_close($curl);
// return $response;
// header('Location: ' . $waUrl);
// exit;
// } -->