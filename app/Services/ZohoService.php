<?php

namespace App\Services;

use App\Services\Dto\AccessTokenDto;
use App\Services\Dto\AccountDto;
use App\Services\Dto\DataContainer;
use App\Services\Dto\DealDto;
use Illuminate\Support\Facades\Log;
use Psr\Http\Client\ClientInterface;
use Illuminate\Support\Facades\Cache;

class ZohoService {

  public function __construct (private readonly ClientInterface $client) {

  }

 public function getAccessToken () {
    if (!Cache::has('accessToken')) {
      $this->refreshAccessToken();
    }
    return Cache::get('accessToken');
  }

  public function refreshAccessToken(): string {
    try {
      $response = $this->client->post('/oauth/v2/token',
        [
          'form_params' => [
            'grant_type' => 'refresh_token',
            'client_id' => config('api.zoho.clientId'),
            'client_secret' => config('api.zoho.clientSecret'),
            'refresh_token' => config('api.zoho.refreshToken'),
          ]
        ]);

    } catch (\Throwable $e){
      Log::critical('[ZOHO API] Query execution error /oauth/v2/token ' . $e->getMessage());

      return  '';
    }
    $data = AccessTokenDto::from(json_decode($response->getBody()->getContents(), true));
    Cache::set('accessToken', $data->access_token, $data->expires_in - 100);

    return $data->access_token;
  }

  public function createAccount (AccountDto $accountDto): DataContainer {

      $response = $this->client->post('https://www.zohoapis.eu/crm/v6/Accounts', [
        'headers' => [
          'Authorization' => 'Zoho-oauthtoken ' . $this->getAccessToken(),
        ],
        'json' => [
          'data'=> [
            $accountDto->toArray(),
          ],
        ]
      ]);

    return  DataContainer::from(json_decode($response->getBody()->getContents(), true));
  }

  public function createDeal(DealDto $dealDto) {

    $response = $this->client->post('https://www.zohoapis.eu/crm/v6/Deals', [
      'headers' => [
        'Authorization' => 'Zoho-oauthtoken ' . $this->getAccessToken(),
      ],
      'json' => [
        'data'=> [
            $dealDto->toArray(),
        ]
      ]
    ]);
    return json_decode($response->getBody()->getContents(), true);
  }
}

// {
//   "data": [
//         {
//           "Layout": {
//           "id": "5725767000000091055"
//             },
//             "Lead_Source": "Employee Referral",
//             "Company": "ABC",
//             "Last_Name": "Daly",
//             "First_Name": "Paul",
//             "Email": "p.daly@zylker.com",
//             "State": "Texas",
//             "$wizard_connection_path": [
//           "5725767000000091055"
//         ],
//             "Wizard": {
//           "id": "5725767000000526319"
//             }
//         },
//         {
//           "Layout": {
//           "id": "5725767000000091055"
//             },
//             "Lead_Source": "Trade Show",
//             "Company": "ABC",
//             "Last_Name": "Dolan",
//             "First_Name": "Brian",
//             "Email": "brian@villa.com",
//             "State": "Texas"
//         }
//     ],
//     "apply_feature_execution": [
//         {
//           "name": "layout_rules"
//         }
//     ],
//     "trigger": [
//   "approval",
//   "workflow",
//   "blueprint"
// ]
// }