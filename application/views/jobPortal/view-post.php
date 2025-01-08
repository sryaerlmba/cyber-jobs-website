    <div class="container-fluid">

    
        <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>
        <?=$this->session->flashdata('message')?>
        <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h3 mb-0 text-gray-800"><?= $post['title'] ?></h1>
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="<?= base_url('assets/img/profile/') . $post['image']; ?>" alt="Profile">
                    </div>
                    <div class="col-md-8">
                        
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Posted By:</h5>
                            <p><i class="fas fa-map-marker-alt"></i> <?= $post['name'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Salary:</h5>
                            <p>Rp. <?= number_format($post['salary'], 0, ',', '.') ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Location:</h5>
                            <p><i class="fas fa-map-marker-alt"></i> <?= $post['location'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Short Description:</h5>
                            <p><?= $post['short_description'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Job Details:</h5>
                            <p><?= $post['details'] ?></p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Posted: <?= date('d F Y', $post['date_created']) ?></small>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Apply this Job
                            </button>        
                        </div>

                        
                    </div>
                </div>
            </div>
    </div>
    </div>

    <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Application Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="<?=base_url('jobPortals/submitApplication/' . $post['id'])?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" value=" <?= $post['name'] ?>" name="company_name">
                                </div>
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?=$profile['name']?>" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?=$profile['email']?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="cv">CV (PDF)</label>
                                    <p><a href="<?= base_url('assets/cv/') . $profile['cv']; ?>" target="_blank"><?=$profile['cv']; ?></a></p>
                                </div>

                                <div class="form-group">
                                    <label for="portfolio">Portfolio Link</label>
                                    <input type="url" class="form-control" id="portfolio" name="portfolio" value="<?=$profile['portofolio']?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="ipk">IPK/GPA</label>
                                    <input type="text" class="form-control" id="ipk" name="ipk" value="<?=$profile['ipk']?>" readonly>
                                </div>


                                <div class="form-group">
                                    <label for="about">About Yourself</label>
                                    <textarea class="form-control" id="about" name="about" rows="4" readonly><?=$profile['about']?></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
   
</div>




