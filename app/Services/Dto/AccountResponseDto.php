<?php
namespace App\Services\Dto;
use DateTime;
use Spatie\LaravelData\Data;

class AccountResponseDto extends Data
{
  public function __construct(
    public string $dealName,
    public string $stage,
    public string $accountId,
    public DateTime $closingDate,
  ) {
  }

  public function toArray(): array {
    return [
      'Deal_Name' => $this->dealName,
      'Stage' => $this->stage,
      'Closing_Date' => $this->closingDate,
      'Account_Name'=> [
        'id' => $this->accountId
      ]
    ];
  }
}

