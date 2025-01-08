    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="row">
            <?php foreach ($apply as $application): ?>
                <div class="col-md-4 mb-4 ">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold"><?= htmlspecialchars($application['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($application['short_description']) ?></p>
                            <p class="card-text">Your name: <?= htmlspecialchars($application['name']) ?></p>
                            <p class="card-text">Company: <?= htmlspecialchars($application['company']) ?></p>
                            <?php if($application['status'] == 'pending'): ?>
                                <p class="card-text">Status: <span class="badge badge-warning my-0"><?= htmlspecialchars($application['status']) ?></span></p>
                            <?php elseif($application['status'] == 'accepted'): ?>
                                <p class="card-text">Status: <span class="badge badge-success my-0"><?= htmlspecialchars($application['status']) ?></span></p>
                            <?php else: ?>
                                <p class="card-text">Status: <span class="badge badge-danger my-0"><?= htmlspecialchars($application['status']) ?></span></p>
                            <?php endif; ?>
                            <p class="card-text">Application Date: <?= date('F j, Y', $application['date_created']) ?></p>
                            <p class="card-text"><?= htmlspecialchars($application['message']) ?></p>

                            <a class="btn btn-primary" href="<?= base_url('jobPortals/viewPost/') . $application['post_id'] . '/' . 'details' ?>">details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>