<div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

        <?=$this->session->flashdata('message')?>

        <div class="row">
            <?php foreach($posts as $post) : ?>
                <div class="col-md-3 col-sm-12 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $post['image']; ?>" alt="Profile" style="height: 200px; object-fit: cover;">
                            <h5 class="card-title"><?= $post['title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Rp. <?= number_format($post['salary'], 0, ',', '.') ?></h6>
                            <p class="card-text"><?= $post['short_description'] ?></p>
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> <?= $post['location'] ?>
                                </small>
                            </p>
                            <div class="mt-3">
                                <a href="<?=base_url('company/editPost/')?><?=$post['id']?>" class="btn btn-sm btn-primary">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?=$post['id']?>">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Posted: <?= date('d F Y', $post['date_created']) ?></small>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi Delete untuk setiap post -->
                <div class="modal fade" id="deleteModal<?=$post['id']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to delete this "<?=$post['title']?>" post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a href="<?=base_url('admin/deletePost/')?><?=$post['id']?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>  

    
</div>