<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Britss Recondition House - Premium Motorcycles Nepal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f5f5f5; }
        
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        nav {
            max-width: 1400px;
            margin: auto;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1a3c34, #ff6b35);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }
        .logo span { color: #ff6b35; -webkit-text-fill-color: #ff6b35; }
        .nav-links { display: flex; list-style: none; gap: 2rem; }
        .nav-links a { text-decoration: none; color: #333; font-weight: 600; transition: 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: #ff6b35; }
        
        .login-btn {
            background: #ff6b35;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            border: none;
            font-weight: 600;
        }
        .user-menu { display: flex; align-items: center; gap: 1.5rem; }
        .user-name { color: #1a3c34; font-weight: 600; }
        .logout-btn { background: none; border: none; color: #ff6b35; cursor: pointer; font-weight: 600; }
        .my-rentals-btn {
            background: #1a3c34;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            border: none;
            font-weight: 600;
        }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
        .hamburger span { width: 25px; height: 3px; background: #333; }
        
        .hero {
            height: 100vh;
            background: linear-gradient(135deg, rgba(26,60,52,0.9), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2070');
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero h1 { font-size: 3.5rem; margin-bottom: 1rem; }
        .hero h1 i { color: #ff6b35; }
        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
        }
        .btn-primary { background: #ff6b35; color: white; }
        
        .section { padding: 5rem 5%; max-width: 1400px; margin: auto; }
        .section-title { text-align: center; margin-bottom: 3rem; }
        .section-title h2 { font-size: 2.5rem; color: #1a3c34; }
        .section-title h2 i { color: #ff6b35; margin-right: 10px; }
        
        .bikes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }
        .bike-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
            cursor: pointer;
        }
        .bike-card:hover { transform: translateY(-10px); }
        .bike-image { height: 220px; overflow: hidden; }
        .bike-image img { width: 100%; height: 100%; object-fit: cover; }
        .bike-info { padding: 1.5rem; }
        .bike-name { font-size: 1.3rem; font-weight: 700; }
        .bike-price { font-size: 1.5rem; color: #ff6b35; font-weight: 700; margin: 0.5rem 0; }
        .bike-specs { display: flex; gap: 1rem; color: #666; font-size: 0.9rem; margin: 0.5rem 0; }
        .rent-btn {
            width: 100%;
            padding: 0.8rem;
            background: #1a3c34;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 1rem;
        }
        .rent-btn:hover { background: #ff6b35; }
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.85);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }
        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 650px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            padding: 2rem;
            margin: 20px auto;
        }
        .close-modal {
            float: right;
            font-size: 1.8rem;
            cursor: pointer;
            color: #999;
            transition: 0.3s;
        }
        .close-modal:hover { color: #ff6b35; }
        
        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; }
        .form-group label i { color: #ff6b35; margin-right: 0.5rem; }
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #ff6b35;
        }
        .form-group small {
            display: block;
            color: #666;
            font-size: 11px;
            margin-top: 5px;
        }
        .form-group small i { color: #ff6b35; }
        
        .location-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .rental-type-buttons {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        .rental-type-btn {
            flex: 1;
            padding: 0.7rem;
            background: #e0e0e0;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        .rental-type-btn.active { background: #ff6b35; color: white; }
        
        .price-display {
            background: linear-gradient(135deg, #1a3c34, #2e5b50);
            color: white;
            padding: 1rem;
            text-align: center;
            border-radius: 10px;
            margin: 1rem 0;
        }
        .price-display h3 { font-size: 1.8rem; color: #ff6b35; }
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: #ff6b35;
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s;
        }
        .submit-btn:hover { background: #e05a2a; transform: translateY(-2px); }
        
        .bike-detail-specs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 1rem 0;
        }
        .spec-box {
            background: #f5f5f5;
            padding: 0.8rem;
            border-radius: 10px;
            text-align: center;
        }
        .spec-box i { color: #ff6b35; font-size: 1.2rem; }
        .spec-box .value { font-size: 1rem; font-weight: 700; color: #1a3c34; }
        .feature-list { list-style: none; margin: 1rem 0; }
        .feature-list li { padding: 0.5rem 0; border-bottom: 1px solid #eee; }
        .feature-list i { color: #ff6b35; margin-right: 0.5rem; }
        
        .rental-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .rental-table th, .rental-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .rental-table th { background: #1a3c34; color: white; }
        
        footer {
            background: #1a3c34;
            color: white;
            text-align: center;
            padding: 2rem;
        }
        
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            .nav-links {
                position: fixed;
                left: -100%;
                top: 70px;
                width: 100%;
                background: white;
                flex-direction: column;
                padding: 2rem;
                transition: 0.3s;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            }
            .nav-links.active { left: 0; }
            .hero h1 { font-size: 2rem; }
            .bikes-grid { grid-template-columns: 1fr; }
            .location-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="#" class="logo">Britss<span>Bikes</span> <small style="font-size:12px;">Nepal</small></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#home">Home</a></li>
            <li><a href="#dirt">Dirt Bikes (3)</a></li>
            <li><a href="#commuter">Commuter (3)</a></li>
            <li><a href="#superbike">Superbikes (2)</a></li>
            <li><a href="#sport">Sport (2)</a></li>
        </ul>
        <div id="authSection">
            <div class="user-menu" id="userMenu" style="display:none;">
                <span class="user-name" id="userNameDisplay"></span>
                <button class="my-rentals-btn" onclick="showRentalHistory()">📋 My Rentals</button>
                <button class="logout-btn" onclick="logout()">Logout</button>
            </div>
            <button class="login-btn" id="loginBtn" onclick="openAuthModal()">Login / Register</button>
        </div>
        <div class="hamburger" onclick="toggleMenu()"><span></span><span></span><span></span></div>
    </nav>
</header>

<section id="home" class="hero">
    <div>
        <h1><i class="fas fa-motorcycle"></i> Premium Reconditioned Motorcycles<br>In Nepal</h1>
        <p>10+ Premium Bikes | 12-Month Warranty | Free Delivery in Kathmandu Valley</p>
        <a href="#dirt" class="btn btn-primary">Explore Bikes</a>
    </div>
</section>

<!-- ALL 10 BIKE SECTIONS -->
<div id="dirt" class="section"><div class="section-title"><h2><i class="fas fa-mountain"></i> Dirt / Enduro Bikes (3)</h2><p>Perfect for Nepali off-road trails</p></div><div class="bikes-grid" id="dirtGrid"></div></div>
<div id="commuter" class="section" style="background:#fafafa;"><div class="section-title"><h2><i class="fas fa-city"></i> Commuter Bikes (3)</h2><p>Ideal for Nepali roads</p></div><div class="bikes-grid" id="commuterGrid"></div></div>
<div id="superbike" class="section"><div class="section-title"><h2><i class="fas fa-rocket"></i> Superbikes (2)</h2><p>Premium performance machines</p></div><div class="bikes-grid" id="superbikeGrid"></div></div>
<div id="sport" class="section" style="background:#fafafa;"><div class="section-title"><h2><i class="fas fa-flag-checkered"></i> Sport Bikes (2)</h2><p>Track-ready monsters</p></div><div class="bikes-grid" id="sportGrid"></div></div>

<footer>
    <p>© 2025 Britss Recondition House | Nepal's Premier Motorcycle Dealer</p>
    <p>📍 Showroom: New Baneshwor, Kathmandu, Nepal | 📞 +977 9800000000</p>
</footer>

<!-- Bike Details Modal -->
<div id="bikeDetailModal" class="modal-overlay" onclick="if(event.target===this) closeBikeDetailModal()">
    <div class="modal-content">
        <span class="close-modal" onclick="closeBikeDetailModal()">&times;</span>
        <div id="bikeDetailContent"></div>
        <button class="rent-btn" id="detailRentBtn" onclick="rentFromDetail()" style="margin-top: 1rem;">Rent This Bike</button>
    </div>
</div>

<!-- Auth Modal -->
<div id="authModal" class="modal-overlay" onclick="if(event.target===this) closeAuthModal()">
    <div class="modal-content">
        <span class="close-modal" onclick="closeAuthModal()">&times;</span>
        <h2><i class="fas fa-user-circle"></i> <span id="authTitle">Login</span></h2>
        <div id="loginForm">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" id="loginEmail" placeholder="yourname@gmail.com" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="loginPassword" placeholder="Enter password" required>
            </div>
            <button class="submit-btn" onclick="login()">Login</button>
            <p style="text-align:center; margin-top:1rem">Don't have an account? <a href="#" onclick="showRegister()">Register</a></p>
            <p style="text-align:center; font-size:12px; margin-top:1rem; color:#666;">Demo: admin@britsbikes.com / admin123</p>
        </div>
        <div id="registerForm" style="display:none">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Full Name</label>
                <input type="text" id="regName" placeholder="e.g., Ram Bahadur Shah" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" id="regEmail" placeholder="yourname@gmail.com" required>
                <small><i class="fas fa-info-circle"></i> Must be unique email address</small>
            </div>
            <div class="form-group">
                <label><i class="fas fa-phone"></i> Phone Number</label>
                <input type="tel" id="regPhone" placeholder="9800000000" required pattern="[0-9]{10}">
                <small><i class="fas fa-info-circle"></i> 10-digit Nepal mobile number</small>
            </div>
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="regPassword" placeholder="Minimum 6 characters" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-check-circle"></i> Confirm Password</label>
                <input type="password" id="regConfirm" placeholder="Re-enter password" required>
            </div>
            <button class="submit-btn" onclick="register()">Register</button>
            <p style="text-align:center; margin-top:1rem">Already have an account? <a href="#" onclick="showLogin()">Login</a></p>
        </div>
    </div>
</div>

<!-- Rental Modal - Nepal Specific -->
<div id="rentalModal" class="modal-overlay" onclick="if(event.target===this) closeRentalModal()">
    <div class="modal-content secure-form">
        <span class="close-modal" onclick="closeRentalModal()">&times;</span>
        <h2><i class="fas fa-calendar-check"></i> <span id="rentalTitle">Secure Rental Booking</span></h2>
        <form id="rentalForm" onsubmit="event.preventDefault(); submitSecureRental();">
            <div class="form-group">
                <label><i class="fas fa-user"></i> पुरा नाम (Full Name) *</label>
                <input type="text" id="rentName" required placeholder="e.g., Ram Bahadur Shah">
                <small><i class="fas fa-info-circle"></i> As per Citizenship/Nepali passport</small>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-calendar-alt"></i> उमेर (Age) *</label>
                <input type="number" id="rentAge" min="18" max="80" required placeholder="e.g., 25">
                <small><i class="fas fa-info-circle"></i> Minimum 18 years (as per Nepal traffic rules)</small>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-id-card"></i> नेपाली ड्राइभिङ लाइसेन्स (Nepali License) *</label>
                <input type="text" id="rentLicense" required 
                       placeholder="e.g., 01-02-1234567"
                       value="01-02-1234567">
                <small><i class="fas fa-info-circle"></i> <strong>Valid Formats:</strong> 01-02-1234567 | 1234567890123 | KHD-123456</small>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-map-marker-alt"></i> ठेगाना (Address) *</label>
                <input type="text" id="rentAddress" required placeholder="e.g., New Baneshwor, Kathmandu">
                <small><i class="fas fa-info-circle"></i> Tole, Area, City</small>
            </div>
            
            <div class="location-row">
                <div class="form-group">
                    <label><i class="fas fa-city"></i> जिल्ला (District) *</label>
                    <select id="rentDistrict" required>
                        <option value="">Select District</option>
                        <option value="Kathmandu">Kathmandu</option>
                        <option value="Lalitpur">Lalitpur</option>
                        <option value="Bhaktapur">Bhaktapur</option>
                        <option value="Kaski">Kaski (Pokhara)</option>
                        <option value="Chitwan">Chitwan (Bharatpur)</option>
                        <option value="Morang">Morang (Biratnagar)</option>
                        <option value="Jhapa">Jhapa (Bhadrapur)</option>
                        <option value="Sunsari">Sunsari (Dharan)</option>
                        <option value="Banke">Banke (Nepalgunj)</option>
                        <option value="Kailali">Kailali (Dhangadhi)</option>
                        <option value="Rupandehi">Rupandehi (Butwal)</option>
                        <option value="Makwanpur">Makwanpur (Hetauda)</option>
                        <option value="Surkhet">Surkhet (Birendranagar)</option>
                        <option value="Ilam">Ilam</option>
                        <option value="Palpa">Palpa (Tansen)</option>
                        <option value="Gorkha">Gorkha</option>
                        <option value="Nuwakot">Nuwakot (Bidur)</option>
                        <option value="Sindhupalchok">Sindhupalchok (Chautara)</option>
                        <option value="Dhankuta">Dhankuta</option>
                        <option value="Bhojpur">Bhojpur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-hashtag"></i> वडा नम्बर (Ward No.)</label>
                    <input type="number" id="rentWard" placeholder="e.g., 4" min="1" max="32">
                </div>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-phone"></i> फोन नम्बर (Phone) *</label>
                <input type="tel" id="rentPhone" required pattern="[0-9]{10}" placeholder="e.g., 9800000000">
                <small><i class="fas fa-info-circle"></i> 10-digit Nepal mobile number (98xx, 97xx)</small>
            </div>
            
            <label><i class="fas fa-clock"></i> भाडा प्रकार (Rental Type)</label>
            <div class="rental-type-buttons">
                <button type="button" class="rental-type-btn" data-type="hourly" onclick="setRentalType('hourly')">घण्टाको</button>
                <button type="button" class="rental-type-btn" data-type="daily" onclick="setRentalType('daily')">दैनिक</button>
                <button type="button" class="rental-type-btn" data-type="weekly" onclick="setRentalType('weekly')">साप्ताहिक</button>
                <button type="button" class="rental-type-btn" data-type="monthly" onclick="setRentalType('monthly')">मासिक</button>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-hourglass-half"></i> अवधि (Duration)</label>
                <input type="number" id="rentDuration" value="1" min="1" onchange="updatePrice()">
            </div>
            
            <div class="price-display">
                <p><i class="fas fa-rupee-sign"></i> जम्मा रकम (Total in NPR)</p>
                <h3 id="totalPrice">रू 0</h3>
                <small>धरौटी (Security Deposit): रू 5,000</small>
            </div>
            
            <input type="hidden" id="rentBikeId">
            <input type="hidden" id="rentBikeName">
            
            <div class="form-group">
                <label>
                    <input type="checkbox" id="termsCheckbox" required>
                    म नियम र सर्तहरू स्वीकार गर्दछु
                </label>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-lock"></i> पक्का गर्नुहोस्
            </button>
        </form>
    </div>
</div>

<!-- Rental History Modal -->
<div id="historyModal" class="modal-overlay" onclick="if(event.target===this) closeHistoryModal()">
    <div class="modal-content" style="max-width: 900px;">
        <span class="close-modal" onclick="closeHistoryModal()">&times;</span>
        <h2><i class="fas fa-history"></i> मेरो भाडा इतिहास</h2>
        <div id="rentalHistoryContent" class="rental-history">
            <div style="text-align: center; padding: 2rem;">Loading...</div>
        </div>
    </div>
</div>

<script>
let currentUser = null;
let currentBike = null;
let currentRentalType = 'hourly';
let selectedBikeForDetail = null;

// ============ ALL 10 BIKES DATABASE ============
const bikeDatabase = {
    // Dirt Bikes (3)
    'ktm450': { 
        name: 'KTM 450 EXC-F 2022', 
        price: 1850000, 
        priceStr: 'रू 18,50,000',
        img: 'https://i.ytimg.com/vi/Esv4CJq44IY/maxresdefault.jpg',
        cc: '450cc', 
        mileage: '35 kmpl',
        power: '53 BHP',
        torque: '42 Nm',
        weight: '108 kg',
        seatHeight: '960 mm',
        fuelTank: '9.2 L',
        features: ['WP XPLOR Suspension', 'Brembo Hydraulic Clutch', 'Electric Start', 'Off-road ECU Map', 'Traction Control'],
        description: 'Perfect for Nepali off-road trails from Kathmandu to Mustang. Built for extreme conditions.'
    },
    'honda450': {
        name: 'Honda CRF450R 2021',
        price: 1750000,
        priceStr: 'रू 17,50,000',
        img: 'https://images.squarespace-cdn.com/content/v1/5bf65317266c07c1f751f4c9/1610660141520-SZ8ABGLN40NCN7F7SAUA/THE_0802.jpg',
        cc: '449cc',
        mileage: '32 kmpl',
        power: '54 BHP',
        torque: '40 Nm',
        weight: '112 kg',
        seatHeight: '950 mm',
        fuelTank: '6.3 L',
        features: ['Showa Coil-Spring Fork', 'Launch Control', 'Electric Start', 'Honda Selectable Torque Control'],
        description: 'Motocross champion with Showa suspension. Ideal for Nepali motocross tracks.'
    },
    'yamaha450': {
        name: 'Yamaha YZ450F 2023',
        price: 1790000,
        priceStr: 'रू 17,90,000',
        img: 'https://www.cyclenews.com/wp-content/uploads/2022/10/2023-Yamaha-YZ450F-right-side.jpg',
        cc: '450cc',
        mileage: '30 kmpl',
        power: '55 BHP',
        torque: '41 Nm',
        weight: '110 kg',
        seatHeight: '955 mm',
        fuelTank: '7.5 L',
        features: ['KYB Suspension', 'Smartphone Tuning', 'Electric Start', 'Launch Control'],
        description: 'Latest YZ with KYB suspension. Perfect for Nepali off-road adventures.'
    },
    
    // Commuter Bikes (3)
    'splendor': {
        name: 'Hero Splendor Plus 2022',
        price: 85000,
        priceStr: 'रू 85,000',
        img: 'https://www.heromotocorp.com/content/dam/hero-dam-assets/global/np/home-page/Splendor_Red_Side.png',
        cc: '97cc',
        mileage: '63 kmpl',
        power: '8 BHP',
        torque: '8 Nm',
        weight: '112 kg',
        seatHeight: '785 mm',
        fuelTank: '9.8 L',
        features: ['i3S Start-Stop Technology', 'Tubeless Tyres', 'Comfortable Seat', 'LED Headlamp'],
        description: 'India and Nepal\'s most reliable commuter with excellent fuel efficiency.'
    },
    'shine': {
        name: 'Honda Shine 125 2023',
        price: 95000,
        priceStr: 'रू 95,000',
        img: 'https://images.hindustantimes.com/auto/img/2023/10/20/1600x900/Honda_Shine_125_Rebel_Red_Metallic_1687325142141_1697801619085.jpg',
        cc: '125cc',
        mileage: '55 kmpl',
        power: '10.7 BHP',
        torque: '11 Nm',
        weight: '115 kg',
        seatHeight: '790 mm',
        fuelTank: '10.5 L',
        features: ['Enhanced i3S', 'Combi Brake System', 'Tubeless Tyres', 'LED Headlamp'],
        description: 'Premium commuter with enhanced i3S technology. Perfect for daily Nepali roads.'
    },
    'saluto': {
        name: 'Yamaha Saluto RX 125',
        price: 89000,
        priceStr: 'रू 89,000',
        img: 'https://www.maw2wheelers.com/wp-content/uploads/2025/01/Saluto-Green.jpg',
        cc: '125cc',
        mileage: '58 kmpl',
        power: '9 BHP',
        torque: '9.5 Nm',
        weight: '110 kg',
        seatHeight: '785 mm',
        fuelTank: '10 L',
        features: ['Blue Core Engine', 'Retro Styling', 'Tubeless Tyres', 'Electric Start'],
        description: 'Stylish retro commuter with Blue Core engine. Great for Nepali city riding.'
    },
    
    // Superbikes (2)
    'fireblade': {
        name: 'Honda CBR1000RR-R Fireblade SP',
        price: 3250000,
        priceStr: 'रू 32,50,000',
        img: 'https://images.medialinksonline.com/imagestream/19131/8401483x1024x0_FFFFFF_L_0.jpg',
        cc: '999cc',
        mileage: '18 kmpl',
        power: '214 BHP',
        torque: '113 Nm',
        weight: '201 kg',
        seatHeight: '830 mm',
        fuelTank: '16.1 L',
        features: ['Öhlins S-EC Suspension', 'Aero Winglets', '6-axis IMU', 'Power Modes', 'Quick Shifter'],
        description: 'Track-focused liter-class superbike with MotoGP-derived technology. Ultimate performance machine.'
    },
    'bmw': {
        name: 'BMW S1000RR M Package 2023',
        price: 3450000,
        priceStr: 'रू 34,50,000',
        img: 'https://mcn-images.bauersecure.com/wp-images/190093/1440x960/2023_s1000rr_1.jpg',
        cc: '999cc',
        mileage: '16 kmpl',
        power: '205 BHP',
        torque: '113 Nm',
        weight: '197 kg',
        seatHeight: '825 mm',
        fuelTank: '16.5 L',
        features: ['M Carbon Wheels', 'DDC Suspension', 'Shift Assistant Pro', 'Race ABS'],
        description: 'German engineering at its finest. Premium superbike for Nepali highways.'
    },
    
    // Sport Bikes (2)
    'ninja': {
        name: 'Kawasaki Ninja ZX-10R 2022',
        price: 2650000,
        priceStr: 'रू 26,50,000',
        img: 'https://i.ytimg.com/vi/NAt1I77E7NI/maxresdefault.jpg',
        cc: '998cc',
        mileage: '19 kmpl',
        power: '200 BHP',
        torque: '114 Nm',
        weight: '207 kg',
        seatHeight: '835 mm',
        fuelTank: '17 L',
        features: ['Showa BFF Suspension', 'KLCM Launch Control', 'S-KTRC Traction Control', 'ABS', 'Power Modes'],
        description: 'Superbike racing pedigree with advanced electronics. Perfect for Nepali sport bike enthusiasts.'
    },
    'gsxr': {
        name: 'Suzuki GSX-R1000R 2021',
        price: 2450000,
        priceStr: 'रू 24,50,000',
        img: 'https://cdn.motor1.com/images/mgl/ZWG6r/s1/2021-gsx-r1000r-glass-matte-mechanical-gray.webp',
        cc: '999cc',
        mileage: '17 kmpl',
        power: '199 BHP',
        torque: '117 Nm',
        weight: '202 kg',
        seatHeight: '825 mm',
        fuelTank: '16 L',
        features: ['Motion Track ABS', 'Launch Control', 'S-DMS Power Modes', 'Quick Shifter'],
        description: 'Race-ready superbike with excellent value. Great for Nepali track days.'
    }
};

// Rental rates in NPR for all 10 bikes
const rentalRates = {
    // Dirt Bikes
    'ktm450': { hourly: 1200, daily: 7000, weekly: 42000, monthly: 150000 },
    'honda450': { hourly: 1100, daily: 6500, weekly: 39000, monthly: 140000 },
    'yamaha450': { hourly: 1150, daily: 6800, weekly: 40000, monthly: 145000 },
    // Commuter Bikes
    'splendor': { hourly: 200, daily: 1200, weekly: 7000, monthly: 25000 },
    'shine': { hourly: 220, daily: 1300, weekly: 7500, monthly: 28000 },
    'saluto': { hourly: 210, daily: 1250, weekly: 7200, monthly: 26000 },
    // Superbikes
    'fireblade': { hourly: 1800, daily: 10000, weekly: 60000, monthly: 220000 },
    'bmw': { hourly: 1900, daily: 11000, weekly: 65000, monthly: 240000 },
    // Sport Bikes
    'ninja': { hourly: 1600, daily: 9000, weekly: 55000, monthly: 200000 },
    'gsxr': { hourly: 1500, daily: 8500, weekly: 52000, monthly: 190000 }
};

// Load all 10 bikes
function loadBikes() {
    // 3 Dirt Bikes
    const dirtBikes = [
        { bike_id: 'ktm450', name: 'KTM 450 EXC-F 2022', price: 1850000, priceStr: 'रू 18,50,000', img: 'https://i.ytimg.com/vi/Esv4CJq44IY/maxresdefault.jpg', cc: '450cc', mileage: '35 kmpl', hourly_rate: 1200, daily_rate: 7000, weekly_rate: 42000, monthly_rate: 150000 },
        { bike_id: 'honda450', name: 'Honda CRF450R 2021', price: 1750000, priceStr: 'रू 17,50,000', img: 'https://images.squarespace-cdn.com/content/v1/5bf65317266c07c1f751f4c9/1610660141520-SZ8ABGLN40NCN7F7SAUA/THE_0802.jpg', cc: '449cc', mileage: '32 kmpl', hourly_rate: 1100, daily_rate: 6500, weekly_rate: 39000, monthly_rate: 140000 },
        { bike_id: 'yamaha450', name: 'Yamaha YZ450F 2023', price: 1790000, priceStr: 'रू 17,90,000', img: 'https://www.cyclenews.com/wp-content/uploads/2022/10/2023-Yamaha-YZ450F-right-side.jpg', cc: '450cc', mileage: '30 kmpl', hourly_rate: 1150, daily_rate: 6800, weekly_rate: 40000, monthly_rate: 145000 }
    ];
    
    // 3 Commuter Bikes
    const commuterBikes = [
        { bike_id: 'splendor', name: 'Hero Splendor Plus 2022', price: 85000, priceStr: 'रू 85,000', img: 'https://www.heromotocorp.com/content/dam/hero-dam-assets/global/np/home-page/Splendor_Red_Side.png', cc: '97cc', mileage: '63 kmpl', hourly_rate: 200, daily_rate: 1200, weekly_rate: 7000, monthly_rate: 25000 },
        { bike_id: 'shine', name: 'Honda Shine 125 2023', price: 95000, priceStr: 'रू 95,000', img: 'https://images.hindustantimes.com/auto/img/2023/10/20/1600x900/Honda_Shine_125_Rebel_Red_Metallic_1687325142141_1697801619085.jpg', cc: '125cc', mileage: '55 kmpl', hourly_rate: 220, daily_rate: 1300, weekly_rate: 7500, monthly_rate: 28000 },
        { bike_id: 'saluto', name: 'Yamaha Saluto RX 125', price: 89000, priceStr: 'रू 89,000', img: 'https://www.maw2wheelers.com/wp-content/uploads/2025/01/Saluto-Green.jpg', cc: '125cc', mileage: '58 kmpl', hourly_rate: 210, daily_rate: 1250, weekly_rate: 7200, monthly_rate: 26000 }
    ];
    
    // 2 Superbikes
    const superbikes = [
        { bike_id: 'fireblade', name: 'Honda CBR1000RR-R Fireblade SP', price: 3250000, priceStr: 'रू 32,50,000', img: 'https://images.medialinksonline.com/imagestream/19131/8401483x1024x0_FFFFFF_L_0.jpg', cc: '999cc', mileage: '18 kmpl', hourly_rate: 1800, daily_rate: 10000, weekly_rate: 60000, monthly_rate: 220000 },
        { bike_id: 'bmw', name: 'BMW S1000RR M Package 2023', price: 3450000, priceStr: 'रू 34,50,000', img: 'https://mcn-images.bauersecure.com/wp-images/190093/1440x960/2023_s1000rr_1.jpg', cc: '999cc', mileage: '16 kmpl', hourly_rate: 1900, daily_rate: 11000, weekly_rate: 65000, monthly_rate: 240000 }
    ];
    
    // 2 Sport Bikes
    const sportBikes = [
        { bike_id: 'ninja', name: 'Kawasaki Ninja ZX-10R 2022', price: 2650000, priceStr: 'रू 26,50,000', img: 'https://i.ytimg.com/vi/NAt1I77E7NI/maxresdefault.jpg', cc: '998cc', mileage: '19 kmpl', hourly_rate: 1600, daily_rate: 9000, weekly_rate: 55000, monthly_rate: 200000 },
        { bike_id: 'gsxr', name: 'Suzuki GSX-R1000R 2021', price: 2450000, priceStr: 'रू 24,50,000', img: 'https://cdn.motor1.com/images/mgl/ZWG6r/s1/2021-gsx-r1000r-glass-matte-mechanical-gray.webp', cc: '999cc', mileage: '17 kmpl', hourly_rate: 1500, daily_rate: 8500, weekly_rate: 52000, monthly_rate: 190000 }
    ];
    
    renderBikeCategory(dirtBikes, 'dirtGrid');
    renderBikeCategory(commuterBikes, 'commuterGrid');
    renderBikeCategory(superbikes, 'superbikeGrid');
    renderBikeCategory(sportBikes, 'sportGrid');
}

function renderBikeCategory(bikes, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = bikes.map(bike => `
        <div class="bike-card" onclick="showBikeDetails('${bike.bike_id}')">
            <div class="bike-image"><img src="${bike.img}" alt="${bike.name}"></div>
            <div class="bike-info">
                <h3 class="bike-name">${bike.name}</h3>
                <div class="bike-price">${bike.priceStr}</div>
                <div class="bike-specs">
                    <span><i class="fas fa-gas-pump"></i> ${bike.cc}</span>
                    <span><i class="fas fa-tachometer-alt"></i> ${bike.mileage}</span>
                </div>
                <button class="rent-btn" onclick="event.stopPropagation(); openRentalModal('${bike.bike_id}', '${bike.name.replace(/'/g, "\\'")}', ${bike.hourly_rate}, ${bike.daily_rate}, ${bike.weekly_rate}, ${bike.monthly_rate})">
                    <i class="fas fa-calendar-check"></i> भाडामा लिनुहोस्
                </button>
            </div>
        </div>
    `).join('');
}

// Show bike details
function showBikeDetails(bikeId) {
    const bike = bikeDatabase[bikeId];
    if (!bike) return;
    
    selectedBikeForDetail = bikeId;
    const rates = rentalRates[bikeId];
    
    const detailContent = `
        <img src="${bike.img}" alt="${bike.name}" style="width:100%; border-radius:15px; margin-bottom:1rem;">
        <h2 style="color:#1a3c34;">${bike.name}</h2>
        <div style="font-size:1.8rem; color:#ff6b35; font-weight:700;">${bike.priceStr}</div>
        
        <div class="bike-detail-specs">
            <div class="spec-box"><i class="fas fa-gas-pump"></i><div class="value">${bike.cc}</div><small>Engine</small></div>
            <div class="spec-box"><i class="fas fa-tachometer-alt"></i><div class="value">${bike.mileage}</div><small>Mileage</small></div>
            <div class="spec-box"><i class="fas fa-horse-head"></i><div class="value">${bike.power}</div><small>Power</small></div>
            <div class="spec-box"><i class="fas fa-weight-hanging"></i><div class="value">${bike.weight}</div><small>Weight</small></div>
        </div>
        
        <h3><i class="fas fa-star" style="color:#ff6b35;"></i> Key Features</h3>
        <ul class="feature-list">
            ${bike.features.map(f => `<li><i class="fas fa-check-circle"></i> ${f}</li>`).join('')}
        </ul>
        
        <h3><i class="fas fa-info-circle"></i> Description</h3>
        <p>${bike.description}</p>
        
        <h3><i class="fas fa-calendar"></i> भाडा दर (Rental Rates in NPR)</h3>
        <div class="bike-detail-specs">
            <div class="spec-box"><i class="fas fa-clock"></i><div class="value">रू ${rates.hourly}/hr</div><small>Hourly</small></div>
            <div class="spec-box"><i class="fas fa-sun"></i><div class="value">रू ${rates.daily}/day</div><small>Daily</small></div>
            <div class="spec-box"><i class="fas fa-calendar-week"></i><div class="value">रू ${rates.weekly}/week</div><small>Weekly</small></div>
            <div class="spec-box"><i class="fas fa-calendar-alt"></i><div class="value">रू ${rates.monthly}/month</div><small>Monthly</small></div>
        </div>
    `;
    
    document.getElementById('bikeDetailContent').innerHTML = detailContent;
    document.getElementById('bikeDetailModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function rentFromDetail() {
    if (selectedBikeForDetail) {
        closeBikeDetailModal();
        const bike = bikeDatabase[selectedBikeForDetail];
        const rates = rentalRates[selectedBikeForDetail];
        openRentalModal(selectedBikeForDetail, bike.name, rates.hourly, rates.daily, rates.weekly, rates.monthly);
    }
}

function closeBikeDetailModal() {
    document.getElementById('bikeDetailModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Nepali License Validation
function validateNepaliLicense(license) {
    let cleanLicense = license.replace(/\s/g, '').toUpperCase();
    
    if (/^\d{2}-\d{2}-\d{7}$/.test(cleanLicense)) {
        return { valid: true, cleaned: cleanLicense, type: 'Nepali Standard Format' };
    }
    if (/^\d{13}$/.test(cleanLicense)) {
        return { valid: true, cleaned: cleanLicense, type: 'Nepali Numeric Format' };
    }
    if (/^[A-Z]{3}-\d{6}$/.test(cleanLicense)) {
        return { valid: true, cleaned: cleanLicense, type: 'Nepali Old Format' };
    }
    if (/^\d{2}-\d{7}$/.test(cleanLicense)) {
        return { valid: true, cleaned: cleanLicense, type: 'Nepali Simple Format' };
    }
    
    return { valid: false, cleaned: cleanLicense, type: null };
}

function openRentalModal(bikeId, bikeName, hourly, daily, weekly, monthly) {
    if (!currentUser) {
        openAuthModal();
        alert('कृपया पहिले लगइन गर्नुहोस्');
        return;
    }
    
    currentBike = { id: bikeId, name: bikeName, hourly, daily, weekly, monthly };
    document.getElementById('rentalTitle').innerHTML = `${bikeName} भाडामा लिनुहोस्`;
    document.getElementById('rentBikeId').value = bikeId;
    document.getElementById('rentBikeName').value = bikeName;
    document.getElementById('rentName').value = currentUser.name || '';
    document.getElementById('rentPhone').value = currentUser.phone || '';
    document.getElementById('rentAge').value = '';
    document.getElementById('rentLicense').value = '01-02-1234567';
    document.getElementById('rentAddress').value = '';
    document.getElementById('rentDistrict').value = '';
    document.getElementById('rentWard').value = '';
    document.getElementById('rentDuration').value = 1;
    document.getElementById('termsCheckbox').checked = false;
    setRentalType('hourly');
    document.getElementById('rentalModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function setRentalType(type) {
    currentRentalType = type;
    document.querySelectorAll('.rental-type-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.rental-type-btn[data-type="${type}"]`).classList.add('active');
    updatePrice();
}

function updatePrice() {
    if (!currentBike) return;
    const duration = parseInt(document.getElementById('rentDuration').value) || 1;
    let price = 0;
    switch(currentRentalType) {
        case 'hourly': price = currentBike.hourly * duration; break;
        case 'daily': price = currentBike.daily * duration; break;
        case 'weekly': price = currentBike.weekly * duration; break;
        case 'monthly': price = currentBike.monthly * duration; break;
    }
    document.getElementById('totalPrice').innerHTML = `रू ${price.toLocaleString('en-IN')}`;
}

async function submitSecureRental() {
    const name = document.getElementById('rentName').value;
    const age = parseInt(document.getElementById('rentAge').value);
    const license = document.getElementById('rentLicense').value;
    const address = document.getElementById('rentAddress').value;
    const district = document.getElementById('rentDistrict').value;
    const ward = document.getElementById('rentWard').value;
    const phone = document.getElementById('rentPhone').value;
    const termsChecked = document.getElementById('termsCheckbox').checked;
    
    const licenseValidation = validateNepaliLicense(license);
    if (!licenseValidation.valid) {
        alert(`❌ अमान्य ड्राइभिङ लाइसेन्स!\n\nValid Examples:\n• 01-02-1234567\n• 1234567890123\n• KHD-123456`);
        document.getElementById('rentLicense').focus();
        return;
    }
    
    if (!name || name.length < 3) {
        alert('❌ कृपया पुरा नाम भर्नुहोस्');
        return;
    }
    if (!age || age < 18) {
        alert('❌ कम्तीमा १८ वर्ष हुनुपर्छ');
        return;
    }
    if (!address) {
        alert('❌ कृपया ठेगाना भर्नुहोस्');
        return;
    }
    if (!district) {
        alert('❌ कृपया जिल्ला चयन गर्नुहोस्');
        return;
    }
    if (!phone || !/^\d{10}$/.test(phone)) {
        alert('❌ मान्य १० अंकको फोन नम्बर भर्नुहोस्');
        return;
    }
    if (!termsChecked) {
        alert('❌ कृपया नियम स्वीकार गर्नुहोस्');
        return;
    }
    
    const fullAddress = ward ? `${address}, वडा ${ward}, ${district}` : `${address}, ${district}`;
    
    const rentalData = {
        bike_id: document.getElementById('rentBikeId').value,
        bike_name: document.getElementById('rentBikeName').value,
        rental_type: currentRentalType,
        duration: parseInt(document.getElementById('rentDuration').value),
        total_price: parseInt(document.getElementById('totalPrice').innerHTML.replace('रू', '').replace(/,/g, '')),
        customer_name: name,
        customer_age: age,
        customer_license: licenseValidation.cleaned,
        customer_address: fullAddress,
        district: district,
        ward_no: ward || null,
        customer_phone: phone
    };
    
    const submitBtn = document.querySelector('#rentalModal .submit-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> प्रक्रियामा...';
    submitBtn.disabled = true;
    
    try {
        const response = await fetch('api/rental.php?action=create', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(rentalData)
        });
        const result = await response.json();
        
        if (result.success) {
            alert(`✅ बुकिङ पुष्टि भयो!\n\n━━━━━━━━━━━━━━━━━━━━━\n🏍️ बाइक: ${rentalData.bike_name}\n📅 प्रकार: ${rentalData.rental_type}\n⏱️ अवधि: ${rentalData.duration}\n💰 जम्मा: रू ${rentalData.total_price.toLocaleString('en-IN')}\n🪪 लाइसेन्स: ${rentalData.customer_license}\n📍 ठेगाना: ${rentalData.customer_address}\n━━━━━━━━━━━━━━━━━━━━━\n\nBritss Bikes छनौट गर्नुभएकोमा धन्यवाद!`);
            closeRentalModal();
            if (document.getElementById('historyModal').style.display === 'flex') {
                showRentalHistory();
            }
        } else {
            alert('❌ बुकिङ असफल: ' + result.message);
        }
    } catch(e) {
        alert('❌ समस्या: ' + e.message);
    } finally {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
}

async function showRentalHistory() {
    if (!currentUser) {
        openAuthModal();
        return;
    }
    
    document.getElementById('historyModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    const contentDiv = document.getElementById('rentalHistoryContent');
    contentDiv.innerHTML = '<div style="text-align:center; padding:2rem;">Loading...</div>';
    
    try {
        const response = await fetch('api/rental.php?action=get_user_rentals');
        const data = await response.json();
        
        if (data.success && data.rentals && data.rentals.length > 0) {
            contentDiv.innerHTML = `
                <table class="rental-table">
                    <thead><tr><th>ID</th><th>Bike</th><th>Type</th><th>Duration</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                        ${data.rentals.map(rental => `
                            <tr>
                                <td>${rental.rental_id}</td>
                                <td><strong>${rental.bike_name}</strong></td>
                                <td>${rental.rental_type}</td>
                                <td>${rental.duration}</td>
                                <td>रू ${parseInt(rental.total_price).toLocaleString('en-IN')}</td>
                                <td style="color:green;">${rental.status.toUpperCase()}</td>
                                <td>${new Date(rental.booking_date).toLocaleDateString('ne-NP')}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        } else {
            contentDiv.innerHTML = `<div style="text-align:center; padding:2rem;"><i class="fas fa-motorcycle" style="font-size:3rem; color:#ff6b35;"></i><h3>कुनै भाडा छैन</h3><button class="rent-btn" onclick="closeHistoryModal()">बाइक हेर्नुहोस्</button></div>`;
        }
    } catch(e) {
        contentDiv.innerHTML = `<div style="text-align:center; padding:2rem; color:red;">Error: ${e.message}</div>`;
    }
}

// Auth functions
async function checkLoginStatus() {
    try {
        const response = await fetch('api/auth.php?action=check');
        const data = await response.json();
        if (data.success && data.logged_in) {
            currentUser = { name: data.name, email: data.email, id: data.user_id, phone: data.phone || '' };
            document.getElementById('userMenu').style.display = 'flex';
            document.getElementById('loginBtn').style.display = 'none';
            document.getElementById('userNameDisplay').innerHTML = `<i class="fas fa-user-circle"></i> ${data.name}`;
        } else {
            document.getElementById('userMenu').style.display = 'none';
            document.getElementById('loginBtn').style.display = 'block';
        }
    } catch(e) {
        console.error('Auth check failed:', e);
    }
}

async function login() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    const formData = new URLSearchParams();
    formData.append('action', 'login');
    formData.append('email', email);
    formData.append('password', password);
    
    try {
        const response = await fetch('api/auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            alert('✅ लगइन सफल! स्वागत छ ' + data.name);
            closeAuthModal();
            checkLoginStatus();
        } else {
            alert('❌ ' + data.message);
        }
    } catch(e) {
        alert('❌ Error: ' + e.message);
    }
}

async function register() {
    const name = document.getElementById('regName').value;
    const email = document.getElementById('regEmail').value;
    const phone = document.getElementById('regPhone').value;
    const password = document.getElementById('regPassword').value;
    const confirm = document.getElementById('regConfirm').value;
    
    const emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('❌ मान्य इमेल भर्नुहोस्');
        return;
    }
    if (!name || name.length < 3) {
        alert('❌ पुरा नाम भर्नुहोस्');
        return;
    }
    if (password !== confirm) {
        alert('❌ पासवर्ड मिलेन');
        return;
    }
    if (password.length < 6) {
        alert('❌ पासवर्ड कम्तीमा ६ अक्षर');
        return;
    }
    if (!phone || !/^\d{10}$/.test(phone)) {
        alert('❌ १० अंकको फोन नम्बर');
        return;
    }
    
    const formData = new URLSearchParams();
    formData.append('action', 'register');
    formData.append('name', name);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('password', password);
    
    try {
        const response = await fetch('api/auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            alert('✅ रजिस्ट्रेसन सफल!');
            closeAuthModal();
            checkLoginStatus();
        } else {
            if (data.message.includes('already')) {
                alert('❌ यो इमेल पहिले नै दर्ता छ। लगइन गर्नुहोस्।');
            } else {
                alert('❌ ' + data.message);
            }
        }
    } catch(e) {
        alert('❌ Error: ' + e.message);
    }
}

async function logout() {
    const formData = new URLSearchParams();
    formData.append('action', 'logout');
    
    await fetch('api/auth.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData
    });
    
    currentUser = null;
    checkLoginStatus();
    alert('लगआउट भयो');
}

function openAuthModal() {
    document.getElementById('authModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeAuthModal() {
    document.getElementById('authModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeRentalModal() {
    document.getElementById('rentalModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function closeHistoryModal() {
    document.getElementById('historyModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function showRegister() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
    document.getElementById('authTitle').innerHTML = 'Register';
}

function showLogin() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('authTitle').innerHTML = 'Login';
}

function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('active');
}

// Smooth scroll
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const target = document.getElementById(targetId);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
            document.getElementById('navLinks').classList.remove('active');
        }
    });
});

// Initialize
checkLoginStatus();
loadBikes();
</script>
</body>
</html>