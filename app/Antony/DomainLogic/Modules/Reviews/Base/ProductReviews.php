<?php namespace app\Antony\DomainLogic\Modules\Reviews\Base;

use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\Reviews\ReviewsRepository;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ProductReviews extends DataAccessLayer
{
    /**
     * @param ReviewsRepository $reviewsRepository
     */
    public function __construct(ReviewsRepository $reviewsRepository)
    {
        parent::__construct($reviewsRepository);

    }

    /**
     * @param $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        switch ($this->getResult()){
            case DataActionResult::CREATE_SUCCESS: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your review was saved. Thank you']);
                } else {

                    flash('Your review was saved. Thank you');

                    return redirect()->back();
                }
            }
            case DataActionResult::CREATE_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'An error occurred while saving your review. Please try again'], 422);
                } else {

                    flash()->error('An error occurred while saving your review. Please try again');

                    return redirect()->back()->withInput($request->all());
                }
            }
            case DataActionResult::UPDATE_SUCCEEDED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your review was updated successfully']);
                } else {

                    flash('Your review was updated successfully');

                    return redirect()->back();
                }
            }
            case DataActionResult::UPDATE_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'An error occurred while updating your review. Please try again'], 422);
                } else {

                    flash()->error('An error occurred while updating your review. Please try again');

                    return redirect()->back()->withInput($request->all());
                }
            }
        }
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        // TODO: Implement get() method.
    }
}