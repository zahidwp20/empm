<?php
/**
 * Settings File
 */

include "header.php";

$form_submission = isset($_POST['form_submission']) ? $_POST['form_submission'] : '';

if ($form_submission === 'yes') :

    $_project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';
    $_timezone = isset($_POST['timezone']) ? $_POST['timezone'] : '';

    empm_update_option('project_name', $_project_name);
    empm_update_option('timezone', $_timezone);

    header('Location: settings.php');
    exit();

endif;


$project_name = empm_get_option('project_name');
$timezone = empm_get_option('timezone');


?>

    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Settings</h1>
                </div>

                <div class="container">
                    <div class="row">
                        <form action="" method="post">

                            <div class="mb-3 d-flex ">
                                <div class="col-md-3">
                                    <h5><label for="projectName">Project Name</label></h5>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" value="<?php echo $project_name; ?>" class="form-control" name="project_name" placeholder="Employee Manager" id="projectName">
                                </div>
                            </div>

                            <div class="mb-3 d-flex ">
                                <div class="col-md-3">
                                    <h5><label for="timezone">Timezone</label></h5>
                                </div>
                                <div class="col-md-3">
                                    <select class="mr-3 form-select select2" name="timezone" id="timezone">
                                        <option value="">Select Timezone</option>
                                        <?php foreach (empm_get_timezones() as $timezone_key => $timezone_label) : ?>

                                            <option <?php selected($timezone, $timezone_key); ?> value="<?php echo $timezone_key; ?>"><?php echo $timezone_label; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="row justify-content-start">
                                <div class="col-sm-8">
                                    <input type="hidden" name="form_submission" value="yes">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </main>
        </div>
    </div>

<?php
include "footer.php";
