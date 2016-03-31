<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ReportService;

class RefreshMasterReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:master-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $reportService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ReportService $reportService)
    {
        parent::__construct();

        $this->reportService = $reportService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->reportService->create();
    }
}
