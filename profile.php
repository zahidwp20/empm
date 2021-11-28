<?php

include 'header.php';


?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">My Profile</h1>
                </div>

                <form action="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="FirstName" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="FirstName" placeholder="John">
                            </div>

                            <div class="mb-3">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="Password" placeholder="****">
                            </div>

                            <div class="mb-3">
                                <label for="PhoneNumber" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" id="PhoneNumber" placeholder="01xxxxxxxxx">
                            </div>

                            <div class="mb-3">
                                <label for="StreetAddress" class="form-label">Street Address</label>
                                <textarea class="form-control" rows="1" name="street_address" id="StreetAddress" placeholder="95/5 Park Street"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="ZipCode" class="form-label">Zip Code</label>
                                <input type="text" name="zipcode" class="form-control" id="ZipCode" placeholder="73001">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>

                                <div class="form-check">
                                    <label class="form-check-label" for="GenderMale">Male</label>
                                    <input class="form-check-input" type="radio" id="GenderMale" name="gender" value="male">
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="GenderFemale">Female</label>
                                    <input class="form-check-input" type="radio" id="GenderFemale" name="gender" value="female">
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="GenderOthers">Others</label>
                                    <input class="form-check-input" type="radio" id="GenderOthers" name="gender" value="others">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Salary" class="form-label">Salary (BDT)</label>
                                <input type="number" name="salary" class="form-control" id="Salary" placeholder="25000">
                            </div>


                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="LastName" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="LastName" placeholder="Doe">
                            </div>

                            <div class="mb-3">
                                <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="ConfirmPassword" placeholder="****">
                            </div>

                            <div class="mb-3">
                                <label for="Designation" class="form-label">Designation</label>
                                <select class="form-select" name="designation" id="Designation">
                                    <option value="">Select Designation</option>
                                    <option value="hr-admin">HR/Admin</option>
                                    <option value="designer">UI Designer</option>
                                    <option value="developer">Developer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="CityName" class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="CityName" placeholder="New Town">
                            </div>

                            <div class="mb-3">
                                <label for="Country" class="form-label">Country</label>
                                <select class="form-select" name="country" id="Country">
                                    <option value="">Select Country</option>
                                    <option value="bd">Bangladesh</option>
                                    <option value="usa">USA</option>
                                    <option value="uk">UK</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Religion</label>

                                <div class="form-check">
                                    <label class="form-check-label" for="ReligionIslam">Islam</label>
                                    <input class="form-check-input" type="radio" id="ReligionIslam" name="religion" value="islam">
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="ReligionHinduism">Hinduism</label>
                                    <input class="form-check-input" type="radio" id="ReligionHinduism" name="religion" value="hinduism">
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="ReligionCristian">Cristian</label>
                                    <input class="form-check-input" type="radio" id="ReligionCristian" name="religion" value="cristian">
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="ReligionOthers">Others</label>
                                    <input class="form-check-input" type="radio" id="ReligionOthers" name="religion" value="others">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </main>
        </div>
    </div>

<?php


include 'footer.php';
