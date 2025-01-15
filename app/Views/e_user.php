<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="form-valide-with-icon" action="<?= base_url('home/aksi_edit_user/') ?>" method="post">
                                
                                <?php if (session()->getFlashdata('message')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('message') ?>
                                    </div>
                                <?php elseif (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>
                                <input type="hidden" name="id" value="<?=$user->id_user?>">
                                <!-- Username -->
                                <div class="form-group">
                                    <h6 class="text-label">Username</h6>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" value="<?= $user->username ?>" placeholder="Masukkan username" required>
                                    </div>
                                </div>

                                <!-- Level -->
                                <div class="form-group">
                                    <h6 class="text-label">Level</h6>
                                    <select class="form-control" name="level" required>
                                        <option value="">Pilih Level</option>
                                        <?php foreach ($level as $lvl): ?>
                                            <option value="<?= $lvl->id_level ?>" <?= $lvl->id_level == $user->id_level ? 'selected' : '' ?>><?= $lvl->level ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update User</button>
                                <a href="<?= base_url('home/User') ?>"><button type="button" class="btn btn-light">Batal</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
