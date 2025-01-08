                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

                    <div class="row">
                        <div class="col-lg-8">

                            <?php echo form_open_multipart('user/edit'); ?>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly> 
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Full name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                    <?=form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-2">Picture</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?=base_url('assets/img/profile/' . $user['image'])?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-2">CV</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="border rounded p-2 bg-white">
                                                <?php if($profile['cv']) : ?>
                                                    <a href="<?= base_url('assets/cv/' . $profile['cv']) ?>" download class="text-decoration-none text-truncate d-block"><?= $profile['cv'] ?></a>
                                                <?php else: ?>
                                                    <span class="text-muted">No CV uploaded</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="cv" name="cv">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Portfolio</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="portfolio" name="portofolio" value="<?=$profile['portofolio']?>">
                                    <?=form_error('portofolio', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Ipk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ipk" name="ipk" value="<?=$profile['ipk']?>">
                                    <?=form_error('ipk', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">status</label>
                                <div class="col-sm-10">
                                    <div class="form-froup">
                                        <select class="custom-select" name="status">
                                            <?php foreach ($statusList as $sl):?>
                                                <option value="<?= $sl['status']?>" <?= ($profile['status'] == $sl['status']) ? 'selected' : '' ?>>
                                                    <?= $sl['status']?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">About</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control auto-expand" id="about" name="about" rows="4"><?= $profile['about'] ?></textarea>
                                    <?=form_error('about', '<small class="text-danger pl-3">', '</small>');?>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                