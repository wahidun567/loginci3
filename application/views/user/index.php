<!-- Content Wrapper -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img style="width: 180px; height : 190px;" src="<?php echo base_url('assets/img/profile/') . $user['image']; ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['name']; ?></h5>
                    <p class="card-text"><?php echo $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since : <?php echo date('d F Y', $user['date_create']); ?></small></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
