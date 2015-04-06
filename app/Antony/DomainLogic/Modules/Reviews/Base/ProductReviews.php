<?php namespace app\Antony\DomainLogic\Modules\Reviews\Base;

use app\Antony\DomainLogic\Contracts\Reviews\ReviewsContract;
use App\Antony\DomainLogic\Modules\Product\ProductRepository;
use App\Antony\DomainLogic\Modules\Reviews\ReviewsRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ProductReviews implements ReviewsContract
{

    /**
     * @var string
     */
    protected $ReviewResult;

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var ReviewsRepository
     */
    protected $reviewsRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param ReviewsRepository $reviewsRepository
     * @param Guard $auth
     * @param ProductRepository $productRepository
     */
    public function __construct(ReviewsRepository $reviewsRepository, Guard $auth, ProductRepository $productRepository)
    {

        $this->auth = $auth;
        $this->reviewsRepository = $reviewsRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function addReview($data)
    {

        $review = $this->reviewsRepository->add($data);

        if ($review === null) {

            $this->setReviewResult(ReviewsContract::REVIEW_SAVE_FAILED);

            return $this;
        }

        $this->setReviewResult(ReviewsContract::REVIEW_SAVED);

        return $this;
    }

    /**
     * @param string $ReviewResult
     */
    private function setReviewResult($ReviewResult)
    {
        $this->ReviewResult = $ReviewResult;
    }

    /**
     * @param $review_id
     * @param $data
     *
     * @return $this
     */
    public function editReview($review_id, $data)
    {
        if ($this->reviewsRepository->update($data, $review_id) == 1) {
            $this->setReviewResult(ReviewsContract::REVIEW_UPDATE_SUCCESSFUL);

            return $this;
        }

        $this->setReviewResult(ReviewsContract::REVIEW_UPDATE_FAILED);

        return $this;
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
        switch ($this->getReviewResult()) {
            case ReviewsContract::REVIEW_SAVED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your review was saved. Thank you']);
                } else {

                    flash('Your review was saved. Thank you');

                    return redirect()->back();
                }
            }
            case ReviewsContract::REVIEW_SAVE_FAILED: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'An error occurred while saving your review. Please try again'], 422);
                } else {

                    flash()->error('An error occurred while saving your review. Please try again');

                    return redirect()->back()->withInput($request->all());
                }
            }
            case ReviewsContract::REVIEW_UPDATE_SUCCESSFUL: {
                if ($request->ajax()) {

                    return response()->json(['message' => 'Your review was updated successfully']);
                } else {

                    flash('Your review was updated successfully');

                    return redirect()->back();
                }
            }
            case ReviewsContract::REVIEW_UPDATE_FAILED: {
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
     * @return string
     */
    public function getReviewResult()
    {
        return $this->ReviewResult;
    }
}