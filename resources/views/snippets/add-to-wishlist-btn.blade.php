<form action="{{ route('customer.wishlist.store') }}" method="POST"
      @guest
      onsubmit="alert('Login to add to product to wishlist'); return false;"
      @endguest
      @auth
      @if(Auth::user()->is_admin)
      onsubmit="alert('Admin can not add product to wishlist'); return false;"
      @elseif(Auth::user()->is_customer)
      @php
          $wishlist = \App\Models\Wishlist::where('product_id',$product->id)->where('user_id',auth()->user()->id)->first();
      @endphp
      @if(isset($wishlist))
      @if($wishlist->quantity >= $product->quantity_available)
      onsubmit="alert('Quantity of item in wishlist can not be more than quantity available'); return false; "
      @else
      onsubmit="return confirm('Add product \'{{ $product->name }}\' having product ID: {{ $product->id }} in wishlist?');"
      @endif
      @else
      onsubmit="return confirm('Add product \'{{ $product->name }}\' having product ID: {{ $product->id }} in wishlist?');"
    @endif

    @endif

    @endauth
>
    @csrf
    @auth

        @if(Auth::user()->is_customer)

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif
    @endauth
    <input type="submit"
           class="btn btn-info btn-sm m-2 @if($product->quantity_available <= 0) disabled @endif "
           value="Add To Wishlist">
</form>
