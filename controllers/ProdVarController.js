var myApp = angular.module('myApp');

myApp.controller('ProdVarController', function($scope, $http){
    $scope.base_url = 'http://localhost/spk_pk/server/api/';
    $scope.prod_var = [];
    $scope.produks = [];
    $scope._x = new Array(8);

    $scope.currPV = {};
    $scope.detailPVX = {};
    $scope.ex = {};
    $scope.loadMaterial = function(){
        $http.get($scope.base_url+'produk/data.php').then(function(res){
            if(res.data.success){
                $scope.produks = res.data.products;
            } else {
                $scope.produk = []
            }
        })
    }

    $scope.loadProdVar = function(){
        $http.get($scope.base_url+'produksi-variable/data.php').then(function(res){
            if(res.data.success){
                $scope.prod_var = res.data.pv;
            } else {
                $scope.prod_var = [];
            }
        })
    }

    $scope.tambahDetail = function(x){
        if(x.x1 == "" && x.x2 == "" && x.x3 == "" && x.x4 == "" && x.x5 == "" && x.x6 == "" && x.x7 == "" && x.x8 == ""){
            swal('Oopss..!!', 'Pengisian Data Belum Lengkap!', 'error');
            return;
        } else {
            $scope._x[0] = x.x1;
            $scope._x[1] = x.x2;
            $scope._x[2] = x.x3;
            $scope._x[3] = x.x4;
            $scope._x[4] = x.x5;
            $scope._x[5] = x.x6;
            $scope._x[6] = x.x7;
            $scope._x[7] = x.x8;
            $('#modalVarX').modal('toggle');
        }
    }

    $scope.onSavePV = function(prdv){
        prdv.x = $scope._x;
        if(prdv.no_produksi == "" && prdv.kode_produk == "" && prdv.tanggal_produksi == ""){
            swal('Ooppss..!', 'Form Pengisian Belum Lengkap!', 'warning');
            return;
        } else {
            console.log(prdv)
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
                    $http.post($scope.base_url+'produksi-variable/insert.php', {
                        no_produksi: prdv.no_prd,
                        kode_produk: prdv.kode_produk,
                        tanggal_produksi: f_tgl(prdv.tanggal_produksi),
                        x: prdv.x
                    }).then(function(res){
                        if(res.data.success){
                            swal("Saved!", res.data.msg, "success");
                            $scope.prdv = {};
                            $scope.loadProdVar();
                            $('#formProduksiVariable').collapse('toggle')
                        } else {
                            swal("Ooppss..!", res.data.err, "error");
                            return;
                        }
                    })
                }, 1100)
            })
        }
    }

    $scope.onEditPV = function(pv){
        console.log(pv)
        $scope.currPV = pv;
        $('#modalEditPV').modal('toggle')
    }

    $scope.onUpdatePV = function(){
        if($scope.currPV.nama_material == ""){
            swal('Ooppss..!', 'Form Pengisian Belum Lengkap!', 'warning');
            return;
        } else {
            $http.post($scope.base_url+'produksi-variable/update.php', {
                no_produksi: $scope.currPV.no_produksi,
                kode_produk: $scope.currPV.nama_material,
            }).then(function(res){
                if(res.data.success){
                    swal("Saved!", res.data.msg, "success");
                    $scope.loadProdVar();
                    $('#modalEditPV').modal('toggle')
                } else {
                    swal("Ooppss..!!", res.data.err, "error");
                }
            })
        }
    }

    $scope.onDeletePV = function(pvid){
        swal({
            title: "Kamu Yakin Ingin Menghapus?",
            text: "Data NO: "+ pvid +" Akan Dihapus, Lanjutkan ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Lanjutkan!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(){
            setTimeout(function(){
                $http.post($scope.base_url+'produksi-variable/delete.php',{
                    no_produksi: pvid
                }).then(function(res){
                    if(res.data.success){
                        swal('Sukses', res.data.msg, 'success')
                        $scope.loadProdVar();
                    } else {
                        swal('Ooopss.!!', res.data.err, 'warning')
                        console.log(res)
                    }
                })
            }, 1100)
        })
    }

    $scope.onDetailPV = function(pvx){
        $('#modalDetailPV').modal('toggle')
        $scope.detailPVX = pvx;
    }

    $scope.onEditDetail = function(px){
        $('#modalEditX').modal('toggle')
        $scope.ex = px;
    }

    $scope.onUpdateDetail = function(){
        if($scope.ex.x1 == "" && $scope.ex.x2 == "" && $scope.ex.x3 == "" && $scope.ex.x4 == "" && $scope.ex.x5 == "" && $scope.ex.x6 == "" && $scope.ex.x7 == "" && $scope.ex.x8 == ""){
            swal('Oopss..!!', 'Pengisian Data Belum Lengkap!', 'error');
            return;
        } else {
            $scope._x[0] = $scope.ex.x1;
            $scope._x[1] = $scope.ex.x2;
            $scope._x[2] = $scope.ex.x3;
            $scope._x[3] = $scope.ex.x4;
            $scope._x[4] = $scope.ex.x5;
            $scope._x[5] = $scope.ex.x6;
            $scope._x[6] = $scope.ex.x7;
            $scope._x[7] = $scope.ex.x8;
            swal({
                title: "Simpan Perubahan ?",
                text: "Konfirmasi Jika Kamu Ingin Menyimpan data ini",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#5aa6fc",
                confirmButtonText: "Ya, Simpan!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function(){
                setTimeout(function(){
                   $http.post($scope.base_url+'produksi-variable/update-x.php', {
                       no_produksi: $scope.detailPVX.no_produksi,
                       x: $scope._x
                   }).then(function(res){
                       if(res.data.success){
                           swal("Saved!", res.data.msg, "success");
                           $('#modalEditX').modal('toggle');
                           $('#modalDetailPV').modal('toggle');
                           $scope.loadProdVar();
                       } else {
                           swal("OOppsss..!", res.data.err, "error");
                       }
                   })
                }, 1100)
            })
        }
    }

    function f_tgl(tglnya){
          var tgl = new Date(tglnya);
          var dd = tgl.getDate();
          var mm = tgl.getMonth()+1;
          var yyyy = tgl.getFullYear();
          if(dd < 10){
            dd = '0' + dd;
          }
          if(mm < 10){
            mm = '0' + mm;
          }
          //tgl = dd + '/' + mm + '/' + yyyy;
          tgl = yyyy + '/' + mm + '/' + dd;
          return tgl;
    }
})