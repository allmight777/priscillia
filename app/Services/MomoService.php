<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class MomoService
{
    protected $subscriptionKey;
    protected $environment;
    protected $apiUserId;
    protected $apiUserPassword;
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->subscriptionKey = config('services.mtn_momo.subscription_key');
        $this->environment = config('services.mtn_momo.environment');
        $this->apiUserId = config('services.mtn_momo.api_user_id');
        $this->apiUserPassword = config('services.mtn_momo.api_user_password');
        $this->client = new Client(['base_uri' => 'https://sandbox.momodeveloper.mtn.com/']);
    }

    // 1. Créer un utilisateur API (une fois)
    public function createApiUser()
    {
        $uuid = Str::uuid()->toString();
        $response = $this->client->post('v1_0/apiuser', [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                'X-Reference-Id' => $uuid,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'providerCallbackHost' => config('services.mtn_momo.callback_url'),
            ],
        ]);

        return $uuid;
    }

    // 2. Générer un token d'accès OAuth
    public function generateApiKey()
    {
        $response = $this->client->post('v1_0/apiuser/'.$this->apiUserId.'/apikey', [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                'Authorization' => 'Basic ' . base64_encode($this->apiUserId . ':' . $this->apiUserPassword),
                'Content-Type' => 'application/json',
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        $this->token = $body['apiKey'];

        return $this->token;
    }

    // 3. Faire une demande de paiement (pré-autorisation)
    public function requestToPay($payerPhone, $amount, $externalId, $payerMessage = '', $payeeNote = '')
    {
        if (!$this->token) {
            $this->generateApiKey();
        }

        $referenceId = Str::uuid()->toString();

        $response = $this->client->post('collection/v1_0/requesttopay', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'X-Reference-Id' => $referenceId,
                'X-Target-Environment' => $this->environment,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'amount' => number_format($amount, 2, '.', ''),
                'currency' => 'XAF',
                'externalId' => $externalId,
                'payer' => [
                    'partyIdType' => 'MSISDN',
                    'partyId' => $payerPhone,
                ],
                'payerMessage' => $payerMessage,
                'payeeNote' => $payeeNote,
            ],
        ]);

        return $referenceId;
    }

    // 4. Vérifier le statut du paiement (par referenceId)
    public function getPaymentStatus($referenceId)
    {
        $response = $this->client->get('collection/v1_0/requesttopay/' . $referenceId, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'X-Target-Environment' => $this->environment,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        return $body['status'] ?? null;
    }
}
