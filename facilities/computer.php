<style>
    .bg-light {
    background-color: #f9f9f9 !important; 
}


.icon-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60px;
    height: 60px;
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.icon-box:hover {
    transform: scale(1.1);
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
}


h5 {
    font-size: 1.25rem;
    font-weight: bold;
}


.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, transform 0.3s ease;
}


.container {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>
<section class="computer-lab-section py-5 bg-light text-dark">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="fw-bold theme-btn">💻 Computer Laboratory</h3>
            <p class="lead text-muted">A cutting-edge, fully-equipped computer lab for your academic and research needs.</p>
        </div>
        <div class="row g-5">
          
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center mb-4">
                    <span class="icon-box text-white p-4 rounded-circle me-3" style = "background  : #116e63; ">
                        <i class="bi bi-laptop" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="fw-bold">High-End Personal Computers</h5>
                        <p class="text-muted">Our computers are equipped with the latest configurations to handle all academic and research tasks with ease.</p>
                    </div>
                </div>
            </div>

           
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-center mb-4">
                    <span class="icon-box text-white p-4 rounded-circle me-3" style = "background  : #116e63; " >
                        <i class="bi bi-wifi" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="fw-bold">High-Speed Internet</h5>
                        <p class="text-muted">Fast and reliable internet access is available at every workstation, ensuring smooth research and browsing.</p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-items-center mb-4">
                    <span class="icon-box bg-pr text-white p-4 rounded-circle me-3" style = "background  : #116e63; ">
                        <i class="bi bi-printer" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="fw-bold">Scanning & Printing Facilities</h5>
                        <p class="text-muted">Easily print your assignments or scan documents using the lab's efficient printing and scanning facilities.</p>
                    </div>
                </div>
            </div>

           
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="d-flex align-items-center mb-4">
                    <span class="icon-box text-white p-4 rounded-circle me-3" style = "background  : #116e63; ">
                        <i class="bi bi-person-check" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="fw-bold">Technical Faculty Support</h5>
                        <p class="text-muted">Qualified faculty members provide ongoing technical assistance and help students with their learning process.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
            <a href="index.php" class="btn  px-5 py-2 fw-semibold shadow-lg" style = "background  : #116e63; ">Explore Computer Lab</a>
        </div>
    </div>
</section>

<script>
    AOS.init({
        duration: 1000,  
        once: true,      
        easing: 'ease-in-out' 
    });
</script>