<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{

    use DispatchesCommands, ValidatesRequests;

    // messages that won't change across controllers
    protected $FormErrorMsg = "Oops!. It seems you did not fill in some fields correctly. Just fill them correctly and re-submit";
    protected $successMsg = "The operation completed successfully";
    protected $notImplementedMessage = "We are still working on that feature. Please bear with us";
    protected $errorMsg = "Oops!. An unknown error occured. please try again later";
    protected $productAddedToCartMsg = "Product was successfully added to your shopping cart";
}
