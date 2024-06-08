<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZohoFormRequest;
use App\Services\Dto\AccountDto;
use App\Services\Dto\DealDto;
use App\Services\ZohoService;

class ZohoController  extends Controller {
  public function form(ZohoFormRequest $request, ZohoService $zohoService) {


    $account = $zohoService->createAccount(AccountDto::from([
      'accountName' => $request->get('accountName'),
      'website' => $request->get('website'),
      'phone' => $request->get('phone')
    ]));

    $accountId = $account->data[0]->details['id'] ?? '';

    if(!$accountId){
      return response()->json([
        'success' => false
      ]);
    }

    $zohoService->createDeal(DealDto::from([
      'dealName' => $request->get('dealName'),
      'stage' => $request->get('stage'),
      'accountId'=> $accountId,
    ]));

    return response()->json([
      'success' => true
    ]);
  }
}