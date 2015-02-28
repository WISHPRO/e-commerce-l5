@if(Session::has('flash_notification.message'))
    <div class="row">
        <div id="session-alert" class="flash-msg">
            <div class="alert alert-dismissable alert-{{ Session::get('flash_notification.level')}}">
                <button type="button" class="close" data-dismiss="alert" data-toggle="tooltip"
                        data-placement="top" title="dismiss message">&times;</button>
                <p class="text-center text-session-info"> {{ Session::get('flash_notification.message') }} </p>
            </div>
        </div>
    </div>
@endif