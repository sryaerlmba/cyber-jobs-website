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
                        <h5 class="card-title"><?=$user['name']?></h5>
                        <p class="card-text my-1"><?=$user['email']?></p>
                        <p class="card-text m-0"></p>
                        <p class="card-text m-0 mb-3"></p>
                        <a href="<?=base_url('company/editProfile')?>" class="btn btn-primary mt-auto">Edit Profile</a>
                    </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>  
            <!-- End of Main Content -->         