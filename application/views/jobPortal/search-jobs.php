    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

        <?= $this->session->flashdata('message') ?>

        <div class="row mb-4">
            <div class="col-sm-3">
                <form action="<?= base_url('jobPortals/searchJobs') ?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for jobs..." name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (empty($posts)): ?>
            <div class="row">
                <div class="col-sm-3">
                    <h3 class="">No job found</h3>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">

            <?php foreach ($posts as $post) : ?>
                <div class="col-md-3 col-sm-12 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body d-flex flex-column">
                            <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $post['image']; ?>" alt="Profile" style="height: 200px; object-fit: cover;">
                            <h5 class="card-title"><?= $post['title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Rp. <?= number_format($post['salary'], 0, ',', '.') ?></h6>
                            <p class="card-text"><?= $post['short_description'] ?></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> Lokasi: <?= $post['location'] ?>
                                </small>
                            </p>
                            <div class="mt-auto d-flex">
                                <a href="<?= base_url('jobPortals/viewPost/') ?><?= $post['id'] ?>" class="btn btn-sm btn-primary w-100">Detail</a>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Posted: <?= date('d F Y', $post['date_created']) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    </div>