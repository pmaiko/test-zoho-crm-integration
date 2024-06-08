<?php
namespace App\Services\Dto;
use Carbon\Carbon;
use DateTime;
use Spatie\LaravelData\Data;

class DealDto extends Data

{
  public function __construct(
    public string $dealName,
    public string $stage,
    public string $accountId,
  ) {
  }

  public function toArray(): array {
    return [
      'Deal_Name' => $this->dealName,
      'Stage' => $this->stage,
      'Closing_Date' => Carbon::now()->format('Y-m-d'),
      'Account_Name'=> $this->accountId
    ];
  }
}