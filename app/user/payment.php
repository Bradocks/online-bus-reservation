<?php

require_once __DIR__ . "../../utils/integrations/Pesapal.php";

$payment_details = [
    "id" => "TESTEBO100",
    "currency" => "KES",
    "amount" => 100.00,
    "description" => "Payment description goes here",
    "callback_url" => "https://localhost:50000/user/book.php",
    "notification_id" => "a1a6268a-4670-4045-bb8b-e03f928627ec",
    "billing_address" => [
        "email_address" => "john.doe@example.com",
        "phone_number" => null,
        "country_code" => "",
        "first_name" => "John",
        "middle_name" => "",
        "last_name" => "Doe",
        "line_1" => "",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => null,
        "zip_code" => null
    ]
];

$payment_request = new PesapalAPI(
    "qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW",
    "osGQ364R49cXKeOYSpaOnT++rHs="
);

$payment_request->authenticate();
$iframe = $payment_request->submit_order($payment_details)->redirect_url
?>

<html>

<body>
    <iframe width="100%" height="100%" src="<?php echo $iframe ?>"></iframe>
</body>

</html>