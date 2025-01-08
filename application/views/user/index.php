                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>

                    <div class="card " style="width: 18rem;">
                    <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Profile">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?=$profile['name']?></h5>
                        <span class="badge badge-dark p-1 mb-2"><?=$profile['status']?></span>
                        <p class="card-text my-1"><a href="<?=$profile['portofolio']?>">
                            <?=$profile['portofolio']?>
                        </a></p>
                        <p class="card-text m-0">IPK: <?=$profile['ipk']?></p>
                        <p class="card-text m-0 mb-3"><?=$profile['about']?></p>
                        <a href="<?=base_url('user/edit')?>" class="btn btn-primary mt-auto">Detail</a>
                    </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->         