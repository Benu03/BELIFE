<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                <?= $this->uri->segment(1); ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= $title; ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        <form  name="orderscustomerpodo"  id="orderscustomerpodo" action="<?= base_url('PurchaseOrder_DeliveryOrder/PostPoDo_2'); ?>" method="POST"  >
            <div class="row">
                <div class="col-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card card-solid">
                         <div class="card-body">

                         <div class="row ">
                           <div class="col-4">
                        

                           <div class="card card-solid">
                              <div class="card-body">
                              <div class="form-group row">
                                    <label for="kodepodo" class="col-sm-5 col-form-label">Kode PO & DO</label>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="kodepodo" name="kodepodo" placeholder="Insert Title" value="<?= $kode_podo; ?>" readonly >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="totalreqpodo" class="col-sm-5 col-form-label">Total Request (Rp)</label>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="totalreqpodo" name="totalreqpodo" value=" <?=  number_format($sumpodoadd['price'],0 ,',','.'); ?>"    readonly >
                                    <input type="text" class="form-control form-control-sm" id="totalreqpodo2" name="totalreqpodo2" value=" <?=  $sumpodoadd['price']; ?>"    hidden >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="countoderpodo" class="col-sm-5 col-form-label">Jumlah Detail</label>
                                    <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm text-center" id="countoderpodo" name="countoderpodo"  value="<?= $countoderpodo; ?>" readonly >
                                    </div>
                                </div>
                                    
                                <button type="button" class="btn  btn-sm btn-primary float-right"   data-toggle="modal" data-target="#listpodowaitingsup"
                                 ><i class="fas fa-check-double"></i> Add Data</button>
                           
                            

                              </div>
                            </div>  
                           </div>

                           <div class="col-8">
                           <div class="card card-solid">
                              <div class="card-body">
                              <div class="card card-secondary">
                              <div class="card-header">
                                  <h3 class="card-title"><b>List PO & DO Request Supplier</b></h3>

                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-minus"></i>
                                      </button>
                                  </div>
                                  </div>

                                  <div class="card-body">
                                    

                                  <table  id="tblistpodo" class="table table-bordered" >
                                <thead class="text-center">
                                    <tr>
                                    <th>Supplier</th>                                    
                                        <th>Total</th>
                                        <th>No Rekening</th>
                                        <th>Date Post</th>
                                         <th>Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach ($listadd_supplier as $dt) : ?>
                                        <tr >
                                         
                                            <td  class="text-center" style="vertical-align:middle" >
                                            <?= $dt['supplier_name']; ?>
                                          </td>
                                        
                                          <td  class="text-center" style="vertical-align:middle" >
                                          Rp. <?=  number_format($dt['price'],0 ,',','.'); ?>
                                          </td>
                                          <td  class="text-center" style="vertical-align:middle" >
                                            <?= $dt['bank_supplier']; ?> - <?= $dt['norek_supplier']; ?>
                                          </td>


                                          <td  class="text-center" style="vertical-align:middle" >
                                            <?= $dt['date_post']; ?>
                                          </td>
                                       
                                          <td  class="text-center" style="vertical-align:middle" >
                                          <a id="delorderspodosup" onclick="pododelordersup()" href="javascript:void(0)" class="btn  btn-sm btn-danger float-center"   
                                          
                                          data-id ="<?= $dt['id']; ?>"
                                          data-kode_po_do ="<?= $dt['kode_po_do']; ?>"
                                          
                                         >
                                        
                                          <i class="far fa-trash-alt"></i> Delete</a>
                                         </td>
                                        
                                        </tr>
                                        <?php endforeach; ?>

                                </tbody>
                            </table>






                                  </div>
                                </div>                                            
                              </div>
                            </div>  
                          
                           </div>
                         </div> 



                





                            <button type="submit" class="btn  btn-lg btn-success float-left"    id="btn_permohonandana_supplier"
                            onclick="return confirm('Apakah Data Request Sudah Sesuai ?');"  ><i class="far fa-credit-card"></i> Request PO & Supplier
                            </button>
                            </form>




                           
                </div>
               </div>
               
               
       

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->





<!-- Modal -->
<div class="modal fade" id="listpodowaitingsup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listpodowaiting">Add Supplier Delivery Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="content">
        <div class="container-fluid">
              <div class="card card-solid">
                         <div class="card-body">

                                   <div class="form-group row">
                                          <label for="podosuppliername" class="col-lg-4 col-form-label">Supplier</label>
                                          <div class="col-lg-6">
                                        
                                          <select name="podosuppliername" id="podosuppliername" class="form-control" onchange="suppliergetpodo();">  
                                                <option value="" hidden>Select Supplier</option> 

                                                <?php foreach($list_supplier as $r) :   ?>
                                                    <option value="<?= $r['id']; ?>" <?php echo set_select('podosuppliername', $r['id']); ?>> <?= $r['supplier_name'];  ?></option> 
                                                <?php endforeach;   ?> 
                                            </select>   
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="namakontaksup" class="col-lg-4 col-form-label">Nama Kontak</label>
                                          <div class="col-lg-6">
                                          <input type="text" class="form-control" id="namakontaksup" name="namakontaksup" value="<?= set_value('namakontaksup'); ?>"  readonly >
                                         
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="kontaksup" class="col-lg-4 col-form-label">Kontak Supplier</label>
                                          <div class="col-lg-6">
                                          <input type="text" class="form-control" id="kontaksup" name="kontaksup" value="<?= set_value('kontaksup'); ?>"  readonly >
                                         
                                        </div>
                                        </div>


                                        <div class="form-group row">
                                          <label for="bankaccountsup" class="col-lg-4 col-form-label">Bank Account</label>
                                          <div class="col-lg-6">
                                          <input type="text" class="form-control" id="bankaccountsup" name="bankaccountsup" value="<?= set_value('bankaccountsup'); ?>"  readonly >
                                         
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="noreksup" class="col-lg-4 col-form-label">No Rekening</label>
                                          <div class="col-lg-6">
                                          <input type="text" class="form-control" id="noreksup" name="noreksup" value="<?= set_value('noreksup'); ?>" readonly >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="nominalsup" class="col-lg-4 col-form-label">Nominal (Rp)</label>
                                          <div class="col-lg-6">
                                          <input type="text" class="form-control" id="nominalsup" name="nominalsup" value="<?= set_value('nominalsup'); ?>" onkeypress="return hanyaAngka(event)"  required>
                                          
                                        </div>
                                        </div>
                         
                      
      
                         </div>
              </div>
      
        </div>
      </div>
    

      </div>
      <div class="modal-footer">
      <button id="addorderspodosup" onclick="podoaddodersup()" class="btn  btn-sm btn-info float-center"> <i class="far fa-credit-card"></i> Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>








































<?php $this->load->view('templates/footer'); ?>