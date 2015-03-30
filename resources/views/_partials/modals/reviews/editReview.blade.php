<div class="modal fade" id="{{ $elementID }}" tabindex="-1"
     role="dialog"
     aria-labelledby="{{ $elementID }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-all-10">
            {!! Form::open(['route' => ['product.reviews.update', 'product' => $product->id, 'review' => $user_review->implode('id')], 'class' => 'form-horizontal', 'id' => 'reviewsForm', 'method' => 'PATCH']) !!}
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit your review
                </h4>

                <p>press esc or the x button to exit this
                    prompt</p>
            </div>
            <div class="modal-body">
                <div class="form-group rating">
                    <label for="stars"><span class="text text-primary"> New Rating:</span></label>
                    <input id="stars" name="stars" type="hidden"
                           class="rating form-control"
                           data-fractions="2"
                           data-stop="{{ getMaxStars() }}"
                           data-start="0.5"
                           value={{ $user_review->implode('stars') }}/>
                </div>
                <div class="form-group">
                    <label for="comment">Modify comment:</label>
                                                                            <textarea id="comment" name="comment"
                                                                                      rows="5" class="form-control"
                                                                                      required>{{ $user_review->implode('comment') }}</textarea>
                </div>

            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button class="btn btn-primary text-uppercase" type="submit" id="submitComment">
                        <i class="fa fa-edit"></i>&nbsp;Save changes
                    </button>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>