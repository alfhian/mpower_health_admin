<x-mail::message>

    <div style="width: 100%; text-align:center;">
        <img src="https://ghanimo.com/img/mpower_text_logo.png" alt="MPower Health logo" style="width: 100px">
        <br>
        <h1 style="color: #aa206b; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif;">MPOWER
            <br>
            <span
                style="color: #08919b; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif;">YOURSELF</span>
        </h1>
        <p style="color: #08919b; text-align: center; font-size: 12px;">
            Hi {{ $details['firstname'] }},<br>
            Here's your credentials for MPower Health Account :
        </p>
        <ul style="color: #08919b; font-size: 12px;">
            <li>
                Email : {{ $details['email'] }}
            </li>
            <li>
                Password : {{ $details['password'] }}
            </li>
        </ul>
        <p style="color: #08919b; font-size: 12px;">
            @lang('Regards'),<br>
            {{ config('app.name') }}
        </p>
    </div>

</x-mail::message>
