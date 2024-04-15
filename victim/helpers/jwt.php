<?php
class JWTHelper {
    private $headers;
    private $secret;

    public function __construct()
    {
        $this->headers = [
            'alg' => 'HS256', // SHA256
            'typ' => 'JWT'
        ];
        $this->secret = "dXjz"; // !!!
    }

    function GetPayload($jwt) {
        $jwt_parts = explode('.', $jwt);
        $payload = base64_decode($jwt_parts[1]);
        $decoded_payload = json_decode($payload, true);
        return $decoded_payload;
    }

    private function encode(string $str): string
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }

    function generate(array $payload): string
    {
        $headers = $this->encode(json_encode($this->headers));
        $payload["exp"] = time() + 3600 * 10;
        $payload = $this->encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers.$payload", $this->secret, true);
        $signature = $this->encode($signature);
    
        return "$headers.$payload.$signature";
    }

    function is_valid(string $jwt): bool
    {
        $token = explode('.', $jwt);
        if (!isset($token[1]) && !isset($token[2])) {
            return false;
        }
        $headers = base64_decode($token[0]);
        $payload = base64_decode($token[1]);
        $clientSignature = $token[2];

        if (!json_decode($payload)) {
            return false;
        }

        if ((json_decode($payload)->exp - time()) < 0) {
            echo "Expired";
            return false;
        }

        $base64_header = $this->encode($headers);
        $base64_payload = $this->encode($payload);

        $signature = hash_hmac('SHA256', $base64_header . "." . $base64_payload, $this->secret, true);
        $base64_signature = $this->encode($signature);

        return ($base64_signature === $clientSignature);
    }
}

if (!$_GET) {
    return;
}

$jwt = $_GET['jwt'];

$secret_key = "welovekornik";

$jwtHelper = new JWTHelper($secret_key);

if ($jwtHelper->is_valid($jwt)) {
    echo "valid";
}
else {
    echo "Not valid";
}


?>
