<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail ps</h1>
        </div>


            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-5">
                            <img width="400" src="<?php echo base_url() . 'assets/upload/' . $item['gambar'] ?>">

                        </div>

                        <div class="col-md-7">
                            
                            <table class="table">
                                <tr>
                                    <td>Type ps</td>
                                    <td>
                                        
                                        <?php 
                                            foreach($data as $tp) {
                                                if($tp['kode_type'] == $item['kode_type']) {
                                                    echo $tp['nama_type'];
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>brand</td>
                                    <td><?php echo $item['brand'] ?></td>
                                </tr>

                                <tr>
                                    <td>berat / volume</td>
                                    <td><?php echo $item['berat'] ?></td>
                                </tr>

                                <tr>
                                    <td>deskripsi</td>
                                    <td><?php echo $item['deskripsi'] ?></td>
                                </tr>


                                <tr>
                                    <td>Harga Beli (Modal)</td>
                                    <td>Rp. <?php echo number_format($item['harga_beli'],0,',','.') ?></td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td>Rp. <?php echo number_format($item['harga_jual'],0,',','.') ?></td>
                                </tr>
                                <tr>
                                    <td>Keuntungan</td>
                                    <td>Rp. <?php echo number_format($item['harga_jual'] - $item['harga_beli'],0,',','.') ?></td>
                                </tr>

                                
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <?php 
                                            if($item['status'] == "0"){
                                                echo "<span class='badge badge-danger'> Tidak Tersedia </span>";
                                            }else{
                                                echo "<span class='badge badge-primary'>Tersedia </span>";
                                            }
                                        ?>    
                                    </td>
                                </tr>
                                
                            </table>

                            <a class="btn btn-sm btn-danger ml-4" href="<?php echo base_url('admin/data_item') ?>">Kembali</a>
                            <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/data_item/update_item/') . $item['id_item']?>">Update</a>
                        </div>

                    </div>
                </div>
            </div>



    </section>
</div>