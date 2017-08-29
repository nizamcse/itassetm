<h2>Hi {{ $user->name }}</h2>
<p>You have been registered at Rakeen. Please confirm and reset your password.</p>
<a href="{{ route('confirm-registration',['id'  => $user->id,'token' => $user->email_token]) }}">Click Here</a> to confirm and reset your password for completion of your registration.