<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <h2>ShopEasy</h2>
            <p>Your one-stop destination for quality products at the best prices. We value customer satisfaction above
                all.</p>
        </div>

        <div class="footer-section links">
            <h3>Customer Service</h3>
            <ul>
                <li><a href="#">Help & FAQs</a></li>
                <li><a href="#">Shipping & Returns</a></li>
                <li><a href="#">Order Tracking</a></li>
                <li><a href="{{ route('contact.form') }}">Contact Us</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <a href="{{ route('terms') }}">Terms & Conditions</a>

            </ul>
        </div>

        <div class="footer-section links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>

        <div class="footer-section newsletter">
            <h3>Subscribe to our Newsletter</h3>
            <form action="#" method="POST">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 ShopEasy. All rights reserved.</p>
    </div>
</footer>
