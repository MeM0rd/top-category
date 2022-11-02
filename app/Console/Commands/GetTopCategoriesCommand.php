<?php

namespace App\Console\Commands;

use App\Services\PrepareCategoriesService;
use App\Services\RequestCategoriesService;
use Exception;
use Illuminate\Console\Command;

class GetTopCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request categories from apptica.com';

    private RequestCategoriesService $requestService;
    private PrepareCategoriesService $prepareService;

    public function __construct()
    {
        parent::__construct();
        $this->requestService = new RequestCategoriesService();
        $this->prepareService = new PrepareCategoriesService();
    }


    public function handle()
    {
        try {
            $categories = $this->requestService->getCategories();

            $this->prepareService->prepareData($categories);
        } catch (Exception $e) {
            return response([
                'error'  => $e->getMessage(),
            ], 500);
        }
    }
}
