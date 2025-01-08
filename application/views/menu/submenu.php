                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>


                    <div class="row">
                        <div class="col-lg">
                        <?php if(validation_errors()): ?>
                            <div class="alert alert-danger" role="alert">
                                <?=validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <?=form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>');?>
                        <?=$this->session->flashdata('message');?>


                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Url</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                <?php foreach ($subMenu as $sm) : ?>
                                <tr>
                                    <th scope="row"><?=$i?></th>
                                    <td><?=$sm['title']?></td>
                                    <td><?=$sm['menu']?></td>
                                    <td><?=$sm['url']?></td>
                                    <td><?=$sm['icon']?></td>
                                    <td><?=$sm['is_active']?></td>
                                    <td>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id']; ?>">edit</a>
                                    <a href="<?= base_url('menu/deleteSubMenu/') . $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure you want to delete this submenu?');">delete</a>
                                    </td>
                                </tr>

                                <!-- Edit Submenu Modal -->
                                <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSubMenuModalLabel">Edit Submenu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('menu/editSubMenu'); ?>" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?= $sm['title']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="menu_id" id="menu_id" class="form-control">
                                                            <option value="">Select Menu</option>
                                                            <?php foreach ($menu as $m) : ?>
                                                                <option value="<?= $m['id']; ?>" <?= $m['id'] == $sm['menu_id'] ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $sm['url']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $sm['icon']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?= $sm['is_active'] ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="is_active">
                                                                Active?
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->         

            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSubMenuModal">Add New Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('menu/submenu');?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" placeholder="Submenu title" name="title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?=$m['id']?>"><?=$m['menu']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" placeholder="Submenu url" name="url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" placeholder="Submenu icon" name="icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active"
                            name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
                </div>
            </div>
            </div>