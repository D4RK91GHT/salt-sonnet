{{-- resources/views/emails/weekly-newsletter.blade.php --}}
@component('mail::message')
# Weekly Newsletter

Hello {{ $user->name }},

Here's what's new this week:

- Latest updates
- Special offers
- News and announcements

@component('mail::button', ['url' => url('/')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent