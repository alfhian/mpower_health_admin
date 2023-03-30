@if ($errors->any())
    <div {{ $attributes }}>
        <!--<div class="redhat small-text text-danger">Incorrect Input</div>-->

        <ul class="mt-3 list-disc list-inside redhat small-text text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
