@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<style>
.about-container {
    max-width: 1200px;
    margin: auto;
    padding: 40px 20px;
    font-family: 'Segoe UI', sans-serif;
}

.about-hero {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    padding: 60px 30px;
    border-radius: 15px;
    color: #fff;
    text-align: center;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.about-hero h1 {
    font-size: 3rem;
    margin-bottom: 15px;
}

.about-hero p {
    font-size: 1.2rem;
    max-width: 800px;
    margin: auto;
}

.about-section {
    margin-bottom: 50px;
}

.about-section h2 {
    font-size: 2rem;
    margin-bottom: 15px;
    color: #333;
}

.about-section p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #555;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.team-card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s;
}

.team-card:hover {
    transform: translateY(-10px);
}

.team-card img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 15px;
}

.team-card h4 {
    font-size: 1.1rem;
    margin: 5px 0;
}

.team-card p {
    font-size: 0.95rem;
    color: #777;
}
</style>

<div class="about-container">
    <div class="about-hero">
        <h1>About Our Company</h1>
        <p>We’re passionate about delivering high-quality products and services that make a difference in our customers' lives. Here's who we are and what we stand for.</p>
    </div>

    <div class="about-section">
        <h2>Our Mission</h2>
        <p>To empower customers through innovative technology and seamless user experiences, while maintaining a strong commitment to integrity, excellence, and sustainability.</p>
    </div>

    <div class="about-section">
        <h2>Our Story</h2>
        <p>Founded in 2023, our journey began with a small team of dedicated innovators. Today, we’re a fast-growing company serving hundreds of customers nationwide, with a focus on digital transformation and customer satisfaction.</p>
    </div>

    <div class="about-section">
        <h2>Meet the Team</h2>
        <div class="team-grid">
            <div class="team-card">
                <img src="https://i.pravatar.cc/80?img=1" alt="Founder">
                <h4>Ravi Sharma</h4>
                <p>Founder & CEO</p>
            </div>
            <div class="team-card">
                <img src="https://i.pravatar.cc/80?img=2" alt="Designer">
                <h4>Priya Patel</h4>
                <p>UI/UX Designer</p>
            </div>
            <div class="team-card">
                <img src="https://i.pravatar.cc/80?img=3" alt="Developer">
                <h4>Arjun Mehta</h4>
                <p>Lead Developer</p>
            </div>
            <div class="team-card">
                <img src="https://i.pravatar.cc/80?img=4" alt="Support">
                <h4>Neha Verma</h4>
                <p>Customer Support</p>
            </div>
        </div>
    </div>
</div>
@endsection
