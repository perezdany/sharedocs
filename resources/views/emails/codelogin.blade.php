@component('mail::message')
# A ne pas répondre!
	
Merci de ne pas répondre à ce mail.

Bonjour! Voici votre code de connexion: <b>{{$data['code']}}</b> <br>Veuillez entrer ce code pour vous connecter


Cordialement,<br>
{{ config('app.name') }}
@endcomponent
