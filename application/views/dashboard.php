<?php
defined('BASEPATH') or exit('No direct script access allowed');
//print_r($_SESSION);
?>
<!-- Begin Page Content -->
<!-- <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg></div>
                        Dashboard
                    </h1>
                    <div class="page-header-subtitle">Example dashboard overview and content summary</div>
                </div>
            </div>
        </div>
    </div>
</header> -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="m-0 font-weight-bold text-primary">Users List</h5>
                </div>
                <div class="col-md-4 offset-md-4">
                    <button type="button" onclick="add_person()" class="btn btn-primary float-right ml-2">Add
                        User</button>
                    <button type="button" id="ExportReporttoExcel" class="btn btn-primary float-right">Excel</button>
                </div>
            </div>
            <!-- <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
              <button type="button" onclick="add_person()" class="btn btn-primary float-right">Add User</button> -->
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th style="width:159px">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" novalidate>
                    <input type="hidden" value="" name="id" />
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label class="control-label">First Name</label>
                            <div>
                                <input name="firstName" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="control-label">Last Name</label>
                            <div>
                                <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label class="control-label">Gender</label>
                            <div>
                                <select name="gender" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="control-label ">Date of Birth</label>
                            <div>
                                <input name="dob" placeholder="yyyy-mm-dd" id="datepicker"
                                    class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label class="control-label">Role</label>
                            <div>
                                <select name="role" class="form-control">
                                    <option value="">--Select Role--</option>
                                    <?php if ($_SESSION['level'] == '1') { ?>
                                    <option value="1">SuperAdmin</option>
                                    <?php } ?>
                                    <option value="2">Admin</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="control-label">Username</label>
                            <div>
                                <input name="userName" id="userName" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-6 psdDiv">
                            <label class="control-label ">Password</label>
                            <div>
                                <input name="userPassword" id="userPassword" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="control-label">Address</label>
                            <div>
                                <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <!--  <button class="btn btn-primary" type="submit">Submit form</button> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!-- Bootstrap modal -->
<div class="modal fade" id="role_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="roleForm" novalidate>
                    <input type="hidden" value="" name="id" />
                    <div class="form-row">
                        <div class="col-md-6 mb-6 psdDiv">
                            <label class="control-label ">Password</label>
                            <div>
                                <input name="userPassword" id="userPassword" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="control-label">Address</label>
                            <div>
                                <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <!--  <button class="btn btn-primary" type="submit">Submit form</button> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->