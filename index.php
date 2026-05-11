<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Britss Bikes - Premium Motorcycles & Rentals</title>
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
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: 0.3s;
        }
        .nav-links a:hover { color: #ff6b35; }
        .login-btn {
            background: #ff6b35;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            border: none;
            font-weight: 600;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .logout-btn {
            background: none;
            border: none;
            color: #ff6b35;
            cursor: pointer;
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
        }
        .bike-card:hover { transform: translateY(-10px); }
        .bike-image {
            height: 220px;
            overflow: hidden;
        }
        .bike-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
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
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            padding: 2rem;
        }
        .close-modal {
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
        }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-family: inherit;
        }
        .rental-type-buttons {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        .rental-type-btn {
            flex: 1;
            padding: 0.5rem;
            background: #e0e0e0;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
        }
        .rental-type-btn.active { background: #ff6b35; color: white; }
        .price-display {
            background: #f0f0f0;
            padding: 1rem;
            text-align: center;
            border-radius: 10px;
            margin: 1rem 0;
        }
        .price-display h3 { color: #ff6b35; font-size: 1.8rem; }
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
        }
        
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
        }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="#" class="logo">Britss<span style="color:#ff6b35;">Bikes</span></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#home">Home</a></li>
            <li><a href="#dirt">Dirt Bikes</a></li>
            <li><a href="#commuter">Commuter</a></li>
            <li><a href="#superbike">Superbikes</a></li>
            <li><a href="#sport">Sport</a></li>
        </ul>
        <div id="authSection">
            <div class="user-menu" id="userMenu" style="display:none;">
                <span id="userName"></span>
                <button class="logout-btn" onclick="logout()">Logout</button>
            </div>
            <button class="login-btn" id="loginBtn" onclick="openAuthModal()">Login / Register</button>
        </div>
        <div class="hamburger" onclick="toggleMenu()"><span></span><span></span><span></span></div>
    </nav>
</header>

<section id="home" class="hero">
    <div>
        <h1>Premium Reconditioned Motorcycles</h1>
        <p>10+ Premium Bikes | 12-Month Warranty | Free Delivery</p>
        <a href="#dirt" class="btn btn-primary">Explore Bikes</a>
    </div>
</section>

<!-- Bike Sections -->
<div id="dirt" class="section"><div class="section-title"><h2>🏍️ Dirt / Enduro Bikes</h2><p>Built for off-road dominance</p></div><div class="bikes-grid" id="dirtGrid"></div></div>
<div id="commuter" class="section" style="background:#fafafa;"><div class="section-title"><h2>⚡ Commuter Bikes</h2><p>Reliable daily riders</p></div><div class="bikes-grid" id="commuterGrid"></div></div>
<div id="superbike" class="section"><div class="section-title"><h2>🔥 Superbikes</h2><p>Ultimate performance machines</p></div><div class="bikes-grid" id="superbikeGrid"></div></div>
<div id="sport" class="section" style="background:#fafafa;"><div class="section-title"><h2>🏁 Sport Bikes</h2><p>Track-focused monsters</p></div><div class="bikes-grid" id="sportGrid"></div></div>

<footer>
    <p>© 2025 Britss Recondition House | All Rights Reserved</p>
    <p>📍 urlabari, Nepal | 📞 +977 9846847762| ✉️ sales@britsbikes.com</p>
</footer>

<!-- Auth Modal -->
<div id="authModal" class="modal-overlay" onclick="if(event.target===this) closeAuthModal()">
    <div class="modal-content">
        <span class="close-modal" onclick="closeAuthModal()">&times;</span>
        <h2 id="authTitle">Login</h2>
        <div id="loginForm">
            <div class="form-group"><input type="email" id="loginEmail" placeholder="Email" required></div>
            <div class="form-group"><input type="password" id="loginPassword" placeholder="Password" required></div>
            <button class="submit-btn" onclick="login()">Login</button>
            <p style="text-align:center; margin-top:1rem">Don't have an account? <a href="#" onclick="showRegister()">Register</a></p>
            <p style="text-align:center; font-size:12px; margin-top:1rem; color:#666;">Demo: admin@britsbikes.com / admin123</p>
        </div>
        <div id="registerForm" style="display:none">
            <div class="form-group"><input type="text" id="regName" placeholder="Full Name" required></div>
            <div class="form-group"><input type="email" id="regEmail" placeholder="Email" required></div>
            <div class="form-group"><input type="tel" id="regPhone" placeholder="Phone"></div>
            <div class="form-group"><input type="password" id="regPassword" placeholder="Password" required></div>
            <div class="form-group"><input type="password" id="regConfirm" placeholder="Confirm Password" required></div>
            <button class="submit-btn" onclick="register()">Register</button>
            <p style="text-align:center; margin-top:1rem">Already have an account? <a href="#" onclick="showLogin()">Login</a></p>
        </div>
    </div>
</div>

<!-- Rental Modal -->
<div id="rentalModal" class="modal-overlay" onclick="if(event.target===this) closeRentalModal()">
    <div class="modal-content">
        <span class="close-modal" onclick="closeRentalModal()">&times;</span>
        <h2 id="rentalTitle">Rent a Bike</h2>
        <form id="rentalForm" onsubmit="event.preventDefault(); submitRentalToDB();">
            <div class="form-group"><label>Full Name *</label><input type="text" id="rentName" required></div>
            <div class="form-group"><label>Age * (Min 18)</label><input type="number" id="rentAge" min="18" required></div>
            <div class="form-group"><label>License Number *</label><input type="text" id="rentLicense" required></div>
            <div class="form-group"><label>Address *</label><input type="text" id="rentAddress" required></div>
            
            <label>Rental Type</label>
            <div class="rental-type-buttons">
                <button type="button" class="rental-type-btn" data-type="hourly" onclick="setRentalType('hourly')">Hourly</button>
                <button type="button" class="rental-type-btn" data-type="daily" onclick="setRentalType('daily')">Daily</button>
                <button type="button" class="rental-type-btn" data-type="weekly" onclick="setRentalType('weekly')">Weekly</button>
                <button type="button" class="rental-type-btn" data-type="monthly" onclick="setRentalType('monthly')">Monthly</button>
            </div>
            
            <div class="form-group"><label>Duration</label><input type="number" id="rentDuration" value="1" min="1" onchange="updatePrice()"></div>
            
            <div class="price-display"><p>Total Price</p><h3 id="totalPrice">₹0</h3></div>
            <input type="hidden" id="rentBikeId">
            <input type="hidden" id="rentBikeName">
            <button type="submit" class="submit-btn">Confirm Booking</button>
        </form>
    </div>
</div>

<script>
let currentUser = null;
let currentBike = null;
let currentRentalType = 'hourly';

// Load bikes from database
async function loadBikes() {
    try {
        const response = await fetch('api/bikes.php');
        const data = await response.json();
        
        if (data.success && data.grouped) {
            renderBikeCategory(data.grouped.dirt, 'dirtGrid');
            renderBikeCategory(data.grouped.commuter, 'commuterGrid');
            renderBikeCategory(data.grouped.superbike, 'superbikeGrid');
            renderBikeCategory(data.grouped.sport, 'sportGrid');
        }
    } catch(e) {
        console.error('Error loading bikes:', e);
    }
}

function renderBikeCategory(bikes, containerId) {
    const container = document.getElementById(containerId);
    if (!container || !bikes || bikes.length === 0) return;
    
    container.innerHTML = bikes.map(bike => `
        <div class="bike-card">
            <div class="bike-image"><img src="${bike.image_url}" alt="${bike.name}" onerror="this.src='https://via.placeholder.com/300x200?text=Britss+Bike'"></div>
            <div class="bike-info">
                <h3 class="bike-name">${bike.name}</h3>
                <div class="bike-price">₹${parseInt(bike.price).toLocaleString('en-IN')}</div>
                <div class="bike-specs">
                    <span><i class="fas fa-gas-pump"></i> ${bike.cc}</span>
                    <span><i class="fas fa-tachometer-alt"></i> ${bike.mileage}</span>
                </div>
                <button class="rent-btn" onclick="openRentalModal('${bike.bike_id}', '${bike.name.replace(/'/g, "\\'")}', ${bike.hourly_rate}, ${bike.daily_rate}, ${bike.weekly_rate}, ${bike.monthly_rate})">
                    <i class="fas fa-calendar-check"></i> Rent Now
                </button>
            </div>
        </div>
    `).join('');
}

function openRentalModal(bikeId, bikeName, hourly, daily, weekly, monthly) {
    if (!currentUser) {her
        openAuthModal();
        alert('Please login first to rent a bike');
        return;
    }
    
    currentBike = { id: bikeId, name: bikeName, hourly, daily, weekly, monthly };
    document.getElementById('rentalTitle').innerHTML = `Rent: ${bikeName}`;
    document.getElementById('rentBikeId').value = bikeId;
    document.getElementById('rentBikeName').value = bikeName;
    document.getElementById('rentName').value = currentUser.name || '';
    document.getElementById('rentAge').value = '';
    document.getElementById('rentLicense').value = '';
    document.getElementById('rentAddress').value = '';
    document.getElementById('rentDuration').value = 1;
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
    document.getElementById('totalPrice').innerHTML = `₹${price.toLocaleString('en-IN')}`;
}

async function submitRentalToDB() {
    const rentalData = {
        bike_id: document.getElementById('rentBikeId').value,
        bike_name: document.getElementById('rentBikeName').value,
        rental_type: currentRentalType,
        duration: parseInt(document.getElementById('rentDuration').value),
        total_price: parseInt(document.getElementById('totalPrice').innerHTML.replace('₹', '').replace(/,/g, '')),
        customer_name: document.getElementById('rentName').value,
        customer_age: parseInt(document.getElementById('rentAge').value),
        customer_license: document.getElementById('rentLicense').value,
        customer_address: document.getElementById('rentAddress').value
    };
    
    if (!rentalData.customer_name || !rentalData.customer_age || !rentalData.customer_license || !rentalData.customer_address) {
        alert('Please fill all required fields');
        return;
    }
    
    if (rentalData.customer_age < 18) {
        alert('You must be at least 18 years old to rent a bike');
        return;
    }
    
    try {
        const response = await fetch('api/rental.php?action=create', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(rentalData)
        });
        const result = await response.json();
        
        if (result.success) {
            alert(`✅ ${result.message}\n\nBike: ${rentalData.bike_name}\nDuration: ${rentalData.duration} ${rentalData.rental_type}(s)\nTotal: ₹${rentalData.total_price.toLocaleString('en-IN')}\n\nThank you for choosing Britss Bikes!`);
            closeRentalModal();
        } else {
            alert('❌ Booking failed: ' + result.message);
        }
    } catch(e) {
        alert('❌ Error: ' + e.message);
    }
}

