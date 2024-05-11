<?php

class PesapalAPI
{
    private $consumer_key;
    private $consumer_secret;
    private $base_url;
    public $access_token;

    public function __construct($consumer_key = "qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW", $consumer_secret = "osGQ364R49cXKeOYSpaOnT++rHs=", $is_sandbox = true)
    {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->base_url = $is_sandbox ? 'https://cybqa.pesapal.com/pesapalv3/' : 'https://www.pesapal.com/api/';
        $this->authenticate();
    }

    public function authenticate()
    {
        $url = $this->base_url . 'api/Auth/RequestToken';


        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "consumer_key" => $this->consumer_key,
            "consumer_secret" => $this->consumer_secret
        ]));


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        $response = json_decode($response, true);

        $this->access_token = $response['token'];
        curl_close($ch);
    }

    public function submit_order($order_details)
    {
        $url = $this->base_url . 'api/Transactions/SubmitOrderRequest';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_details));
        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        return (object) json_decode($response, true);
    }

    public function get_ipn_list()
    {
        $url = $this->base_url . 'apiURLSetup/GetIpnList';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
            'Content-Type: application/json'
        ]);

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        return json_decode($response, true);
    }

    public function check_payment_status($transaction_id)
    {
        $url = "{$this->base_url}api/Transactions/GetTransactionStatus?orderTrackingId={$transaction_id}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->access_token]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        return (object) json_decode($response, true);
    }
}
