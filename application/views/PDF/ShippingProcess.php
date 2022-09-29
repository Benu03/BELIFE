<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <style>
article {
    min-height: 100%;
    display: grid;
    grid-template-rows: auto 1fr auto;
}

footer {
    display: flex;
    justify-content: center;
    padding: 5px;
    background-color: #343a40;
    color: #343a40;
}
</style>
  
</head>
<body>

<?php 
$data = file_get_contents('http://localhost:6060/belife-apps/assets/img/belife-logo-1.png');
$base64 = 'data:image/'  . ';base64,' . base64_encode($data);
?>



<h2 style="background-color:Gray;"><center> <img  src="<?php echo $base64; ?>" style="height:30px;">  PT Betterlife Jaya indonesia</center></h2>


<hr/>

<p style="text-align:right" > Delivery Note (Date: <?= date("Y-m-d");  ?>)</p>

<p>
<?php foreach ($detailshipping as $ds) : ?>
<table border="0" width="60%"   >

<tr>  
    <td style="text-align:left"><b>Kode Pengiriman</b></td>   <td style="text-align:left"><?= $ds['kode_shipping']; ?></td>

    </tr>
    <tr>
    <td style="text-align:left"><b>Kode Order</b></td>  <td style="text-align:left"><?= $ds['kode_order']; ?></td>
    </tr>
    <tr>
    <td style="text-align:left"><b>Nama Penerima</b></td> <td style="text-align:left"><?= $ds['nama_penerima']; ?></td>
    </tr>
    <tr>
    <td style="text-align:left"><b>Kontak Penerima</b></td>  <td style="text-align:left"><?= $ds['kontak_penerima']; ?></td>
    </tr>
    <tr>
    <td style="text-align:left"><b>Alamat Penerima</b></td>  <td style="text-align:left"><?= $ds['alamat_pengiriman']; ?></td>
  </tr>
  
 
</table>


                     
<?php endforeach; ?>
</p>
<br>



<table border="1" width="100%" >

                    <thead>
                    <tr>
                      <th>Kode Product</th>
                      <th>Nama Product</th>
                      <th class="text-center">Qty</th>
                      <th class="text-center">Harga</th>
                      <th class="text-center">Tanggal Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                             <?php foreach ($detailshipping_item as $s) : ?>
                    <tr>
                      <td style="text-align:center"><?= $s['kode_product']; ?></td>
                      <td style="text-align:center"><?= $s['nama_product']; ?></td>
                      <td style="text-align:center"><?= $s['qty']; ?></td>
                      <td style="text-align:center">Rp. <?= number_format($s['price'],0 ,',','.'); ?></td>
                      <td style="text-align:center"><?= $s['date_order']; ?></td>
                    </tr>
                   
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5" style="text-align:right" >
                        <b> Total Harga :  Rp.  <?= number_format($totalharga['totalharga'],0 ,',','.'); ?> </b> 
                        </td>
                    </tr>

                    </tbody>
                  </table>


                  <footer>
        <p>© 2022 Belife Indonesia</p>
    </footer>

                  </body>
</html>