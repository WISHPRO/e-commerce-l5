<?php namespace app\Antony\DomainLogic\Contracts\Reviews;

interface ReviewsContract {

    const REVIEW_SAVED = 'review.saved';

    const REVIEW_SAVE_FAILED = 'review.save.failed';

    const REVIEW_UPDATE_FAILED = 'review.update.failed';

    const REVIEW_UPDATE_SUCCESSFUL = 'review.update.successful';

    /**
     * @param $request
     *
     * @return mixed
     */
    public function handleRedirect($request);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function addReview($data);

    /**
     * @param $review_id
     * @param $data
     *
     * @return mixed
     */
    public function editReview($review_id, $data);
}