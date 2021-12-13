<?php
/**
 * Footer template
 */
?>


    <!-- Edit User Modal Window -->
    <div class="modal fade" id="showViewWindow" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="user-info-wrap">
                        <div class="info-item">
                            <h4 class="info-label">User Name</h4>
                            <div class="info user_name"></div>
                        </div>
                        <div class="info-item">
                            <h4 class="info-label">First Name</h4>
                            <div class="info first_name"></div>
                        </div>
                        <div class="info-item">
                            <h4 class="info-label">Last Name</h4>
                            <div class="info last_name"></div>
                        </div>
                        <div class="info-item">
                            <h4 class="info-label">Email Address</h4>
                            <div class="info email_address"></div>
                        </div>
                        <div class="info-item">
                            <h4 class="info-label">Phone Number</h4>
                            <div class="info phone_number"></div>
                        </div>
                        <div class="info-item">
                            <h4 class="info-label">Designation</h4>
                            <div class="info designation"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    </body>
    </html>


<?php
mysqli_close($conn);
session_destroy();

