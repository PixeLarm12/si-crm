<?php

namespace Database\Seeders;

use App\Enums\ProductEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
	/**
	 * To avoid memory explode
	 * @var int
	 */
	protected $batchSize = 100;

	/**
	 * Movies array
	 * @var array
	 */
	protected $moviesTitles = [];

	public function __construct()
	{
		$this->moviesTitles = $this->loadTitlesFromCSV(base_path('resources/dataset/products_dataset.csv'));
	}

	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		$faker = Faker::create();
		$batches = array_chunk($this->moviesTitles, $this->batchSize);

		foreach ($batches as $batch) {
			$preparedBatch = array_map(function ($title) use ($faker) {
				return [
					'title'      => $title,
					'price'      => $faker->randomFloat(2, 0.5, 3000),
					'amount'     => $faker->numberBetween(1, 100),
					'status'     => $faker->randomElement([ProductEnum::STATUS_DRAFT, ProductEnum::STATUS_PUBLISHED]),
					'created_at' => now(),
					'updated_at' => now(),
				];
			}, $batch);

			$this->insertBatch($preparedBatch);
		}
	}

	/**
	 * Insert movies
	 *
	 * @param array $batch
	 */
	protected function insertBatch(array $batch)
	{
		DB::table('products')->insert($batch);
	}

	/**
	 * Load movies titles as array
	 *
	 * @param string $csvPath
	 * @return array
	 */
	protected function loadTitlesFromCSV($csvPath)
	{
		$titles = [];

		if (($handle = fopen($csvPath, 'r')) !== false) {
			$header = fgetcsv($handle);
			$titleIndex = array_search('Title', $header);

			if ($titleIndex === false) {
				throw new \Exception("The 'Title' was not found.");
			}

			while (($row = fgetcsv($handle)) !== false) {
				$titles[] = $row[$titleIndex];
			}
			fclose($handle);
		}

		return $titles;
	}
}
