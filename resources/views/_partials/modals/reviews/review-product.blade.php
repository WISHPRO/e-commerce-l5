<div class="modal" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID. "Label" }}"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['url' => route('product.reviews.store', ['productID' => $product->id]), 'class' => 'addMyComment', 'id' => 'reviewsForm']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">Add your product review</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_product_id" value="{{ $product->id }}">

                <div class="form-group">
                    <div class="rating">
                        <label for="stars"><span class="text-primary">Rating:</span> </label>
                        <input id="stars" name="stars" type="hidden" class="rating form-control" data-fractions="2"
                               data-stop="{{ getMaxStars() }}" data-start="0.5" value="1"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Comment (required):</label>
                    {!! Form::textarea('comment', null, ['rows' => '4', 'class' => 'form-control', 'placeholder' => 'Enter a comment', 'required']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close"></i>&nbsp;Close
                    </button>
                </div>
                <div class="pull-left">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-square"></i>&nbsp;Save review
                    </button>
                    <span class="alt-ajax-image"><img src="{{ getAlternateAJAXImage() }}"> </span>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>