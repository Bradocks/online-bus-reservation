//function
<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "../../utils/integrations/Pesapal.php";
require_once __DIR__ . '/../utils/orm/BaseModel.php';
require_once __DIR__ . '/../utils/auth/Auth.php';



$session = new Auth($conn);

$booking_model = new BaseModel('booking', $conn);
$booking_id = isset($_GET['booking_id']) ? (int) $_GET['booking_id'] : null;
$booking = $booking_model->get_one($booking_id, 'bookingid');


$payment_details = [
    "id" => $booking->ticketCode,
    "currency" => "KES",
    "amount" => 2,
    "description" => "Payment for bus",
    "callback_url" => "http://{$_SERVER['HTTP_HOST']}/user/history.php?booking_id={$booking_id}&status=PAID",
    "notification_id" => "a1a6268a-4670-4045-bb8b-e03f928627ec",
    "billing_address" => [
        "email_address" => $session->user()->email,
        "phone_number" => null,
        "country_code" => "",
        "first_name" => $session->user()->name,
        "middle_name" => "",
        "last_name" => "",
        "line_1" => "",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => null,
        "zip_code" => null
    ]
];

$payment_request = new PesapalAPI();

// Keys from https://developer.pesapal.com/api3-demo-keys.txt
$payment_info = $payment_request->submit_order($payment_details);

$booking_model->update(
    $booking_id,
    [
        'PaymentStatement' => $payment_info->order_tracking_id,
    ],
    'bookingid'
);

$iframe = $payment_info->redirect_url;
?>

<html>

<body>
    <iframe width="100%" height="100%" src="<?php echo $iframe ?>"></iframe>
</body>

</html>