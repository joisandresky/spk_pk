var myApp = angular.module('myApp');

myApp.controller('ProdukController', function($scope, $http){
    $scope.base_url = 'http://localhost/spk_pk/server/api/';
    $scope.data_produk = [];
    $scope.newProduk = {};
    $scope.curProduk = {};


    $scope.getProducts = function(){
        $http.get($scope.base_url+'produk/data.php').then(function(res){
            if(res.data.success){
                $scope.data_produk = res.data;
            } else {
                swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
            }
        })
    }

    $scope.onNewProduk = function(){
        if($scope.newProduk.kode_produk === undefined || $scope.newProduk.nama_material === undefined || $scope.newProduk.keterangan_produk === undefined){
            swal('Oopss..!', 'Lengkapi Form Pengisian', 'warning')
        } else {
            swal({
                title: "Yakin Dengan Data ini ?",
                text: "Konfirmasi Jika Kamu Ingin Menyimpan data ini",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#5aa6fc",
                confirmButtonText: "Ya, Simpan!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function(){
                setTimeout(function(){
                    $http.post($scope.base_url+'produk/insert.php', $scope.newProduk).then(function(res){
                        if(res.data.success){
                            swal('Sukses', 'Berhasil Menyimpan Data!', 'success');
                            $scope.newProduk = {};
                            $scope.getProducts();
                            $('#formNewProduk').collapse('toggle')
                        } else {
                            swal('Oopss..!', 'Gagal Menyimpan Data!', 'error');
                        }
                    })
                }, 1100)
            })
        }
    }

    $scope.onEditProduk = function(data){
        $scope.curProduk = data;
    }

    $scope.updateProduk = function(updatedProduk){
        $http.post($scope.base_url+'produk/update.php',
            {
                "kode_produk": updatedProduk.kode_produk,
                "nama_material": updatedProduk.nama_material,
                "keterangan_produk": updatedProduk.keterangan_produk
            }).then(function(res){
            if(res.data.success){
                swal('Sukses', 'Data Telah di Update!', 'info');
                $scope.getProducts()
                $('#formEditProduk').modal('hide');
            } else {
                swal('Oopss..!', 'Gagal Mengupdate Data! Terjadi Error Di Server', 'warning')
            }
        })
    }

    $scope.hapusProduk = function(data){
        swal({
            title: "Kamu Yakin Ingin Menghapus?",
            text: "Data "+ data.nama_produk+ "(" + data.kode_produk + ")" +" Akan Dihapus, Lanjutkan ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Lanjutkan!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(){
            setTimeout(function(){
                $http.post($scope.base_url+'produk/delete.php',
                    {"kode_produk" : data.kode_produk }).then(function(res){
                    if(res.data.success){
                        swal('Sukses', 'Berhasil Menghapus Data', 'success')
                        $scope.getProducts()
                    } else {
                        swal('Ooopss.!!', 'Gagal Menghapus Data, Ada Masalah Di Server', 'warning')
                        console.log(res)
                    }
                })
            }, 1100)
        })
    }
})