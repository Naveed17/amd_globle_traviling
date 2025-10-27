<style>
.footer {
    background: linear-gradient(135deg, rgba(0,65,204,0.9) 0%, rgba(0,51,153,0.8) 50%, rgba(44,62,80,0.9) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 4rem 0 0rem;
    position: relative;
    overflow: hidden;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,65,204,0.1) 0%, transparent 50%, rgba(0,65,204,0.05) 100%);
    pointer-events: none;
}

.footer-heading {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 30px;
    height: 2px;
    background: #2d69eb;
}

.footer-link {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    display: block;
    padding: 0.4rem 0;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.footer-link:hover {
    color: #66B3FF;
    padding-left: 5px;
}

.newsletter-input {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    border-radius: 25px;
    padding: 12px 20px;
}
.newsletter-input:focus {
    background: rgba(255,255,255,0.15);
    color: #fff;
}

.newsletter-input::placeholder {
    color: rgba(255,255,255,0.6);
}

.newsletter-btn {
    background: #0041CC;
    border: none;
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    color: #fff;
}

.newsletter-btn:hover {
    background: #003399;
   color:#fff;
    box-shadow: 0 5px 15px rgba(0,65,204,0.4);
}

.compliance-section {
    background: rgba(0,65,204,0.1);
    backdrop-filter: blur(8px);
    padding: 2rem 0;
    margin-top: 3rem;
    border-top: 1px solid rgba(255,255,255,0.2);
}

.compliance-logos {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.compliance-logo {
    height: 40px;
    filter: brightness(0) invert(1);
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.compliance-logo:hover {
    opacity: 1;
}

.compliance-badge {
    background: rgba(255,255,255,0.15);
    color: #fff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    gap: 6px;
}

.compliance-badge:hover {
    background: rgba(255,255,255,0.25);
    transform: translateY(-2px);
}

.compliance-badge i {
    font-size: 14px;
    margin-right: 6px;
}

.footer-bottom {
    text-align: center;
    color: rgba(255,255,255,0.7);
    font-size: 0.9rem;
    line-height: 1.6;
}

.social-icons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin: 1.5rem 0;
}

.social-icon {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: #0041CC;
    transform: translateY(-3px);
}

.footer-brand {
    position: relative;
    height: 52px;
    width: 120px;
}

.footer-logo {
    object-fit: cover;
    object-position: center;
    clip-path: inset(-17% 0% 48% 4%);
    transform: scale(1.5);
    height: 100%;
    width: 100%;
    position: absolute;
    top: 12px;
    transition: all .3s;
}

.footer-logo:hover {
    transform: scale(1.6);
}

@media (max-width: 768px) {
    .footer { padding: 3rem 0 1.5rem;padding-bottom:0}
    .compliance-logos { gap: 1rem; }
    .compliance-logo { height: 30px; }
    .footer-brand { height: 40px; width: 100px; }
    .footer-logo { transform: scale(1.3); }
}
</style>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-brand mb-3">
                     <img src="{{ getSettingImage('business_logo','branding') }}" 
                        alt="TravelBookingPanel Logo" 
                        class="img-fluid footer-logo">
                </div>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.6;">Your trusted travel partner for unforgettable journeys worldwide. IATA accredited agency ensuring safe and reliable travel experiences.</p>
                <!-- <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 class="footer-heading">Quick Links</h4>
                @foreach (get_menu_items('footer_quick_links') as $item)
                <a href="{{ $item->full_url }}" class="footer-link">{{ $item->name }}</a>
                @endforeach
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 class="footer-heading">Services</h4>
                @foreach (get_menu_items('footer_services') as $item)
                <a href="{{ $item->full_url }}" class="footer-link">{{ $item->name }}</a>
                @endforeach
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 class="footer-heading">Support</h4>
                @foreach (get_menu_items('footer_support') as $item)
                <a href="{{ $item->full_url }}" class="footer-link">{{ $item->name }}</a>
                @endforeach
            </div>
            
            <div class="col-lg-3 col-md-12 mb-4">
                <h4 class="footer-heading">Newsletter</h4>
                <p style="color: rgba(255,255,255,0.8); margin-bottom: 1.5rem;">Get exclusive travel deals and updates</p>
                <form>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control newsletter-input" placeholder="Enter your email">
                        <button class="btn newsletter-btn" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="compliance-section">
        <div class="container">
            <div class="compliance-logos">
                <img src="{{ url('public/assets/images/iata.png') }}" alt="IATA" class="compliance-logo">
                <div class="compliance-badge"><i class="bi bi-shield-check"></i>ATOL Protected</div>
                <div class="compliance-badge"><i class="bi bi-lock-fill"></i>SSL Secured</div>
                <div class="compliance-badge"><i class="bi bi-credit-card"></i>PCI Compliant</div>
                <div class="compliance-badge"><i class="bi bi-airplane"></i>ABTA Member</div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved. | IATA Accredited Agent</p>
                <p>Licensed travel agency. All bookings are financially protected. Terms & Conditions apply.</p>
            </div>
        </div>
    </div>
</footer>

<!-- <script src="{{ url('public/assets/js/bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script> -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="{{ url('public/assets/js/jquery-3.7.1.min.js') }}"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- datepicker -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{{ url('public/assets/js/custom-script.js') }}"></script>

</body>

</html>
