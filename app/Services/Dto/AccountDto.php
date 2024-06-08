<?php
namespace App\Services\Dto;
use Spatie\LaravelData\Data;

class AccountDto extends Data
{
  public function __construct(
    public string $accountName,
    public string $website,
    public string $phone,
  ) {
  }

  public function toArray(): array {
    return [
      'Account_Name' => $this->accountName,
      'Website' => $this->website,
      'Phone' => $this->phone,
    ];
  }
}