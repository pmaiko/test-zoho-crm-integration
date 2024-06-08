<?php

namespace App\Services\Dto;

use Spatie\LaravelData\Data;

class DetailsData extends Data
{
  public function __construct(
    public string $Modified_Time,
    public UserData $Modified_By,
    public string $Created_Time,
    public string $id,
    public UserData $Created_By,
    public string $approval_state
  ) {}
}
