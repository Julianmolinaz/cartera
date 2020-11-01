
<table class="table">
    <head>
        <tr>
        <th>Fila</th>
        <th>Error</th>
        </tr>
    </head>
    <tbody>
        
        @foreach($err as $element)
        <tr>
            <td>{{ $element['line'] }}</td>
            <td>{{ $element['message'] }}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>