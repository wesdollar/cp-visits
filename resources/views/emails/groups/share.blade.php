<p>Hi!</p>
<p>
    You have been invited by {{ $user->first }} {{ $user->last }} to join a visitation list via the Visit app. Click the link below to accept the invite. If you've never used the Visit app, don't worry! It's easy to get started; further instructions are waiting you via the link below.
</p>
<p>
    <a href="{{ url('/invite/' . $shareCode) }}">{{ url('/invite/' . $shareCode) }}</a>
</p>
<p>
    If you can't click the link below, simply copy it and paste it into the address bar of your web browser on your mobile phone, tablet, or PC.
</p>
<p>
    <strong>What is the Visit app?</strong>
</p>
<p>
    Visit is a free app available via the Apple App Store, Google Play Store, or via any web-connected browser at
    <a href="http://www.visit123.com">www.visit123.com</a>. It provides an easy way to create and share lists of people that could use a friendly visit, such as someone that is currently hospitalized.
</p>
<p>
    <strong>Why did I receive this invite?</strong>
</p>
<p>
    {{ $user->first }} {{ $user->last }} thought you would enjoy being able to see the visitation list they have put together. If you do not wish to participate, you do not need to take any further actions — simply disregard this email.
</p>
<p>
    <strong>How much does it cost?</strong>
</p>
<p>
    It's free! No strings attached. Visit is made available free of charge by Move the Mountain, a 501c-3 non-profit with a heart from helping churches grow.
</p>