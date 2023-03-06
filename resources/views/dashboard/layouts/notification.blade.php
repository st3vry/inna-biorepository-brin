<div class="offcanvas offcanvas-end p-0 " tabindex="-1" id="notificationOffCanvas" data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="notificationOffCanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="notificationOffCanvasLabel">Notification</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="list-group">
            @foreach ($notifications as $notification)
            <a onclick="return markReadNotification(this)" data-id="{{$notification->id}}" data-target="/dashboard/{{$notification->action === 'assignedToCurator' ? 'curator/': ''}}{{lcfirst($notification->type)}}s/{{ $notification->item_id}}" href="#" class="list-group-item py-3 {{$notification->seen ? 'list-group-item-secondary': 'unread'}}">
                @switch($notification->action)
                    @case("approved")
                        <span class="{{!$notification->seen ? 'fw-bold':'text-muted'}}">  Your {{lcfirst($notification->type)}} has been approved.</span>
                        <br>
                        <small class="fw-lighter text-muted">{{$notification->created_at->format('j F Y H:i')}}</small>
                        @break
                    @case("returnedToSubmitter")
                        <span class="{{!$notification->seen ? 'fw-bold':'text-muted'}}">Your {{lcfirst($notification->type)}} has been returned to you.</span>
                        <br>
                        <small class="fw-lighter text-muted">{{$notification->created_at->format('j F Y H:i')}}</small>
                        @break
                    @case("assignedToCurator")
                        <span class="{{!$notification->seen ? 'fw-bold':'text-muted'}}">{{$notification->type}} assignment</span>
                        <br>
                        <small class="fw-lighter text-muted">{{$notification->created_at->format('j F Y H:i')}}</small>
                        @break
                    @case("rejected")
                        <span class="{{!$notification->seen ? 'fw-bold':'text-muted'}}">Sorry your {{lcfirst($notification->type)}} has been rejected.</span>
                        <br>
                        <small class="fw-lighter text-muted">{{$notification->created_at->format('j F Y H:i')}}</small>
                        @break
                    @default
                        {{$notification->action}}
                @endswitch
            </a>
            @endforeach
        </ul>
    </div>
    <div class="offcanvas-footer">
        <div class="text-center mb-2"><button onclick="markAllAsRead()" class="btn btn-text btn-sm">Mark all as read</button></div>
    </div>
</div>