var myApp = angular.module('myApp');

myApp.controller('CacatController', function($scope, $http){
    $scope.base_url = 'http://localhost/spk_pk/server/api/';
    $scope.data_cacat = [];
    $scope.newCacat = {};
    $scope.curCacat = {};

    $scope.getCacat = function(){
        $http.get($scope.base_url+'master-cacat/data.php').then(function(res){
            if(res.data.success){
                $scope.data_cacat = res.data;
            } else {
                swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
            }
        })
    }

    $scope.onNewCacat = function(){
        if($scope.newCacat.kode_defect === undefined || $scope.newCacat.jenis_cacat === undefined || $scope.newCacat.penyebab_cacat === undefined || $scope.newCacat.tindakan === undefined){
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
                    $http.post($scope.base_url+'master-cacat/insert.php', $scope.newCacat).then(function(res){
                        if(res.data.success){
                            swal('Sukses', 'Berhasil Menyimpan Data!', 'success');
                            $scope.newCacat = {};
                            $scope.getCacat();
                            $('#formNewCacat').collapse('toggle')
                        } else {
                            swal('Oopss..!', 'Gagal Menyimpan Data!', 'error');
                        }
                    })
                }, 1100)
            })
        }
    }

    $scope.onEditCacat = function(data){
        $scope.curCacat = data;
    }

    $scope.updateCacat = function(updatedCacat){
        $http.post($scope.base_url+'master-cacat/update.php',
            {
                "kode_defect": updatedCacat.kode_defect,
                "jenis_cacat": updatedCacat.jenis_cacat,
                "penyebab_cacat": updatedCacat.penyebab_cacat,
                "tindakan": updatedCacat.tindakan
            }).then(function(res){
            if(res.data.success){
                swal('Sukses', 'Data Telah di Update!', 'info');
                $scope.getCacat()
                $('#formEditCacat').modal('hide');
            } else {
                swal('Oopss..!', 'Gagal Mengupdate Data! Terjadi Error Di Server', 'warning')
            }
        })
    }

    $scope.hapusCacat = function(data){
        swal({
            title: "Kamu Yakin Ingin Menghapus?",
            text: "Data (Kode Defect : " + data.kode_defect + ")" +" Akan Dihapus, Lanjutkan ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Lanjutkan!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(){
            setTimeout(function(){
                $http.post($scope.base_url+'master-cacat/delete.php',
                    {"kode_defect" : data.kode_defect }).then(function(res){
                    if(res.data.success){
                        swal('Sukses', 'Berhasil Menghapus Data', 'success')
                        $scope.getCacat()
                    } else {
                        swal('Ooopss.!!', 'Gagal Menghapus Data, Ada Masalah Di Server', 'warning')
                    }
                })
            }, 1100)
        })
    }
})