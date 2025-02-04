@component('mail::message')
# A ne pas répondre!
	
Merci de ne pas répondre à ce mail.

Bonjour! Un nouveau fichier vient d'être partagé. <br>Vous devez acceder à votre espace pour voir le fichier<br>

Cliquer sur:<a href="{{$data['url']}}">Voir</a><br>
Cordialement,<br>
{{ config('app.name') }}
@endcomponent
