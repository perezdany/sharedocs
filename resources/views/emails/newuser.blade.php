@component('mail::message')
# A ne pas répondre!
	
Merci de ne pas répondre à ce mail.

Bonjour! Un compte a été créé pour le partage de fichier. <br>Voici vos paramètres de connexion:<br>
login:<b>{{$data['email']}}</b><br>
mot de passe: <b>123456</b><br>Cliquez en dessous pour vous connecter.</br>
<a href="{{$data['url']}}">Se connecter</a>

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
