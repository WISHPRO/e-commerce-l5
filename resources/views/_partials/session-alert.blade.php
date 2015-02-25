@if(Session::has('message') || Session::has('alertclass'))
    <div class="row" style="z-index: 7000">
        <div id="session-alert" class="flash-msg">
            <div class="alert alert-dismissable {{ Session::get('alertclass')}}" id="dismiss">
                <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip"
                        data-placement="top" title="dismiss message">&times;</button>
                <p class="text-center text-session-info"> {{ Session::get('message') }} </p>
            </div>
        </div>
    </div>
@endif