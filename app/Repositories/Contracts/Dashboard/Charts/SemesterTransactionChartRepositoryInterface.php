<?php

namespace App\Repositories\Contracts\Dashboard\Charts;

interface SemesterTransactionChartRepositoryInterface
{
    public function income();
    public function expense();
    public function difference();
}