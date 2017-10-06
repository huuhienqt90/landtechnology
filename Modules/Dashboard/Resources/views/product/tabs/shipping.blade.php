<p>
    @if( count($shippings) > 0 && $shippings != null )
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>To</th>
                <th>Cost</th>
            </tr>
            @foreach( $shippings as $shipping )
            <tr>
                <td>{{ $shipping->id }}</td>
                <td>{{ $shipping->from_country }}</td>
                <td>{{ $shipping->to_country }}</td>
                <td>{{ $shipping->cost }}$</td>
            </tr>
            @endforeach
        </table>
    </div>
    @else
    <h2>Shipping not found</h2>
    @endif
</p>