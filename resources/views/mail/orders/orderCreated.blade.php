<h1 style="text-align:center">Hi: {{ $userName }}</h1>
<h3 style="text-align:center">Your Order Include</h3>
{{-- <table>
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quanlities</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
      <tr>
        <td><img src="{{ url($product->product_image) }}" width="80px" height="80px"></td>
        <td>{{ $product->product_name }}</td>
        <td>
        </td>
        <td>{{ '$' . $product->price }}</td>
        <td>{{ $product->buy_quanlity }}</td>
      </tr>
    @endforeach
  </tbody>
</table> --}}
<h5 style="text-align: center">Your order has been sent. Thank you for your support. We will review your order as soon as
  possible. Thank you!</h5>
