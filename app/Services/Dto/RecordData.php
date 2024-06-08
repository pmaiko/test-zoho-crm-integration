<?php

namespace App\Services\Dto;


use Spatie\LaravelData\Data;

class RecordData extends Data
{
  public function __construct(
    public string $code,

    public array $details,
    public string $message,
    public string $status
  ) {}

}
