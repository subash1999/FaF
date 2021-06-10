{{--footer code bootstarp https://getbootstrap.com/docs/5.0/examples/sticky-footer/--}}
<footer class="footer mt-auto py-3 bg-light">
    <div class="container ml-4">
        <div class="row">
            <div class="col float-left">
                <a href="{{ route('products.index') }}">All Products</a>
                <br>
                <a href="{{ route('login') }}">Login</a>
                <br>
                <a href="{{ route('register') }}">Register</a>
            </div>
            <div class="col float-right">
                <a href="mailto: fix_and_fine@gmail.com">Send Email: fix_and_fine@gmail.com</a>
                <br>
                <a href="tel:+61 2 3456 7890">Call Us: +61 2 3456 7890</a>
            </div>
        </div>
    </div>
</footer>
