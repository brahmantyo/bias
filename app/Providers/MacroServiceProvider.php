<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		foreach(glob(base_path('app/Macros/*.macro.php')) as $filename){
			require_once($filename); 
		}
/*		\DB::listen(function($sql, $bindings, $time) {
		    var_dump($sql);
		    var_dump($bindings);
		    var_dump($time);
		});*/
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
