<p>
    Hi {{ $recipient->first }}!
</p>
<p>
    {{ $user->first . ' ' . $user->last }}
    has requested to join your {{ $group->name }} visitation list via the Visit app.
</p>
<p>
    Click the link below to approve this request (or copy and paste the link into your browser's address bar). If you do not know the person that is sending this request or do not wish to share your list with them, no further action is required; simply ignore this email, and the request will be denied.
</p>
<p>
    <a href="{{ url('/requests/' . $code . '/approve') }}">
        {{ url('/requests/' . $code . '/approve') }}
    </a>
</p>
<p>
    You are receiving this email because you are the creator and/or owner of the {{ $group->name }} visitation list that is available via the Visit app. If you have forgotten how to access your account, please <a href="{{ url('/') }}">click here</a> to visit our website where you may reset your password.
</p>
<p>
    Visit is a free app provided by Move the Mountain and is made possible by CallingPost Communications. Visit is available via the Android and Apple app stores and via your web browser by
    <a href="{{ url('/') }}">clicking here</a>.
</p>