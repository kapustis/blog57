<?php

namespace App\Jobs\GenerateCatalog;


class GenerateCatalogMainJob extends AbstractJob
{

	/**
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 * @throws \Throwable
	 */
	public function handle()
	{
		$this->debug('start');

		// кешируем продукты
		GenerateCatalogCacheJob::dispatchNow();
		// создаем цепочку заданий формирования файлов с ценами
		$chainPrices = $this->getChainPrices();

		// под задачи
		$chainMain = [
			new GenerateCategoriesJob, // генерация категории
			new GenerateDeliveriesJob, // генерация способов доставки
			new GeneratePointsJob,     // генерация пунктов выдачи
		];

		$chainLast = [
			new AchiveUploadsJob, // архивирование и перенос архива в публичную папку
			new SendPriceRequestJobJob // отправка уведомления сторонниму сервису о том что можно скачать новый файл каталога
		];
		$chain = array_merge($chainPrices,$chainMain,$chainLast);
		GenerateGoodsFileJob::withChain($chain)->dispatch();

		$this->debug('finish');
	}

	private function getChainPrices()
	{
		$res = [];
		$products = collect([1, 2, 3, 4, 5, 6]);
		$fileNum = 1;
		foreach ($products->chunk(1) as $chunk) {
			$res[] = new GeneratePricesFileChunkJob($chunk, $fileNum);
			$fileNum++;
		}
		return $res;
	}
}
