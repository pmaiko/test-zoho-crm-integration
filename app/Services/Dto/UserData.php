<?php

namespace App\Services\Dto;

use Spatie\LaravelData\Data;

class UserData extends Data
{
  public function __construct(
    public string $name,
    public string $id
  ) {}
}
