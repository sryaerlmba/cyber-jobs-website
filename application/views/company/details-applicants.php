<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message') ?>
    <form action="" method="post">
        <input type="hidden" value="<?= $apply['application_id'] ?>" name="id">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <h5 class="font-weight-bold"></h5>
                            <p><i class="fas fa-user"></i> <?= $apply['name'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Email:</h5>
                            <p><?= $apply['email'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">About:</h5>
                            <p><?= $apply['about'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">GPA:</h5>
                            <p><i class=""></i> <?= $apply['ipk'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Status:</h5>
                            <p><?= $apply['status'] ?></p>
                        </div>

                        <div class="mb-3">
                            <h5 class="font-weight-bold">CV:</h5>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="border rounded p-2 bg-white">
                                        <?php if ($apply['cv']) : ?>
                                            <a href="<?= base_url('assets/cv/' . $apply['cv']) ?>" download class="text-decoration-none text-truncate d-block"><?= $apply['cv'] ?></a>
                                        <?php else: ?>
                                            <span class="text-muted">No CV uploaded</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5 class="font-weight-bold">Application Letter:</h5>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="border rounded p-2 bg-white">
                                        <a href="<?= base_url('assets/applitcation_letters/' . $apply['app_letter']) ?>" download class="text-decoration-none text-truncate d-block"><?= $apply['app_letter'] ?></a>    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5 class="font-weight-bold">job Title</h5>
                            <p><?= $apply['title'] ?></p>
                        </div>
                        <div class="mb-3">
                            <h5 class="font-weight-bold">Job Details:</h5>
                            <p><?= $apply['details'] ?></p>
                        </div>

                        <div class="mb-3">
                            <h5 class="font-weight-bold">Apply Status</h5>
                            <select class="form-control col-sm-3" name="status">
                                <option value="pending" <?= $apply['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="accepted" <?= $apply['status'] == 'accepted' ? 'selected' : ''; ?>>Accepted</option>
                                <option value="rejected" <?= $apply['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                            </select>
                            <?= form_error('status', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <h5 class="font-weight-bold">Message Box:</h5>
                            <textarea class="form-control" rows="3" placeholder="Leave a message for the applicant..." name="message"></textarea>
                            <?= form_error('message', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">applied date: <?= date('d F Y', $apply['application_date_created']) ?></small>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                update
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>