// Auth functions
async function checkLoginStatus() {
    try {
        const response = await fetch('api/auth.php?action=check');
        const data = await response.json();
        if (data.success && data.logged_in) {
            currentUser = { name: data.name, email: data.email, id: data.user_id };
            document.getElementById('userMenu').style.display = 'flex';
            document.getElementById('loginBtn').style.display = 'none';
            document.getElementById('userName').innerHTML = `👋 ${data.name}`;
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
            alert('✅ Login successful! Welcome ' + data.name);
            closeAuthModal();
            checkLoginStatus();
            document.getElementById('loginEmail').value = '';
            document.getElementById('loginPassword').value = '';
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
    
    if (!name || !email) {
        alert('Please fill name and email');
        return;
    }
    if (password !== confirm) {
        alert('Passwords do not match');
        return;
    }
    if (password.length < 4) {
        alert('Password must be at least 4 characters');
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
            alert('✅ Registration successful! You are now logged in.');
            closeAuthModal();
            checkLoginStatus();
        } else {
            alert('❌ ' + data.message);
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
    alert('Logged out successfully');
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

function showRegister() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
    document.getElementById('authTitle').innerText = 'Register';
}

function showLogin() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('authTitle').innerText = 'Login';
}

function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('active');
}

// Initialize
checkLoginStatus();
loadBikes();
</script>
</body>
</html>