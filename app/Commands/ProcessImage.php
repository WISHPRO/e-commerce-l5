<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\Model;

class ProcessImage extends Command implements SelfHandling {


	protected $model;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		// handle logic to process the image

	}

}
