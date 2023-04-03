<table class="table table-hover table-bordered">
  <thead style="width: 100%;background-color:black;">
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Tên</th>
      <th scope="col" class="text-white">Ảnh</th>
      <th scope="col" class="text-white">Giá</th>
      <th scope="col" class="text-white">Danh mục</th>
      <th style="width: 11%" class="text-white">Hành động</th>
    </tr>
  </thead>
  <tbody>
    @if (request()->ajax())
      @foreach ($products as $index => $product)
        <tr>
          <th scope="row">{{ $index + 1 }}</th>
          <td>{{ $product->product_name }}</td>
          <td><img src="{{ asset($product->product_image) }}" alt="{{ $product->product_image_name }}" width="80px"
              height="80px"></td>
          <td>{{ number_format($product->price) }}</td>
          <td>{{ $product->name }}</td>
          <td>
            @if (auth()->user()->hasPermission('Product_show'))
              <a href="{{ route('product.show', ['product' => $product->id]) }}"
                class="btn btn-info btn-sm text-white"><i class="fas fa-eye"></i></a>
            @endif
            @if (auth()->user()->hasPermission('Product_update'))
              <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                class="btn btn-success btn-sm text-white"><i class="fas fa-edit"></i></a>
            @endif
            @if (auth()->user()->hasPermission('Product_delete'))
              @include('common.delete', [
                  'routeName' => 'product.destroy',
                  'itemname' => 'product',
                  'item' => $product->id,
              ])
            @endif
          </td>
        </tr>
      @endforeach
    @else
      @foreach ($products as $index => $product)
        <tr>
          <th scope="row">{{ $index + 1 }}</th>
          <td>{{ $product->product_name }}</td>
          <td><img src="{{ asset($product->product_image) }}" alt="{{ $product->product_image_name }}" width="80px"
              height="80px"></td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->category->name }}</td>
          <td>
            @if (auth()->user()->hasPermission('Product_show'))
            <a href="{{ route('product.show', ['product' => $product->id]) }}"
              class="btn btn-info btn-sm text-white"><i class="fas fa-eye"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Product_update'))
            <a href="{{ route('product.edit', ['product' => $product->id]) }}"
              class="btn btn-success btn-sm text-white"><i class="fas fa-edit"></i></a>
          @endif
          @if (auth()->user()->hasPermission('Product_delete'))
            @include('common.delete', [
                'routeName' => 'product.destroy',
                'itemname' => 'product',
                'item' => $product->id,
            ])
          @endif
          </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
@include('common.paginate-admin', ['array' => $products])
