@component('mail::message')
# Website Contact

- {{ $request->name }}
- {{ $request-> email }}
- {{ $request->mobile }}
- {{ $request->subject }}

@component('mail::panel', ['url' => ''])
	{{ $request->message}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent