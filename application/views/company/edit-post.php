                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <input type="hidden" value="<?=$post['id']?>" name="post_id">
                                        <div class="form-group">
                                            <label for="title">Job Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter job title" value=<?=$post['title']?> >
                                            <?=form_error('title', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>

                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea class="form-control" id="short_description" name="short_description" rows="3" 
                                                placeholder="Brief overview of the position"><?=$post['short_description']?></textarea>
                                            <?=form_error('short_description', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>

                                        <div class="form-group">
                                            <label for="details">Job Details</label>
                                            <textarea class="form-control auto-expand" id="details" name="details" rows="6" 
                                                placeholder="Full job description, requirements, and responsibilities"><?=$post['details']?></textarea>
                                            <?=form_error('details', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact">Location</label>
                                            <textarea class="form-control" id="location" name="location" rows="1" 
                                                placeholder="Job location"><?=$post['location']?></textarea>
                                            <?=form_error('location', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact">Salary</label>
                                            <textarea class="form-control" id="salary" name="salary" rows="1" 
                                                placeholder="Job salary in Rupiah"><?=$post['salary']?></textarea>
                                            <?=form_error('salary', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact">Contact Information</label>
                                            <textarea class="form-control" id="contact" name="contact" rows="2" 
                                                placeholder="How candidates should apply or contact you"><?=$post['contact']?></textarea>
                                            <?=form_error('contact', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Edit this Post</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>  
            <!-- End of Main Content -->         