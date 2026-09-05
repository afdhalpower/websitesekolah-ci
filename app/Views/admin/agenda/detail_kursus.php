<table class="table table-bordered table-hover" width="100%">
	<tbody>
		<tr>
			<td width="30%">Nama Produk</td>
			<td>: <?php echo esc($produk->nama_produk) ?></td>
		</tr>
		<tr>
		  <td width="30%">Jumlah Produk</td>
		  <td>: <?php echo esc($produk->jumlah_produk) ?> pcs</td>
	  </tr>
		<tr>
		  <td width="30%">Berat produk</td>
		  <td>: <?php echo esc($produk->berat) ?> kg</td>
	  </tr>
		<tr>
		  <td width="30%">Urutan (PXLXT cm)</td>
		  <td>: <?php echo esc($produk->panjang) ?> x <?php echo esc($produk->lebar) ?> x <?php echo esc($produk->tinggi) ?> cm</td>
	  </tr>
		<tr>
		  <td width="30%">Biaya Pendaftaran  beli</td>
		  <td>: Rp. <?php echo number_format($produk->harga_produk,'0',',','.') ?></td>
	  </tr>
		<tr>
		  <td width="30%">Biaya Pendaftaran  jual</td>
		  <td>: Rp. <?php echo number_format($produk->harga_jual,'0',',','.') ?></td>
	  </tr>
		<tr>
		  <td width="30%">Biaya kirim minimal</td>
		  <td>: Rp. <?php echo number_format($produk->biaya_kirim,'0',',','.') ?></td>
	  </tr>
		<tr>
		  <td width="30%">Kategori</td>
		  <td>: <?php echo esc($produk->nama_kategori_produk) ?></td>
	  </tr>
		<tr>
		  <td width="30%">Brand</td>
		  <td>: <?php echo esc($produk->nama_brand) ?></td>
	  </tr>
		
		<tr>
		  <td width="30%">Gambar</td>
		  <td>: <img src="<?php echo base_url('assets/upload/image/'.$produk->gambar) ?>" class="img img-responsive"></td>
	  </tr>
	  <tr>
		  <td width="30%">Tanggal input</td>
		  <td>: <?php echo esc($produk->tanggal_post) ?></td>
	  </tr>
		<tr>
		  <td width="30%">Terakhir update</td>
		  <td>: <?php echo esc($produk->tanggal) ?></td>
	  </tr>
		<tr>
		  <td width="30%">Diupdate oleh</td>
		  <td>: <?php echo esc($produk->nama) ?></td>
	  </tr>
	  <tr>
		  <td colspan="2">
		  <p><strong>Deskripsi:</strong></p><hr>
		  <?php echo esc($produk->isi) ?></td>
	  </tr>
	</tbody>
</table>