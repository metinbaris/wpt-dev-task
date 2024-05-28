<?php

namespace Metinbaris\Vero\Controllers;

use Metinbaris\Vero\Services\DatasetService;

class DatasetController extends Controller
{
    public function __construct(private DatasetService $datasetService)
    {
    }

    public function index()
    {
        $dataset = $this->datasetService->getDataset();

        $this->view('index', ['dataset' => $dataset]);
    }
}