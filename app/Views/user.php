<style>
    .tdcoy > td {
        color: black;
    }

    .status-label {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        display: inline-block;
    }

    .status-label.active {
        background-color: #5cb85c; /* Green */
        color: white;
    }

    .status-label.inactive {
        background-color: #d9534f; /* Red */
        color: white;
    }
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>User Management</h4>
                    <span class="ml-1">Datatable</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                    <a href="<?=base_url('home/t_user')?>">
                    <button class="btn btn-dark">Tambah</button>
                    </a>
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                            <thead>
    <tr>
        <th>Level</th>
        <th>username</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($user as $u): ?>
    <tr class="tdcoy">
        <td><?= $u->level ?></td>
        <td><?= $u->username ?></td>
        <td>
            <a href="<?= base_url('home/EditUser/' . $u->id_user) ?>">
                <button class="btn btn-dark"><i class="fa fa-edit"></i></button>
            </a>
            <a href="<?= base_url('home/SDUser/' . $u->id_user) ?>">
                <button class="btn btn-dark"><i class="fa fa-trash"></i></button>
            </a>
            <a href="<?= base_url('home/resetedituser/' . $u->id_user) ?>">
                <button class="btn btn-dark"><i class="fa fa-arrow-left"></i></button>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
<tfoot>
    <tr>
        <th>Level</th>
        <th>username</th>
        <th>Aksi</th>
    </tr>
</tfoot>

                            </table>    
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?=base_url('vendor/global/global.min.js')?>"></script>
<script src="<?=base_url('js/quixnav-init.js')?>"></script>
<script src="<?=base_url('js/custom.min.js')?>"></script>
<script src="<?=base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('js/plugins-init/datatables.init.js')?>"></script>
