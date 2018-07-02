<h1>{{__('mail.greeting', ['name'=>$name])}}</h1>
<p>{{ isset($content)?$content:'' }}</p>