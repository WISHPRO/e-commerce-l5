<div class="modal" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID. "Label" }}"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route($route) }}" id="contactsEditForm" class="editAccount">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="infoModalLabel">Modify your Shipping information: </h4>
                </div>
                <div class="modal-body">
                    <p>The form is currently filled in with your current values. Feel free to change them</p>

                    <div class="msgDisplay"></div>
                    <input type="hidden" name="_method" value="PATCH">
                    {!! generateCSRF() !!}
                    <div class="form-group">
                        <label for="county_id">Select a county:</label>
                        {!! Form::select('county_id', str_replace('_', ' ', App\Models\County::lists('name', 'id')), isset($user) & !empty($user->county) ? $user->county->id : null,  [ 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="town">Town:</label>
                        <input type="text" class="form-control" id="town"
                               value="{{ isset($user) ? $user->town : old('town') }}" name="town" required>
                        @if($errors->has('town'))
                            <span class="error-msg">{{ $errors->first('town') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="town">Home Address:</label>
                        <input type="text" class="form-control" id="town"
                               value="{{ isset($user) ? $user->home_address : old('home_address') }}"
                               name="home_address" required>
                        @if($errors->has('home_address'))
                            <span class="error-msg">{{ $errors->first('home_address') }}</span>
                        @endif
                    </div>
                    <br/>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i>&nbsp;Save
                        </button>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>