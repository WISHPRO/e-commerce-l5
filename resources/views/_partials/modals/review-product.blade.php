<div class="modal" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID. "Label" }}"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-all-10">
            {!! Form::open(['route' => ['product.reviews.store', $product->id], 'class' => 'form-horizontal', 'id' => 'reviewsForm']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">Add your product review</h4>
            </div>
            <div class="modal-body">

                <div class="form-group rating">
                    <label for="stars"><span class="text-primary">Rating:</span> </label>
                    <input id="stars" name="stars" type="hidden"
                           class="rating form-control"
                           data-fractions="2"
                           data-stop="{{ getMaxStars() }}"
                           data-start="0.5"
                           value=1 />
                </div>
                <div class="form-group">
                    <label for="comment">Comment (required):</label>
                    <textarea id="comment" name="comment" rows="5" class="form-control" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button class="btn btn-primary text-uppercase" type="submit" id="submitComment">
                        Save comment
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