<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;
use App\Jobs\ProcessVJob;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    public function processVideo()
    {
        ProcessVJob::dispatch();
//    	  ->delay(15)->onQueue('name_of_queue');
        // Отсрочка выполнения задания от момента помещения в очередь
        // не влеяет на паузу между попытками выполнить задачу
    }

    /**
     * @link  http://127.0.0.1:8000/digging_deeper/prepare-catalog
     * php artisan queue:listen --queue=generate-catalog --tries=3 --delay=10
     **/
    public function prepareCatalog()
    {
        GenerateCatalogMainJob::dispatch();
    }

}
