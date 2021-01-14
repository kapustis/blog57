<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;
use App\Jobs\ProcessVJob;
use App\Models\BlogPost;
use Carbon\Carbon;
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

    public function collection()
    {
        $result = [];

        /** @var \Illuminate\Database\Eloquent\Collection */
        $eloquentCollection = BlogPost::withTrashed()->limit(100)->get();

        //dd(__METHOD__,$eloquentCollection,$eloquentCollection->toArray());

        /** @var \Illuminate\Support\Collection */

        $collection = collect($eloquentCollection->toArray());

        //dd(get_class($eloquentCollection),get_class($collection),$collection);

        //$result['first'] = $collection->first();
        //$result['last'] = $collection->last();

        //$result['where']['data'] = $collection->where('category_id', 10)->values()->keyBy('id');
        //$result['where']['count'] = $collection->where('category_id', 10)->count();
        //$result['where']['isEmpty'] = $collection->where('category_id', 10)->isEmpty();
        //$result['where']['isNotEmpty'] = $collection->where('category_id', 10)->isNotEmpty();

        //if($result['where']['data']->isNotEmpty()){
        //.... code app
        //}

        //$result['where_first'] = $collection->firstWhere('created_at', '>','2020-12-17 22:06:40');

//        $result['map']['all'] = $collection->map(function ($item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_title = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });

//        $result['map']['not_exists'] = $result['map']['all']->where('exists', '=', false)->values()->keyBy('item_id');
//        dd($result);

        // базовая переменая изменится
        $collection->transform(function ($item){
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_title = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

//        dd($collection);

//        $newItem = new \stdClass();
//        $newItem->id = 1111;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 1112;
//
//        $newItemFirst = $collection->prepend($newItem)->first();
//        $newItemLast = $collection->push($newItem2)->last();
//        $pulledItem = $collection->pull(1);

//        dd(compact('collection','newItemFirst','newItemLast','pulledItem'));

        /** Фильтрация замена orWhere */
//        $filtered = $collection->filter(function ($item){
//            $byDay = $item->created_at->isFriday();
//            $byDate =$item->created_at->day == 13;
//
//            $result = $byDay && $byDate;
//
//            return $result;
//            /** или */
//            //return $item->created_at->isFriday() && $item->created_at->day == 13;
//        });
//        dd($filtered);

        $sortedSimpleCollection = collect([5,2,3,6,4,])->sort();
        $sortedAskCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dd(compact('sortedSimpleCollection','sortedAskCollection','sortedDescCollection'));
    }

}
