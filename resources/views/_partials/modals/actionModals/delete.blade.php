<div class="modal fade" id="{{ $elementID }}" tabindex="-1" role="dialog" aria-labelledby="{{ $elementID. 'delete'}}"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title text-center">Delete prompt</h4>
            </div>
            {!! Form::open(['url' => $route, 'method' => 'DELETE']) !!}
            <div class="modal-body">
                <div class="alert alert-warning"><span class="fa fa-warning fa-2x"></span>
                    &nbsp;&nbsp; Are you sure you want to delete this item?
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <a href="#">
                        <button class="btn btn-danger" type="submit">
                            <span class="fa fa-remove"></span>&nbsp;Yes
                        </button>
                    </a>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        No
                    </button>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>