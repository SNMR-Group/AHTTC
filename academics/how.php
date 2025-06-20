

    <!-- Bootstrap, Font Awesome & Animate.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Section Styling */
        .apply-section {
            background: linear-gradient(135deg, #1B5E20, #388E3C);
            color: white;
            padding: 60px 0;
            text-align: center;
            box-shadow: 0px 5px 20px rgba(0, 100, 0, 0.3);
        }

        .apply-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 0 0 15px rgba(0, 255, 127, 0.6);
            margin-bottom: 20px;
        }

        /* Step Cards */
        .apply-step {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 255, 127, 0.3);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        }

        .apply-step:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 255, 127, 0.5);
        }

        .apply-step i {
            font-size: 3rem;
            color: #FFF176;
            margin-bottom: 10px;
        }

        /* Documents Section */
        .documents-list {
            text-align: left;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 255, 127, 0.3);
        }

        /* Apply Now Button */
        .apply-btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #43A047, #81C784);
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0px 5px 15px rgba(0, 255, 127, 0.4);
            transition: transform 0.3s ease-in-out;
        }

        .apply-btn:hover {
            transform: scale(1.1);
            box-shadow: 0px 10px 20px rgba(0, 255, 127, 0.6);
        }
    </style>

    <!-- How to Apply Section -->
    <section class="apply-section">
        <div class="container">
            <h2 class="animate__animated animate__fadeInDown">How to Apply for B.Ed Program</h2>
            <p class="animate__animated animate__fadeInUp">Follow these steps to complete your application process.</p>

            <div class="row mt-4 g-4">
                <!-- Step 1 -->
                <div class="col-md-4">
                    <div class="apply-step animate__animated animate__fadeInLeft">
                        <i class="fas fa-file-alt"></i>
                        <h5>Step 1: Check Eligibility</h5>
                        <p>Candidates must have 50% marks in Bachelor's or Master's Degree.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-md-4">
                    <div class="apply-step animate__animated animate__fadeInUp">
                        <i class="fas fa-upload"></i>
                        <h5>Step 2: Submit Application</h5>
                        <p>Fill out the online application form and upload required documents.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-md-4">
                    <div class="apply-step animate__animated animate__fadeInRight">
                        <i class="fas fa-user-check"></i>
                        <h5>Step 3: Attend Counseling</h5>
                        <p>Appear for verification and complete the admission formalities.</p>
                    </div>
                </div>
            </div>

            <!-- Documents Required -->
            <div class="row mt-5">
                <div class="col-md-6 mx-auto">
                    <div class="documents-list animate__animated animate__fadeInUp">
                        <h4 class="text-center">Required Documents</h4>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-warning"></i> 10th, 12th & Graduation Mark Sheets</li>
                            <li><i class="fas fa-check-circle text-warning"></i> ID Proof (Aadhar Card, Voter ID, etc.)</li>
                            <li><i class="fas fa-check-circle text-warning"></i> 5 Passport Size Photos</li>
                            <li><i class="fas fa-check-circle text-warning"></i> Completed Admission Form</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Apply Now Button -->
            <div class="mt-4">
                <a href="apply.php" class="apply-btn animate__animated animate__pulse animate__infinite">Apply Now</a>
            </div>
        </div>
    </section>


