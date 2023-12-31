<div class="dashboard-wrapper my-md-0">
    <?= $this->include('admin/templates/sidebar') ?>
    <div class="content">
        <?= $this->include('admin/templates/navbar') ?>
        <div class=" mx-3 pb-5">
            <div class="container">
                <section class="mt-5">
                    <?php
                         $flashdata = session()->getFlashData('flashdata');
                         readFlashData($flashdata);
                    ?>
                    <div class="card mt-5">
                        <div class="card-header border-0 py-4">
                            <small class="tle">MANAGE BULLETIN</small>
                        </div>
                        <div class="card-body">
                            <div class="actions d-flex mb-4 justify-content-end">
                                <a href="bulletin/add" class="btn btn-primary"><i class='bx bxs-news' ></i> Add Bulletin</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Banner</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Date Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(!empty($data)) {
                                            foreach($data['get_bulletin'] as $value) {
                                                $image_path = ($value->category == 1) ? 'announcements' : (($value->category == 2) ? 'news' : '');
                                                echo ' 
                                                <tr>
                                                    <td>#'.$value->id.'</td>
                                                    <td>
                                                        <img src="/assets/home/images/bulletin/'.$image_path.'/'.$value->image.'">
                                                    </td>
                                                    <td>'.$value->title.'</td>
                                                    <td>'.format_bulletin_category($value->category).'</td>
                                                    <td>'.format_timestamp_to_data($value->date_created).'</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="/admin/manage/page/bulletin/view/'.$value->id.'" class="btn btn-primary"><i class="bx bx-show" ></i> View</a>
                                                            <a href="/admin/manage/page/bulletin/update/'.$value->id.'" class="btn btn-success"><i class="bx bxs-edit" ></i> Update</a>
                                                            <a href="/admin/manage/page/bulletin/delete/'.$value->id.'" class="btn btn-danger"><i class="bx bxs-trash bx-tada" ></i> Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                ';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>