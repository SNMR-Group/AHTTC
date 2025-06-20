<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Ed & D.ELEd Student Query Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /*background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);*/
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        /* Header */
        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2em;
            margin: 10px 0;
            opacity: 0.9;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #4CAF50, #2196F3, #FF9800);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-size: 1.8em;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 15px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
            color: #555;
            font-size: 0.95em;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0 18px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.2s, box-shadow 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .form-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-group > div {
            flex: 1;
            min-width: 250px;
        }

        .academic-info {
            background: #f8f9ff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }

        .academic-info h3 {
            margin-top: 0;
            color: #333;
            font-size: 1.3em;
        }

        .priority-indicator {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: 600;
            margin-left: 10px;
        }

        .high-priority {
            background: #ffebee;
            color: #c62828;
        }

        .medium-priority {
            background: #fff3e0;
            color: #ef6c00;
        }

        .low-priority {
            background: #e8f5e8;
            color: #2e7d32;
        }

        @media (max-width: 768px) {
            .form-group {
                flex-direction: column;
            }
            
            .form-group > div {
                min-width: auto;
            }
            
            .header h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>

    <!--<div class="header">-->
    <!--    <h1>📚 Student Support Center</h1>-->
    <!--    <p>B.Ed & D.ELEd Program Query Portal</p>-->
    <!--</div>-->

    <!-- Form Section -->
    <div class="form-container mb-5 mt-5">
        <h2> Write your Query</h2>
        <form action="process_education_query.php" method="POST">
            
            <!-- Personal Information -->
            <div class="form-group">
                <div>
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
                </div>
                <div>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="email">College Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="your.name@college.edu" required>
                </div>
                <div>
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="+91 XXXXX XXXXX">
                </div>
            </div>

            <!-- Academic Information -->
            <div class="academic-info">
                <h3>📖 Academic Details</h3>
                
                <div class="form-group">
                    <div>
                        <label for="course">Course Program:</label>
                        <select id="course" name="course" required>
                            <option value="">-- Select your course --</option>
                            <option value="bed">B.Ed (Bachelor of Education)</option>
                            <option value="deled">D.ELEd (Diploma in Elementary Education)</option>
                            <option value="integrated_bed">Integrated B.Ed</option>
                            <option value="bed_special">B.Ed Special Education</option>
                        </select>
                    </div>
                    <div>
                        <label for="semester">Current Semester/Year:</label>
                        <select id="semester" name="semester" required>
                            <option value="">-- Select semester --</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                            <option value="3">3rd Semester</option>
                            <option value="4">4th Semester</option>
                            <option value="year1">1st Year</option>
                            <option value="year2">2nd Year</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="student_id">Student ID/Roll Number:</label>
                        <input type="text" id="student_id" name="student_id" placeholder="Enter your student ID" required>
                    </div>
                    <div>
                        <label for="specialization">Subject Specialization:</label>
                        <select id="specialization" name="specialization">
                            <option value="">-- Select specialization --</option>
                            <option value="mathematics">Mathematics</option>
                            <option value="science">Science</option>
                            <option value="english">English</option>
                            <option value="hindi">Hindi</option>
                            <option value="social_science">Social Science</option>
                            <option value="primary_education">Primary Education</option>
                            <option value="early_childhood">Early Childhood Education</option>
                            <option value="special_education">Special Education</option>
                            <option value="physical_education">Physical Education</option>
                            <option value="arts">Arts & Crafts</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Query Information -->
            <label for="query_type">Type of Query:</label>
            <select id="query_type" name="query_type" required>
                <option value="">-- Select query type --</option>
                <option value="academic_curriculum">Academic Curriculum & Syllabus</option>
                <option value="practicum_teaching">Teaching Practicum/Internship</option>
                <option value="assignments_projects">Assignments & Project Work</option>
                <option value="examination_assessment">Examination & Assessment</option>
                <option value="lesson_planning">Lesson Planning & Teaching Methods</option>
                <option value="educational_psychology">Educational Psychology</option>
                <option value="classroom_management">Classroom Management</option>
                <option value="research_methodology">Research & Methodology</option>
                <option value="student_counseling">Student Counseling & Guidance</option>
                <option value="admission_registration">Admission & Registration</option>
                <option value="fee_scholarship">Fee & Scholarship</option>
                <option value="library_resources">Library & Learning Resources</option>
                <option value="placement_career">Placement & Career Guidance</option>
                <option value="technical_support">Technical Support (Online Classes)</option>
                <option value="other">Other Educational Query</option>
            </select>

            <label for="priority">Query Priority:</label>
            <select id="priority" name="priority" required>
                <option value="medium">Medium Priority</option>
                <option value="high">High Priority (Urgent)</option>
                <option value="low">Low Priority (General Inquiry)</option>
            </select>

            <label for="subject">Subject/Topic:</label>
            <input type="text" id="subject" name="subject" placeholder="Brief subject of your query" required>

            <label for="message">Detailed Query:</label>
            <textarea id="message" name="message" rows="6" placeholder="Please describe your query in detail. Include specific course details, deadlines, or any relevant information that will help us assist you better..." required></textarea>

            <label for="preferred_contact">Preferred Response Method:</label>
            <select id="preferred_contact" name="preferred_contact">
                <option value="email">Email Response</option>
                <option value="phone">Phone Call</option>
                <option value="whatsapp">WhatsApp Message</option>
                <option value="either">Any method is fine</option>
            </select>

            <label for="response_time">Expected Response Time:</label>
            <select id="response_time" name="response_time">
                <option value="24hrs">Within 24 hours</option>
                <option value="48hrs">Within 48 hours</option>
                <option value="week">Within a week</option>
                <option value="flexible">Flexible timing</option>
            </select>

            <button type="submit" class="mt-2">📤 Submit Query</button>
        </form>

        <div style="text-align: center; margin-top: 25px; color: #666; font-size: 0.9em;">
            <p>🕒 Our academic support team typically responds within 24-48 hours during working days.</p>
            <p>For urgent matters, please mark your query as "High Priority"</p>
        </div>
    </div>

</body>
</html>