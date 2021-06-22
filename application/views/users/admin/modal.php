                        <?php
                        $arr = json_decode($json,true);
                        foreach($arr as $val):
                        ?>
<div class="modal fade" id="ModalEdit<?= $val['id_user']; ?>" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                	<h5 class="modal-title" id="exampleModalLongTitle">Edit data petani</h5>
                   <!--  <div class="card-header card-header-primary text-center"> -->
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                </div>
                <div class="modal-body">
                    <form class="form" method="post" action="<?= base_url('admin/update'); ?>">
                       <!--  <p class="description text-center">Or Be Classical</p> -->
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $val['id_user']; ?>">
                            <input type="hidden" name="role" value="<?= $val['role_id']; ?>">
                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                	<span class="input-group-addon">
                            			<i class="material-icons">face</i>
                        			</span>
                                    <input id="nama" type="text" class="form-control" value="<?= $val['nama']; ?>" name="nama">
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">mail</i>
                                    </span>
                                    <input id="alamat" type="text" class="form-control" value="<?= $val['alamat']; ?>" name="alamat">
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                	<span class="input-group-addon">
                            			<i class="material-icons">email</i>
                        			</span>
                                    <input type="email" name="email" class="form-control" value="<?= $val['email']; ?>">
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                	<span class="input-group-addon">
                            			<i class="material-icons">perm_contact_calendar</i>
                        			</span>
                                    <input type="number" value="<?= $val['nohp']; ?>" class="form-control" name="nohp">
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">book</i>
                                    </span>
                                    <input type="number" value="<?= $val['rekening']; ?>" class="form-control" name="rekening">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary btn-wd btn-lg">Save</button>
                </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>