<?php

namespace App\Services\Dto;

use Spatie\LaravelData\Data;

class DataContainer extends Data
{
  public function __construct(
     /** @var RecordData[] */
    public array $data
  ) {}
}