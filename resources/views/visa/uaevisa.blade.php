@extends('common.layout')
@section('content')

<style>


/* visa form */
/* Form Container */
.form-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px;
  background: #f8f9fa;
  min-height: 100vh;
}

/* Navigation Buttons */
.nav-buttons {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-bottom: 40px;
  flex-wrap: wrap;
}

.nav-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  border-radius: 50px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 2px solid transparent;
  font-size: 14px;
  white-space: nowrap;
}

.btn-inactive {
  background: white;
  color: #6c757d;
  border-color: #E0E7F0;
}

.btn-inactive:hover {
  background: #f8f9fa;
  color: #495057;
  border-color: #6c757d;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
}

.btn-active {
  background: linear-gradient(135deg, #0052FE, #0041CC);
  color: white;
  border-color: #0052FE;
  box-shadow: 0 5px 15px rgba(0, 82, 254, 0.3);
}

.btn-active:hover {
  background: linear-gradient(135deg, #0041CC, #0052FE);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 82, 254, 0.4);
}

/* Form Header */
.form-container h1 {
  font-size: 36px;
  font-weight: 700;
  color: #333;
  margin-bottom: 20px;
}

/* UAE Flag Colors */
.uae-flag-colors {
  display: flex;
  height: 8px;
  width: 200px;
  margin: 20px auto;
  border-radius: 4px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.red-stripe {
  background: #FF0000;
  flex: 1;
}

.green-stripe {
  background: #00FF00;
  flex: 1;
}

.white-stripe {
  background: #FFFFFF;
  flex: 1;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}

.black-stripe {
  background: #000000;
  flex: 1;
}

.text-muted {
  color: #6c757d !important;
  font-size: 16px;
  margin-bottom: 40px;
}

/* Form Styling */
#uaeVisaRequestForm {
  background: white;
  padding: 50px;
  border-radius: 20px;
  box-shadow: 0px 10px 50px 0 rgba(0, 0, 0, 0.1);
  border: 1px solid #E6E6E6;
  position: relative;
}

#uaeVisaRequestForm::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #0052FE, #6c757d);
  border-radius: 20px 20px 0 0;
}

/* Section Titles */
.section-title {
  background: linear-gradient(135deg, #0052FE, #0041CC);
  color: white;
  padding: 20px 30px;
  margin: 40px -50px 30px -50px;
  position: relative;
  overflow: hidden;
}

.section-title:first-child {
  margin-top: 0;
}

.section-title::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
  animation: shimmer 3s infinite;
}

@keyframes shimmer {
  0% { left: -100%; }
  100% { left: 100%; }
}

.section-title h4 {
  font-size: 20px;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  margin: 0;
}

/* Sub-sections */
.sub-section {
  background: linear-gradient(135deg, #f8f9ff, #f0f8ff);
  border: 2px solid rgba(0, 82, 254, 0.1);
  border-radius: 15px;
  padding: 25px;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
}

.sub-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, #0052FE, #6c757d);
}

.sub-section h5 {
  font-size: 18px;
  font-weight: 700;
  color: #0052FE;
  margin-bottom: 20px;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Form Controls */
.form-label {
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
  font-size: 14px;
}

.required-field::after {
  content: ' *';
  color: #dc3545;
  font-weight: 700;
}

.form-control,
.form-select {
  padding: 15px;
  border: 2px solid #E0E7F0;
  border-radius: 10px;
  font-size: 16px;
  background: white;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.form-control:focus,
.form-select:focus {
  outline: none;
  border-color: #0052FE;
  box-shadow: 0 0 0 3px rgba(0, 82, 254, 0.1), 0 4px 15px rgba(0, 82, 254, 0.1);
  transform: translateY(-2px);
}

.form-control:valid {
  border-color: #28a745;
}

.form-control:invalid {
  border-color: #dc3545;
}

/* Radio Buttons */
.form-check {
  margin-bottom: 15px;
  padding: 15px 20px;
  background: #f8f9fa;
  border-radius: 10px;
  border: 2px solid transparent;
  transition: all 0.3s ease;
  cursor: pointer;
}

.form-check:hover {
  background: linear-gradient(135deg, #f8f9ff, #f0f8ff);
  border-color: rgba(0, 82, 254, 0.2);
}

.form-check-input {
  width: 20px;
  height: 20px;
  margin-right: 12px;
  cursor: pointer;
}

.form-check-input:checked {
  background-color: #0052FE;
  border-color: #0052FE;
}

.form-check-label {
  font-size: 16px;
  font-weight: 500;
  color: #333;
  cursor: pointer;
}

/* File Upload Styling */
.custom-file-upload {
  position: relative;
}

.custom-file-upload .input-group {
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.custom-file-upload .input-group-text {
  background: linear-gradient(135deg, #0052FE, #0041CC);
  color: white;
  border: none;
  padding: 15px 20px;
  font-weight: 600;
}

.upload-icon {
  font-size: 16px;
}

.custom-file-upload input[type="file"] {
  border-left: none;
  background: white;
}

.custom-file-upload input[type="file"]:focus {
  border-left: none;
  box-shadow: 0 0 0 3px rgba(0, 82, 254, 0.1);
}

/* Input Groups */
.input-group-text {
  background: #f8f9fa;
  border: 2px solid #E0E7F0;
  border-right: none;
  color: #6c757d;
  font-weight: 600;
  padding: 15px;
}

.input-group .form-control {
  border-left: none;
}

.input-group .form-control:focus {
  border-left: none;
}

/* Agreement Box */
.agreement-box {
  background: linear-gradient(135deg, #f0f8ff, #e6f3ff);
  border: 2px solid #0052FE;
  border-radius: 15px;
  padding: 25px;
  margin: 40px 0;
  position: relative;
}

.agreement-box::before {
  content: '⚠️';
  position: absolute;
  top: -15px;
  left: 25px;
  background: white;
  padding: 0 10px;
  font-size: 20px;
}

.agreement-box .form-check {
  background: transparent;
  border: none;
  padding: 0;
  margin: 0;
}

.agreement-box .form-check-label {
  font-size: 16px;
  font-weight: 600;
  color: #0052FE;
  line-height: 1.5;
}

/* Submit Button */
.btn-primary.btn-lg {
  background: linear-gradient(135deg, #0052FE, #0041CC);
  border: 3px solid #0052FE;
  border-radius: 50px;
  padding: 18px 50px;
  font-size: 18px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  box-shadow: 0 8px 25px rgba(0, 82, 254, 0.3);
  position: relative;
  overflow: hidden;
}

.btn-primary.btn-lg::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.6s ease;
}

.btn-primary.btn-lg:hover::before {
  left: 100%;
}

.btn-primary.btn-lg:hover {
  background: white;
  color: #0052FE;
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(0, 82, 254, 0.4);
}

/* Form Validation Feedback */
.was-validated .form-control:invalid,
.form-control.is-invalid {
  border-color: #dc3545;
  box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.was-validated .form-control:valid,
.form-control.is-valid {
  border-color: #28a745;
  box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

.invalid-feedback {
  display: block;
  color: #dc3545;
  font-size: 14px;
  font-weight: 500;
  margin-top: 5px;
}

.valid-feedback {
  display: block;
  color: #28a745;
  font-size: 14px;
  font-weight: 500;
  margin-top: 5px;
}

/* Responsive Design */
@media (max-width: 1200px) {
  .form-container {
    padding: 30px 15px;
  }
  
  #uaeVisaRequestForm {
    padding: 40px;
  }
  
  .section-title {
    margin-left: -40px;
    margin-right: -40px;
  }
}

@media (max-width: 992px) {
  .nav-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .nav-btn {
    width: 200px;
    justify-content: center;
  }
  
  .form-container h1 {
    font-size: 32px;
  }
  
  #uaeVisaRequestForm {
    padding: 30px;
  }
  
  .section-title {
    margin-left: -30px;
    margin-right: -30px;
    padding: 15px 20px;
  }
  
  .section-title h4 {
    font-size: 18px;
  }
}

@media (max-width: 768px) {
  .form-container {
    padding: 20px 10px;
  }
  
  .form-container h1 {
    font-size: 28px;
  }
  
  #uaeVisaRequestForm {
    padding: 20px;
  }
  
  .section-title {
    margin-left: -20px;
    margin-right: -20px;
    padding: 15px;
  }
  
  .section-title h4 {
    font-size: 16px;
  }
  
  .sub-section {
    padding: 20px;
  }
  
  .sub-section h5 {
    font-size: 16px;
  }
  
  .form-control,
  .form-select {
    padding: 12px;
    font-size: 14px;
  }
  
  .nav-btn {
    width: 100%;
    margin-bottom: 10px;
  }
  
  .uae-flag-colors {
    width: 150px;
  }
}

@media (max-width: 576px) {
  .form-container h1 {
    font-size: 24px;
  }
  
  .text-muted {
    font-size: 14px;
  }
  
  .btn-primary.btn-lg {
    padding: 15px 30px;
    font-size: 16px;
    width: 100%;
  }
  
  .agreement-box {
    padding: 20px;
  }
  
  .meta-item {
    flex-direction: column;
    text-align: center;
  }
  
  .uae-flag-colors {
    width: 120px;
    height: 6px;
  }
}

/* Loading States */
.form-control:focus {
  animation: focusGlow 0.3s ease-out;
}

@keyframes focusGlow {
  0% { transform: scale(1); }
  50% { transform: scale(1.02); }
  100% { transform: scale(1); }
}

/* Success States */
.form-submitted {
  opacity: 0.7;
  pointer-events: none;
}

.form-submitted .btn-primary.btn-lg {
  background: #28a745;
  border-color: #28a745;
}

.form-submitted .btn-primary.btn-lg::after {
  content: ' ✓';
}

/* Print Styles */
@media print {
  .nav-buttons,
  .btn-primary {
    display: none;
  }
  
  .form-container {
    padding: 0;
    background: white;
  }
  
  #uaeVisaRequestForm {
    box-shadow: none;
    border: 1px solid #ccc;
    padding: 20px;
  }
  
  .section-title {
    background: #f8f9fa !important;
    color: #333 !important;
    margin-left: 0;
    margin-right: 0;
  }
}

/* end visa form */
</style>


        <div class="form-container">
        <div class="nav-buttons">
                <a href="{{ url('/') }}" class="btn nav-btn btn-inactive">
                    <i class="fas fa-home me-2"></i>Home
                </a>
                <a href="{{route('visa.create')}}" class="btn nav-btn {{ request()->is('visa-form') ? 'btn-active' : '' }}">
                    <i class="fas fa-passport me-2"></i>UAE VISA
                </a>
                <a href="{{route('visa.othervisa')}}" class="btn nav-btn {{ request()->is('other-visa') ? 'btn-active' : '' }}">
                    <i class="fas fa-globe me-2"></i>OTHER VISA
                </a>
            </div>

            <div class="text-center mb-4">
                <h1 class="display-6">UAE VISA REQUEST FORM</h1>
                <div class="uae-flag-colors">
                    <div class="red-stripe"></div>
                    <div class="green-stripe"></div>
                    <div class="white-stripe"></div>
                    <div class="black-stripe"></div>
                </div>
                <p class="text-muted">Please complete all required fields marked with *</p>
            </div>
            
            <form id="uaeVisaRequestForm" class="needs-validation" novalidate method="POST" novalidate action="{{ route('visa.store') }}" enctype="multipart/form-data">
            @csrf
                <!-- Visa Type Selection Section -->
                <div class="section-title">
                    <h4 class="m-0">TYPE OF VISA REQUIRED</h4>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="sub-section">
                            <h5>NORMAL</h5>
                            <div class="mb-3">
                                <label for="normalPlan" class="form-label">Select Plan</label>
                                <select class="form-select" id="normalPlan" name="visa_plan">
                                    <option value="">Select Plan</option>
                                    <option value="15days">15 DAYS VISA</option>
                                    <option value="30days">30 DAYS VISA</option>
                                    <option value="90days">90 DAYS VISA</option>
                                    <option value="150days">150 DAYS VISA</option>
                                    <option value="180days">180 DAYS VISA</option>
                                    <option value="multiShort">Multi Entry Short Term</option>
                                    <option value="multiLong">Multi Entry Long Term</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sub-section">
                            <h5>URGENT</h5>
                            <div class="mb-3">
                                <label for="urgentPlan" class="form-label">Select Plan</label>
                                <select class="form-select" id="urgentPlan" name="visa_type">
                                    <option value="">Select Plan</option>
                                    <option value="15days">15 DAYS VISA</option>
                                    <option value="30days">30 DAYS VISA</option>
                                    <option value="90days">90 DAYS VISA</option>
                                    <option value="multiShort">Multi Entry Short Term</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Passenger Details Section -->
                <div class="section-title">
                    <h4 class="m-0">PASSENGER DETAILS</h4>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="firstName" class="form-label required-field">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middle_name">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="surname" class="form-label required-field">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="fathersName" class="form-label required-field">Father's Name</label>
                        <input type="text" class="form-control" id="fathersName" name="father_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mothersName" class="form-label required-field">Mother's Name</label>
                        <input type="text" class="form-control" id="mothersName" name="mother_name" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="placeBirth" class="form-label required-field">Place of Birth</label>
                        <input type="text" class="form-control" id="placeBirth" name="place_birth" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="occupation" class="form-label required-field">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="maritalStatus" class="form-label required-field">Marital Status</label>
                        <select class="form-select" id="maritalStatus" name="marital_status" required>
                            <option value="">Select Marital Status</option>
                            <option value="married">Married</option>
                            <option value="single">Single</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="religion" class="form-label required-field">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" required>
                    </div>
                  <div class="col-md-8 mb-3">
                      <label for="nationality" class="form-label required-field">Nationality</label>
                      <select class="form-select" id="nationality" name="nationality" required>
                          <option value="">Select Nationality</option>
                          <option value="Afghanistan">Afghanistan</option>
                          <option value="Albania">Albania</option>
                          <option value="Algeria">Algeria</option>
                          <option value="Andorra">Andorra</option>
                          <option value="Angola">Angola</option>
                          <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                          <option value="Argentina">Argentina</option>
                          <option value="Armenia">Armenia</option>
                          <option value="Australia">Australia</option>
                          <option value="Austria">Austria</option>
                          <option value="Azerbaijan">Azerbaijan</option>
                          <option value="Bahamas">Bahamas</option>
                          <option value="Bahrain">Bahrain</option>
                          <option value="Bangladesh">Bangladesh</option>
                          <option value="Barbados">Barbados</option>
                          <option value="Belarus">Belarus</option>
                          <option value="Belgium">Belgium</option>
                          <option value="Belize">Belize</option>
                          <option value="Benin">Benin</option>
                          <option value="Bhutan">Bhutan</option>
                          <option value="Bolivia">Bolivia</option>
                          <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                          <option value="Botswana">Botswana</option>
                          <option value="Brazil">Brazil</option>
                          <option value="Brunei">Brunei</option>
                          <option value="Bulgaria">Bulgaria</option>
                          <option value="Burkina Faso">Burkina Faso</option>
                          <option value="Burundi">Burundi</option>
                          <option value="Cabo Verde">Cabo Verde</option>
                          <option value="Cambodia">Cambodia</option>
                          <option value="Cameroon">Cameroon</option>
                          <option value="Canada">Canada</option>
                          <option value="Central African Republic">Central African Republic</option>
                          <option value="Chad">Chad</option>
                          <option value="Chile">Chile</option>
                          <option value="China">China</option>
                          <option value="Colombia">Colombia</option>
                          <option value="Comoros">Comoros</option>
                          <option value="Congo">Congo</option>
                          <option value="Costa Rica">Costa Rica</option>
                          <option value="Croatia">Croatia</option>
                          <option value="Cuba">Cuba</option>
                          <option value="Cyprus">Cyprus</option>
                          <option value="Czech Republic">Czech Republic</option>
                          <option value="Denmark">Denmark</option>
                          <option value="Djibouti">Djibouti</option>
                          <option value="Dominica">Dominica</option>
                          <option value="Dominican Republic">Dominican Republic</option>
                          <option value="Ecuador">Ecuador</option>
                          <option value="Egypt">Egypt</option>
                          <option value="El Salvador">El Salvador</option>
                          <option value="Equatorial Guinea">Equatorial Guinea</option>
                          <option value="Eritrea">Eritrea</option>
                          <option value="Estonia">Estonia</option>
                          <option value="Eswatini">Eswatini</option>
                          <option value="Ethiopia">Ethiopia</option>
                          <option value="Fiji">Fiji</option>
                          <option value="Finland">Finland</option>
                          <option value="France">France</option>
                          <option value="Gabon">Gabon</option>
                          <option value="Gambia">Gambia</option>
                          <option value="Georgia">Georgia</option>
                          <option value="Germany">Germany</option>
                          <option value="Ghana">Ghana</option>
                          <option value="Greece">Greece</option>
                          <option value="Grenada">Grenada</option>
                          <option value="Guatemala">Guatemala</option>
                          <option value="Guinea">Guinea</option>
                          <option value="Guinea-Bissau">Guinea-Bissau</option>
                          <option value="Guyana">Guyana</option>
                          <option value="Haiti">Haiti</option>
                          <option value="Honduras">Honduras</option>
                          <option value="Hungary">Hungary</option>
                          <option value="Iceland">Iceland</option>
                          <option value="India">India</option>
                          <option value="Indonesia">Indonesia</option>
                          <option value="Iran">Iran</option>
                          <option value="Iraq">Iraq</option>
                          <option value="Ireland">Ireland</option>
                          <option value="Israel">Israel</option>
                          <option value="Italy">Italy</option>
                          <option value="Ivory Coast">Ivory Coast</option>
                          <option value="Jamaica">Jamaica</option>
                          <option value="Japan">Japan</option>
                          <option value="Jordan">Jordan</option>
                          <option value="Kazakhstan">Kazakhstan</option>
                          <option value="Kenya">Kenya</option>
                          <option value="Kiribati">Kiribati</option>
                          <option value="Kosovo">Kosovo</option>
                          <option value="Kuwait">Kuwait</option>
                          <option value="Kyrgyzstan">Kyrgyzstan</option>
                          <option value="Laos">Laos</option>
                          <option value="Latvia">Latvia</option>
                          <option value="Lebanon">Lebanon</option>
                          <option value="Lesotho">Lesotho</option>
                          <option value="Liberia">Liberia</option>
                          <option value="Libya">Libya</option>
                          <option value="Liechtenstein">Liechtenstein</option>
                          <option value="Lithuania">Lithuania</option>
                          <option value="Luxembourg">Luxembourg</option>
                          <option value="Madagascar">Madagascar</option>
                          <option value="Malawi">Malawi</option>
                          <option value="Malaysia">Malaysia</option>
                          <option value="Maldives">Maldives</option>
                          <option value="Mali">Mali</option>
                          <option value="Malta">Malta</option>
                          <option value="Marshall Islands">Marshall Islands</option>
                          <option value="Mauritania">Mauritania</option>
                          <option value="Mauritius">Mauritius</option>
                          <option value="Mexico">Mexico</option>
                          <option value="Micronesia">Micronesia</option>
                          <option value="Moldova">Moldova</option>
                          <option value="Monaco">Monaco</option>
                          <option value="Mongolia">Mongolia</option>
                          <option value="Montenegro">Montenegro</option>
                          <option value="Morocco">Morocco</option>
                          <option value="Mozambique">Mozambique</option>
                          <option value="Myanmar">Myanmar</option>
                          <option value="Namibia">Namibia</option>
                          <option value="Nauru">Nauru</option>
                          <option value="Nepal">Nepal</option>
                          <option value="Netherlands">Netherlands</option>
                          <option value="New Zealand">New Zealand</option>
                          <option value="Nicaragua">Nicaragua</option>
                          <option value="Niger">Niger</option>
                          <option value="Nigeria">Nigeria</option>
                          <option value="North Korea">North Korea</option>
                          <option value="North Macedonia">North Macedonia</option>
                          <option value="Norway">Norway</option>
                          <option value="Oman">Oman</option>
                          <option value="Pakistan">Pakistan</option>
                          <option value="Palau">Palau</option>
                          <option value="Palestine">Palestine</option>
                          <option value="Panama">Panama</option>
                          <option value="Papua New Guinea">Papua New Guinea</option>
                          <option value="Paraguay">Paraguay</option>
                          <option value="Peru">Peru</option>
                          <option value="Philippines">Philippines</option>
                          <option value="Poland">Poland</option>
                          <option value="Portugal">Portugal</option>
                          <option value="Qatar">Qatar</option>
                          <option value="Romania">Romania</option>
                          <option value="Russia">Russia</option>
                          <option value="Rwanda">Rwanda</option>
                          <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                          <option value="Saint Lucia">Saint Lucia</option>
                          <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                          <option value="Samoa">Samoa</option>
                          <option value="San Marino">San Marino</option>
                          <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                          <option value="Saudi Arabia">Saudi Arabia</option>
                          <option value="Senegal">Senegal</option>
                          <option value="Serbia">Serbia</option>
                          <option value="Seychelles">Seychelles</option>
                          <option value="Sierra Leone">Sierra Leone</option>
                          <option value="Singapore">Singapore</option>
                          <option value="Slovakia">Slovakia</option>
                          <option value="Slovenia">Slovenia</option>
                          <option value="Solomon Islands">Solomon Islands</option>
                          <option value="Somalia">Somalia</option>
                          <option value="South Africa">South Africa</option>
                          <option value="South Korea">South Korea</option>
                          <option value="South Sudan">South Sudan</option>
                          <option value="Spain">Spain</option>
                          <option value="Sri Lanka">Sri Lanka</option>
                          <option value="Sudan">Sudan</option>
                          <option value="Suriname">Suriname</option>
                          <option value="Sweden">Sweden</option>
                          <option value="Switzerland">Switzerland</option>
                          <option value="Syria">Syria</option>
                          <option value="Taiwan">Taiwan</option>
                          <option value="Tajikistan">Tajikistan</option>
                          <option value="Tanzania">Tanzania</option>
                          <option value="Thailand">Thailand</option>
                          <option value="Timor-Leste">Timor-Leste</option>
                          <option value="Togo">Togo</option>
                          <option value="Tonga">Tonga</option>
                          <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                          <option value="Tunisia">Tunisia</option>
                          <option value="Turkey">Turkey</option>
                          <option value="Turkmenistan">Turkmenistan</option>
                          <option value="Tuvalu">Tuvalu</option>
                          <option value="Uganda">Uganda</option>
                          <option value="Ukraine">Ukraine</option>
                          <option value="United Arab Emirates">United Arab Emirates</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="United States">United States</option>
                          <option value="Uruguay">Uruguay</option>
                          <option value="Uzbekistan">Uzbekistan</option>
                          <option value="Vanuatu">Vanuatu</option>
                          <option value="Vatican City">Vatican City</option>
                          <option value="Venezuela">Venezuela</option>
                          <option value="Vietnam">Vietnam</option>
                          <option value="Yemen">Yemen</option>
                          <option value="Zambia">Zambia</option>
                          <option value="Zimbabwe">Zimbabwe</option>
                      </select>
                  </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="passportNo" class="form-label required-field">Passport No</label>
                        <input type="text" class="form-control" id="passportNo" name="passport_no" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dateIssue" class="form-label required-field">Date of Issue</label>
                        <input type="date" class="form-control" id="dateIssue" name="passport_issue_date" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dateExpiry" class="form-label required-field">Date of Expiry</label>
                        <input type="date" class="form-control" id="dateExpiry" name="passport_expiry_date" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label required-field">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                </div>
                
                <!-- Document Upload Section -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="passportFront" class="form-label required-field">Upload Passport Front Image</label>
                        <div class="custom-file-upload">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload upload-icon"></i></span>
                                <input type="file" class="form-control" id="passportFront" name="passport_front" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="passportBack" class="form-label required-field">Upload Passport Back Image</label>
                        <div class="custom-file-upload">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload upload-icon"></i></span>
                                <input type="file" class="form-control" id="passportBack" name="passport_back" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="passportSize" class="form-label required-field">Upload Passport Size Image</label>
                        <div class="custom-file-upload">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload upload-icon"></i></span>
                                <input type="file" class="form-control" id="passportSize" name="passport_photo" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="additionalDoc" class="form-label">Upload Additional Document</label>
                        <div class="custom-file-upload">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload upload-icon"></i></span>
                                <input type="file" class="form-control" id="additionalDoc" name="other_document">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Guarantor Details Section -->
                <div class="section-title mt-5">
                    <h4 class="m-0">GUARANTOR DETAILS</h4>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="guarantorFirstName" class="form-label required-field">First Name</label>
                        <input type="text" class="form-control" id="guarantorFirstName" name="guarantor_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="guarantorNationality" class="form-label required-field">Nationality</label>
                        <select class="form-select" id="guarantorNationality" name="guarantor_nationality" required>
                            <option value="">Select Nationality</option>
<option value="">Select Nationality</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Brazil">Brazil</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cabo Verde">Cabo Verde</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo">Congo</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Eswatini">Eswatini</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Greece">Greece</option>
        <option value="Grenada">Grenada</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea">Guinea</option>
        <option value="Guinea-Bissau">Guinea-Bissau</option>
        <option value="Guyana">Guyana</option>
        <option value="Haiti">Haiti</option>
        <option value="Honduras">Honduras</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran">Iran</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Ivory Coast">Ivory Coast</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Kosovo">Kosovo</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Laos">Laos</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
        <option value="Liberia">Liberia</option>
        <option value="Libya">Libya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malawi">Malawi</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mexico">Mexico</option>
        <option value="Micronesia">Micronesia</option>
        <option value="Moldova">Moldova</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Montenegro">Montenegro</option>
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Namibia">Namibia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands">Netherlands</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
        <option value="Nigeria">Nigeria</option>
        <option value="North Korea">North Korea</option>
        <option value="North Macedonia">North Macedonia</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Palau">Palau</option>
        <option value="Palestine">Palestine</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Qatar">Qatar</option>
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Rwanda">Rwanda</option>
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
        <option value="Saint Lucia">Saint Lucia</option>
        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
        <option value="Samoa">Samoa</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Senegal">Senegal</option>
        <option value="Serbia">Serbia</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="South Korea">South Korea</option>
        <option value="South Sudan">South Sudan</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syria">Syria</option>
        <option value="Taiwan">Taiwan</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania">Tanzania</option>
        <option value="Thailand">Thailand</option>
        <option value="Timor-Leste">Timor-Leste</option>
        <option value="Togo">Togo</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
        <option value="Tunisia">Tunisia</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Tuvalu">Tuvalu</option>
        <option value="Uganda">Uganda</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Arab Emirates">United Arab Emirates</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
        <option value="Uruguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
        <option value="Vatican City">Vatican City</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Vietnam">Vietnam</option>
        <option value="Yemen">Yemen</option>
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="relationWithPassenger" class="form-label required-field">Relation with Passenger</label>
                        <input type="text" class="form-control" id="relationWithPassenger" name="guarantor_relation" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emiratesIdNo" class="form-label required-field">Emirates ID No</label>
                        <input type="text" class="form-control" id="emiratesIdNo" name="guarantor_emirates_id" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="guarantorPassportNo" class="form-label required-field">Passport Number</label>
                        <input type="text" class="form-control" id="guarantorPassportNo" name="guarantor_passport_no" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employerCompanyName" class="form-label required-field">Employer/Company Name</label>
                        <input type="text" class="form-control" id="employerCompanyName" name="employer_name" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="companyContact" class="form-label required-field">Company Contact</label>
                        <input type="text" class="form-control" id="companyContact" name="company_contact" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="visaNo" class="form-label required-field">Visa No</label>
                        <input type="text" class="form-control" id="visaNo" name="guarantor_visa_no" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="visaExpiry" class="form-label required-field">Visa Expiry</label>
                        <input type="date" class="form-control" id="visaExpiry" name="guarantor_visa_expiry" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="mobileNumber" class="form-label required-field">Mobile Number</label>
                        <input type="tel" class="form-control" id="mobileNumber" name="guarantor_mobile" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label required-field">Email</label>
                        <input type="email" class="form-control" id="email" name="guarantor_email" required>
                    </div>
                </div>
                
                <!-- Payment Receipt Details Section -->
                <div class="section-title mt-5">
                    <h4 class="m-0">PAYMENT RECEIPT DETAILS</h4>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="receiptNo" class="form-label">Receipt No</label>
                        <input type="text" class="form-control" id="receiptNo" name="receipt_no">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">AED</span>
                            <input type="number" class="form-control" id="amount" name="receipt_amount">
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="paymentDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="paymentDate" name="receipt_date">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="visaPayment" class="form-label">Visa Payment</label>
                        <div class="input-group">
                            <span class="input-group-text">AED</span>
                            <input type="number" class="form-control" id="visaPayment" name="visa_payment_date">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="ticketOtb" class="form-label">Ticket/OTB</label>
                        <input type="text" class="form-control" id="ticketOtb" name="ticket_otb_date">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="securityDeposit" class="form-label">Security Deposit</label>
                        <div class="input-group">
                            <span class="input-group-text">AED</span>
                            <input type="number" class="form-control" id="securityDeposit" name="security_deposit_date">
                        </div>
                    </div>
                </div>
                
                <!-- Agreement Section -->
                <div class="agreement-box">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" required name="agreed_terms">
                        <label class="form-check-label" for="agreeTerms">
                            I/we agree to terms & conditions, visa fee and service charges applicable
                        </label>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg">Submit Visa Application</button>
                </div>
            </form>
        </div>

    
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('uaeVisaRequestForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting Application...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showSuccessMessage();
                    
                    // Redirect after 3 seconds
                    setTimeout(() => {
                        window.location.href = data.redirect_url || '{{ route("visa.success") }}';
                    }, 3000);
                } else {
                    throw new Error(data.message || 'Submission failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting your application. Please try again.');
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
});

function showSuccessMessage() {
    const successHtml = `
        <div style="text-align: center; padding: 50px; background: white; border-radius: 20px; box-shadow: 0px 10px 50px 0 rgba(0, 0, 0, 0.1);">
            <div style="margin-bottom: 20px;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; animation: bounce 0.6s ease-out;">
                    <i class="fas fa-check" style="color: white; font-size: 40px;"></i>
                </div>
            </div>
            <h2 style="color: #28a745; margin-bottom: 20px; font-size: 32px; font-weight: 700;">UAE Visa Application Submitted!</h2>
            <p style="font-size: 18px; margin-bottom: 30px; color: #666;">
                Thank you! Your UAE visa application has been submitted successfully.<br>
                Our team will contact you within 24 hours.
            </p>
            <div style="background: linear-gradient(135deg, #e8f5e8, #d4edda); padding: 20px; border-radius: 15px; margin: 20px 0;">
                <div style="display: flex; justify-content: space-around; text-align: center;">
                    <div>
                        <i class="fas fa-clock" style="color: #28a745; font-size: 24px; margin-bottom: 10px;"></i>
                        <div style="font-weight: 600; color: #28a745;">Processing Time</div>
                        <div style="font-size: 14px; color: #666;">2-3 Business Days</div>
                    </div>
                    <div>
                        <i class="fas fa-envelope" style="color: #17a2b8; font-size: 24px; margin-bottom: 10px;"></i>
                        <div style="font-weight: 600; color: #17a2b8;">Email Confirmation</div>
                        <div style="font-size: 14px; color: #666;">Sent to your inbox</div>
                    </div>
                    <div>
                        <i class="fas fa-phone" style="color: #ffc107; font-size: 24px; margin-bottom: 10px;"></i>
                        <div style="font-weight: 600; color: #ffc107;">Contact Support</div>
                        <div style="font-size: 14px; color: #666;">24/7 Available</div>
                    </div>
                </div>
            </div>
            <p style="font-size: 14px; color: #999; margin-top: 20px;">
                <i class="fas fa-info-circle"></i> You will be redirected to the success page shortly...
            </p>
        </div>
    `;
    
    document.querySelector('.form-container').innerHTML = successHtml;
}
</script>
@endsection