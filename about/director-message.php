

<style>
    .director-image {
    position: relative;
    display: inline-block;
}

.director-image::before {
    content: '';
    position: absolute;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(255, 223, 0, 0.3), transparent);
    border-radius: 50%;
    top: -15px;
    right: -15px;
    animation: glowAnimation 2s infinite alternate;
}

@keyframes glowAnimation {
    from {
        transform: scale(1);
        opacity: 0.8;
    }
    to {
        transform: scale(1.2);
        opacity: 1;
    }
}

.cta-wrapper {
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

.cta-wrapper:hover {
    box-shadow: 0 15px 50px rgba(255, 223, 0, 0.4);
}

.bi-quote {
    font-size: 3rem;
    color: gold;
    opacity: 0.8;
}
</style>
<div class="cta-area position-relative py-4 mb-5" style="margin-top: 100px; background: linear-gradient(135deg, #004d40, #198754);">
    <div class="container">
        <div class="cta-wrapper text-white p-4 rounded shadow-lg position-relative" data-aos="fade-left" 
            style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); border-radius: 20px;">
            
            <div class="row align-items-center">
                
                <!-- Director's Image -->
                <div class="col-lg-4 text-center text-lg-start" data-aos="fade-right">
                    <div class="director-image" style="position: relative;">
                        <img src="images/director (3).png" alt="Al-Habeeb Teacher Training College" 
                            class="img-fluid rounded-circle shadow-lg" style="max-width: 250px; border: 4px solid gold;">
                        <span class="glow-effect"></span>
                    </div>
                </div>

                <!-- Quote Section -->
                <div class="col-lg-8 text-center">
                    <div class="cta-content" data-aos="fade-left">
                        <i class="bi bi-quote text-warning fs-1"></i>
                        <p class="fs-4 fw-light fst-italic text-white" style="font-family: 'Playfair Display', serif;">
                            "Education is the foundation of growth, shaping both individuals and societies. With India having 550 million young people under 25, our country is set to play a major role in the global workforce, driving progress and innovation worldwide."
                        </p>
                        <p class="fw-bold mt-3 text-warning fs-5"><em>- Dr. Raees Ahmed Khan, Founder & Mentor</em></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>