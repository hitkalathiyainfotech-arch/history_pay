<table class="table table-bordered" id="userTbl">
    <thead>
    <tr>
        <th scope="col">{{ __('#') }}</th>
        <th scope="col">{{ __('Message') }}</th>
        <th scope="col">{{ __('Image') }}</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($queryResponse as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->message }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
