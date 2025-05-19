@component('mail::message')
# Félicitations {{ $user->name }} !

Vous avez terminé avec succès le cours "{{ $course->title }}".

## 🎓 Votre réussite en chiffres
- **Points d'expérience gagnés :** 500 XP
- **Progression :** 100%
- **Date de complétion :** {{ $completion_date }}

@component('mail::panel')
Votre certificat de réussite est maintenant disponible. Vous pouvez le télécharger et le partager avec votre réseau professionnel.
@endcomponent

@component('mail::button', ['url' => $certificateUrl, 'color' => 'success'])
Télécharger mon certificat
@endcomponent

## 🌟 Et maintenant ?
- Consultez nos autres cours recommandés
- Partagez votre réussite sur les réseaux sociaux
- Ajoutez ce certificat à votre profil LinkedIn

@component('mail::table')
| Cours recommandés | Durée | Niveau |
|:----------------:|:-----:|:-------:|
@foreach($recommendedCourses as $course)
| {{ $course->title }} | {{ $course->duration }} | {{ $course->level }} |
@endforeach
@endcomponent

Cordialement,<br>
{{ config('app.name') }}

@component('mail::subcopy')
Vous recevez cet email car vous avez terminé un cours sur {{ config('app.name') }}.
Pour gérer vos notifications, visitez vos [paramètres de notification]({{ route('profile.notifications') }}).
@endcomponent
@endcomponent
