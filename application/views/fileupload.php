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
        <h1 class="h3 mb-0 text-gray-800">File Upload</h1>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="m-0 font-weight-bold text-primary">File List</h5>
                </div>
                <div class="col-md-4 offset-md-4">
                    <button type="button" onclick="fileUpload()" class="btn btn-primary float-right ml-2">File Upload
                        User</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="fileUploadTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sale Channel</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th>Upload DateTime</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sale Channel</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th>Upload DateTime</th>
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


<!-- Bootstrap modal -->
<div class="modal fade" id="fileUpload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body form">
                <form id="file_upload">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Sales Channel</label>
                        <div class="col-md-10 mb-10">
                            <div>
                                <select name="sale_channel" class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="1">Amazon</option>
                                    <option value="2">Flipkart</option>
                                    <option value="3">FlipkartDbNotes</option>
                                    <option value="4">Paytm</option>
                                    <option value="5">Cash</option>
                                    <option value="6">PepperFry</option>
                                    <option value="7">Tata Unistore</option>
                                    <option value="8">ShopClues</option>
                                    <option value="9">Snapdeal</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">File Type</label>
                        <div class="col-md-10 mb-10">
                            <div>
                                <select name="file_type" class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="1" title="Base Value">Base Value</option>
                                    <option value="2" title="Tally Master">Tally Master</option>
                                    <option value="5" title="All Order">All Order</option>
                                    <option value="6" title="Financial Summary">Financial Summary</option>
                                    <option value="8" title="Product Group">Product Group</option>
                                    <option value="11" title="Tally Asin">Tally Asin</option>
                                    <option value="14" title="Inventory Items (SAP)">Inventory Items (SAP)</option>
                                    <option value="15" title="B2B Sales">B2B Sales</option>
                                    <option value="17" title="Order Phone Number">Order Phone Number</option>
                                    <option value="18" title="Seller Feedback">Seller Feedback</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">File Type</label>
                        <div class="col-md-10 mb-10">

                            <input type="file" name="file">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="uploadCSVFile()" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->