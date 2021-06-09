<form action="{{ route('customer.carts.store') }}" method="POST"
      @guest
      onsubmit="alert('Login to add to product to cart'); return false;"
      @endguest
      @auth
      @if(Auth::user()->is_admin)
      onsubmit="alert('Admin can not add product to cart'); return false;"
      @elseif(Auth::user()->is_customer)
      @php
          $cart = \App\Models\Cart::where('product_id',$product->id)->where('user_id',auth()->user()->id)->first();
      @endphp
      @if(isset($cart))
      @if($cart->quantity >= $product->quantity_available)
      onsubmit="alert('Quantity of item in cart can not be more than quantity available'); return false; "
      @else
      onsubmit="return confirm('Add product \'{{ $product->name }}\' having product ID: {{ $product->id }} in cart?');"
      @endif
      @else
      onsubmit="return confirm('Add product \'{{ $product->name }}\' having product ID: {{ $product->id }} in cart?');"
    @endif

    @endif

    @endauth
>
    @csrf
    @auth

        <div class="m-2">
            <label for="quantity">Qty:</label>
            <input type="number" min="1" max="{{ $product->quantity_available }}" step="1" required name="quantity" value="1">
        </div>
        @if(Auth::user()->is_customer)

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif
    @endauth
    <input type="submit"
           class="btn btn-success btn-sm m-2 @if($product->quantity_available <= 0) disabled @endif "
           value="Add To Cart">
</form>
