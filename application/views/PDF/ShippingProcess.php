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

    table,
    th,
    td {
      border: solid black;
      border-collapse: collapse;
      vertical-align: top;
      font-size: 16px;
    }
  </style>

</head>

<body>
 <?php
  $data = file_get_contents('http://' . $_SERVER["HTTP_HOST"] . '/assets/img/belife-logo-pdf.png');
  $base64 = 'data:image/'  . ';base64,' . base64_encode($data);
  ?>
  <img src="<?php echo $base64; ?>" style="height:50px;">
  <h2 style="text-align:center">TANDA TERIMA</h2>
  <h5 style="text-align:center">PT. BetterLife Jaya Indonesia</h5>

  <hr />

  <table border="1" width="100%" style="text-align:center">
    <tr>
      <td><b>Delivery Note</b></td>
      <td><b>Date</b></td>
      <td><b>Customer ID</b></td>
      <td><b>Customer Name</b></td>
      <td><b><?= $dtShippingCust['partner_name']; ?></b></td>
    </tr>
    <tr>
      <td><?= $dtShippingCust['kode_shipping']; ?></td>
      <td><?= date("Y-m-d");  ?></td>
      <td><?= $dtShippingCust['contract_no']; ?></td>
      <td><?= $dtShippingCust['nama_penerima']; ?></td>
      <td><?= $dtShippingCust['kontak_penerima']; ?></td>
    </tr>
  </table>

  <br>

  <table border="1" width="100%">
    <thead>
      <tr>
        <th style="text-align:center">No</th>
        <th>Model</th>
        <th class="text-center">Qty</th>
        <th class="text-center">Harga</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($detailshipping_item as $s) : ?>
        <tr>
          <td style="text-align:center"><?= $i++; ?></td>
          <td><?= $s['nama_product']; ?></td>
          <td style="text-align:center"><?= $s['qty']; ?></td>
          <td style="text-align:center">Rp. <?= number_format($s['price'], 0, ',', '.'); ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="4" style="text-align:right">
          <b> Total : Rp. <?= number_format($totalharga['totalharga'], 0, ',', '.'); ?> </b>
        </td>
      </tr>
    </tbody>
  </table>

  <br>

  <table border="0" width="100%">
    <tr>
      <td style="text-align:center">Dibuat,</td>
      <td style="text-align:center">Pengirim,</td>
      <td style="text-align:center">Penerima,</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:center"><?= $this->session->userdata('name'); ?></td>
      <td style="text-align:center">(.............................)</td>
      <td style="text-align:center">(.............................)</td>
    </tr>
  </table>

  <br>

  - Barang diterima dalam keadaan baik. <br>
  - Kondisi barang baru dan lengkap sesuai dengan pesanan. <br>
  <b>* Barang yang sudah dibeli tidak dapat ditukar kembalikan dengan type berbeda atau sejenisnya</b>

  <footer>
    <p>©2022 Belife Indonesia</p>
  </footer>

</body>

</html>