@component('mail::message')
# {{$data['title']}}
<p>
{{$data['message']}}

</p>
@if(isset($data['url']))
@component('mail::button', ['url' => $data['url']])
{{$data['button_label']}}
@endcomponent
@endif