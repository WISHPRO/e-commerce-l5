<?php namespace App\Http\Controllers\Frontend;

use app\Antony\DomainLogic\Modules\Advertisements\Base\Advertisements;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Response;

class AdvertisementsController extends Controller
{

    /**
     * @var Advertisements
     */

    private $advertisements;

    public function __construct(Advertisements $advertisements)
    {
        $this->advertisements = $advertisements;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->advertisements->displayCategoryAds($id);
    }
}
