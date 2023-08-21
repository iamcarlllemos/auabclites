<div class="dashboard-wrapper my-md-0">
    <?= $this->include('admin/templates/sidebar') ?>
    <div class="content">
        <?= $this->include('admin/templates/navbar') ?>
        <div class="inner-content mx-3 pb-5">
            <div class="container">
                <section class="mt-">
                    <div class="mt-5">
                        <?php
                            $flashdata = session()->getFlashData('notify');
                            if(empty($flashdata)) {
                                header('Location: /admin/dashboard');
                                exit();
                            }
                        ?>
                        <div class="row">
                            <div class="col-12 col-md-12 mb-3">
                                <div class="card delete shadow">
                                    <div class="card-header p-4 border-0">
                                        <h5 class="card-title m-0">Oops! You are not authorized</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6>Error: 403 Forbidden</h6>
                                        <h6>Route: <code>/<?= $flashdata["route_visited"] ?></code></h6>
                                        <h6>Position: <?= strtoupper(format_position($flashdata["position"])) ?></h6>
                                        <hr>
                                        <h6>Why am I seeing this?</h6>
                                        <ul>
                                            <li><code>You are trying to access unauthorized pages</code></li>
                                            <li><code>Your position is not available to access this page</code></li>
                                        </ul>
                                        <hr>
                                        <h6>As a developer here are the routes you can only access </h6>
                                        <ul>
                                            <?php
                                                foreach($flashdata["allowed"] as $value) {
                                                    echo '
                                                    <li>
                                                        <code><a href="/'.$value.'">/'.$value.'</a></code>
                                                    </li>
                                                    ';
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>