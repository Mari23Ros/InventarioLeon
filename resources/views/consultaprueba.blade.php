
    <select name="warehouse_id" class="form-control">
         @foreach($warehouses as $warehouse)
        <option value="{{ $warehouse['id'] }}">{{ $warehouse['name'] }}</option>
        @endforeach
        </select>
@foreach($products as $product)
<li>{{ $warehouse['id'] }}</li>

@endforeach