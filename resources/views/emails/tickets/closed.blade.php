@component('mail::message')
# Hi {{$ticket->agent->name}}
Inquiry #{{$ticket->id}} has been closed

@component('mail::button', ['url' =>route('ticket.show',$ticket->id)])
View Inquiry
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
