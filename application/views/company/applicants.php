<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?=$this->session->flashdata('message')?>
    <div class="row">
        <?php foreach ($apply as $app): ?>
            <div class="col-lg-3 mb-4"> <!-- Use col-lg-4 for equal width and mb-4 for margin-bottom -->
                <div class="card h-100"> <!-- Use h-100 to make all cards the same height -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="font-weight-bold"><?=$app['title']?></h5>
                        <h5 class="card-title fw-bold"><?= $app['name'] ?></h5>
                        <h5 class="card-title fw-bold"><?= $app['email'] ?></h5>
                        <a href="<?= base_url('assets/cv/') . $app['cv']; ?>" class="btn btn-info mt-auto" download>Download CV</a> <!-- Use mt-auto to push the button to the bottom -->
                        <a href="<?= base_url('company/detailsApplicants/') . $app['application_id'] ?>" class="btn btn-primary mt-2">Application Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>