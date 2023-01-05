<?php
    declare(strict_types=1);

    use GuzzleHttp\Client;

    require_once(dirname(__DIR__, 3) . "/vendor/autoload.php");

    class YRGO {

        private $client;
        private $base_uri;

        function __construct() {
            $this->base_uri = "https://www.yrgopelago.se/centralbank/";

            $this->client = new Client([
                'base_uri' => $this->base_uri,
            ]);
        }

        public function checkTransferCode(string $transferCode, string $totalCost): bool | array {
            if ($this->isValidUuid($transferCode)) {
                $checkTransferCode = $this->client->request('POST', 'transferCode', [
                    'form_params' => [
                        'transferCode' => $transferCode,
                        'totalCost' => $totalCost,
                    ]
                ]);

                return json_decode($checkTransferCode->getBody()->getContents(), true);
            }

            return false;
        }

        public function createTransferCode(string $api_key, string $user, string $totalCost ): bool | array {

            if ($this->isValidUuid($api_key)) {
                $createTransferCode = $this->client->request('POST', 'withdraw', [
                    'form_params' => [
                        'user' => $user,
                        'api_key' => $api_key,
                        'amount' => $totalCost,
                    ]
                ]);

                return json_decode($createTransferCode->getBody()->getContents(), true);
            }

            return false;
        }

        public function consumeTransferCode(string $transferCode, string $user = 'Josef'): bool | array {
            if ($this->isValidUuid($transferCode)) {
                $consumeTransferCode = $this->client->request('POST', 'deposit', [
                    'form_params' => [
                        'user' => $user,
                        'transferCode' => $transferCode
                    ]
                ]);

                return json_decode($consumeTransferCode->getBody()->getContents(), true);
            }

            return false;
        }

        private function isValidUuid(string $uuid): bool {
            if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
                return false;
            }
            return true;
        }
    }
?>
