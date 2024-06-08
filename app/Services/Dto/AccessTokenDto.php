<?php
namespace App\Services\Dto;
use Spatie\LaravelData\Data;

class AccessTokenDto extends Data
{
  public function __construct(
    public string $access_token,
    public string $scope,
    public string $api_domain,
    public string $token_type,
    public int $expires_in,
  ) {
  }
}