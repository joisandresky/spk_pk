var myApp = angular.module('myApp');

myApp.controller('PController', function($scope, $http){
    $scope.base_url = 'http://localhost/spk_pk/server/api/';
    $scope.data_produksi = [];
    $scope.dt_produk = [];
    $scope.dt_defects = [];
    $scope.newProduksi = {};
    $scope.curProduksi = {};
    $scope.curDetail = {};
    $scope.selected = {};
    $scope.showEditDetail = false;
    $scope.filtered_produksi = [];

    $scope.tempData = {};
    $scope.box_detail = [];
    $scope.countedData = [];
    $scope.dataCounted = {};
    $scope.all_produksi = [];
    $scope.df = [];
    $scope.data_df = [];

    $scope.hideAngkaPeriode = {
        satu: false,
        dua: false,
        tiga: false,
        empat: false
    }

    $scope.hidePeriode = false;

    $scope.state = {
        periode: 0
    }

    $scope.getProduksi = function(){
        $http.get($scope.base_url+'produksi/data.php').then(function(res){
            if(res.data.success){
                $scope.data_produksi = res.data;
            } else {
                swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
            }
        })
    }

    $scope.getAllProduk = function(){
        $http.get($scope.base_url+'produk/data.php').then(function(res){
            if(res.data.success){
                $scope.dt_produk = res.data;
            } else {
                swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
            }
        })
    }

    $scope.getDefects = function(){
        $http.get($scope.base_url+'master-cacat/data.php').then(function(res){
            if(res.data.success){
                $scope.dt_defects = res.data;
            } else {
                swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
            }
        })
    }

    $scope.uraiKodeDefect = function(no_produksi){
        var tempDefect = [];
        for(var i = 0;i < $scope.all_produksi.length;i++){
            if($scope.all_produksi[i].no_produksi === no_produksi){
                tempDefect.push($scope.all_produksi[i].defect_pertama)
                tempDefect.push($scope.all_produksi[i].defect_kedua)
                tempDefect.push($scope.all_produksi[i].defect_ketiga)
            }
        }
        //  5, 7, 10, 5, 3, 8, 7, 3, 8, 8, 2, 4
        // 5, 7, 10, 3, 8, 2, 4
        setTimeout(function(){
            var temp = 0;
            var dataDefect = [];
            var j = 0;
            for(var x = 0; x < tempDefect.length;x++){
                temp = tempDefect[x];
                for(var j = tempDefect.length; j > x;j--){
                    if(temp == tempDefect[j]){
                        tempDefect.splice(j, 1);
                    }
                }
            }

            setTimeout(function(){
                $scope.getDefectDetail(tempDefect);
            }, 100)
        }, 200)
    }

    $scope.getDefectDetail = function(data){
        var dataTemp = [];
        $scope.data_df = [];
            for(var i = 0; i < data.length;i++){
                $http.post('http://localhost/spk_pk/server/api/master-cacat/data-where.php', {
                    'kode_defect': data[i]
                }).then(function(res){
                    if(res.data.success){
                        dataTemp.push(res.data.detail_defect);
                        $scope.data_df = dataTemp;
                    } else {
                        swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
                    }
                })
            }
    }

    $scope.getAllProduksi = function(){
        $http.get($scope.base_url+'produksi/data-all.php').then(function(res){
            $scope.all_produksi = res.data.produksi;
        })
    }

    $scope.getFilteredProduksi = function(data){
        $http.post($scope.base_url+'produksi/data-id.php', {
            "no_produksi": data.no_produksi
        }).then(function(res){
            if(res.data.success){
                $scope.countedData = res.data;

                var totalSample = 0;
                    var totalDefect = 0;
                    for(var k = 0; k < $scope.countedData.produksi.length;k++){
                        totalSample += parseInt($scope.countedData.produksi[k].sample);
                        totalDefect += parseInt($scope.countedData.produksi[k].jumlah_defect)
                    }

                    var data = {
                        countedData: $scope.countedData.produksi,
                        totalSample: totalSample,
                        totalDefect: totalDefect
                    }

                    $scope.dataCounted = data;
                    setTimeout(function(){
                        $('#modalViewData').modal('toggle');
                    }, 100)
            } else {
                swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
            }
        })

    }
    $scope.tambahDetailData = function(data){
        if(data.sample < 0 || data.jumlah_defect < 0 || data.sample == undefined || data.jumlah_defect == undefined){
            swal('Ooopss..!', 'Jumlah Sample atau Defect tidak Boleh Kurang Dari 0 dan Harus Diisi', 'warning')
        } else {
            switch($scope.state.periode){
                case 0:
                    $scope.box_detail.push(data);
                    $scope.tempData = {};
                    $scope.hideAngkaPeriode.satu = true;
                    $scope.state.periode++;
                    swal('OK', 'DATA Periode' + $scope.state.periode + 'Telah Ditambahkan', 'success')
                break;
                case 1:
                    $scope.box_detail.push(data);
                    $scope.tempData = {};
                    $scope.hideAngkaPeriode.dua = true;
                    $scope.state.periode++;
                    swal('OK', 'DATA Periode ' + $scope.state.periode + 'Telah Ditambahkan', 'success')
                break;
                case 2:
                    $scope.box_detail.push(data);
                    $scope.tempData = {};
                    $scope.hideAngkaPeriode.tiga = true;
                    $scope.state.periode++;
                    swal('OK', 'DATA Periode ' + $scope.state.periode + 'Telah Ditambahkan', 'success')
                break;
                case 3:
                    $scope.box_detail.push(data);
                    $scope.tempData = {};
                    $scope.hideAngkaPeriode.tiga = true;
                    $scope.state.periode++;
                    swal('OK', 'DATA Periode ' + $scope.state.periode + 'Telah Ditambahkan', 'success')
                break;
                case 4:
                    $scope.box_detail.push(data);
                    $scope.tempData = {};
                    $scope.hideAngkaPeriode.empat = true;
                    $scope.state.periode++;
                break;
            }

            if($scope.state.periode === 4){
                $scope.state.periode = 0;
                $scope.hidePeriode = true;
                $('#formNewPeriode').modal('hide');
                swal('OK', 'Semua Periode Telah Ditambahkan', 'info')
            }
        }
    }

    $scope.formatTgl = function(tglNya){
        var dt = new Date(tglNya);
        var tgl = dt.getDate();
        var bln = dt.getMonth() + 1;
        var thn = dt.getFullYear();
        if(tgl < 10){
            tgl = '0' + tgl;
        }
        if(bln < 10){
            bln = '0' + bln;
        }
        var tgl_full = thn + "-" + bln + "-" + tgl;
        return tgl_full;
    }

    $scope.onNewProduksi = function(){
        var tgl_prd = $scope.formatTgl($scope.newProduksi.tanggal_produksi);
        if($scope.newProduksi.no_produksi === undefined || $scope.newProduksi.kode_produk === undefined || $scope.newProduksi.tanggal_produksi === undefined || $scope.newProduksi.kode_produk === '-'){
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
                    $http.post($scope.base_url+'produksi/insert.php', {
                        "no_produksi": $scope.newProduksi.no_produksi,
                        "kode_produk": $scope.newProduksi.kode_produk,
                        "tanggal_produksi": tgl_prd
                    }).then(function(res){
                        if(res.data.success){
                            setTimeout(function(){
                                var store = $scope.box_detail;
                                for(var x = 0; x < store.length;x++){
                                    $http.post($scope.base_url+'produksi/insert-detail.php', {
                                        "no_produksi": $scope.newProduksi.no_produksi,
                                        "periode": store[x].periode,
                                        "sample": store[x].sample,
                                        "jumlah_defect": store[x].jumlah_defect,
                                        "kode_ket_defect": store[x].kode_ket_defect,
                                        "action_inspector": store[x].action_inspector
                                    }).then(function(res){
                                        if(res.data.success){
                                            $scope.getProduksi();
                                        } else {
                                            swal('Oopss..!', 'Gagal Menyimpan Detail Data!', 'error');
                                        }
                                    })
                                }
                                var storeDua = $scope.box_detail;
                                            for(var k = 0; k < storeDua.length; k++){
                                                $http.post($scope.base_url+'produksi/insert-detail-defect.php', {
                                                    "kode_ket_defect": storeDua[k].kode_ket_defect,
                                                    "defect_pertama": storeDua[k].ket_defect.dp,
                                                    "defect_kedua": storeDua[k].ket_defect.dk,
                                                    "defect_ketiga": storeDua[k].ket_defect.dkt
                                                }).then(function(res){
                                                    if(res.data.success){
                                                        swal('Sukses', 'Data Berhasil Disimpan', 'success')
                                                        $scope.getProduksi();
                                                        setTimeout(function(){
                                                            reset();
                                                        }, 500)
                                                    } else {
                                                        swal('oops');
                                                    }
                                                })
                                            }
                            }, 500)
                        } else {
                            console.log(res);
                            swal('Oopss..!', 'Gagal Menyimpan Data!', 'error');
                        }
                    })
                }, 2000)
            })
        }
    }

    function reset(){
        $scope.box_detail = [];
        $scope.newProduksi = {};
        $scope.getProduksi();
        $scope.tempData ={};
        $scope.hidePeriode = false;
        $('#formNewProduksi').collapse('toggle');
    }

    $scope.onEditProduksi = function(data){
        $scope.curProduksi = data;
        var fp = [];
        for(var i = 0; i < $scope.dt_produk.products.length;i++){
            if($scope.dt_produk.products[i].kode_produk != data.kode_produk){
                fp.push($scope.dt_produk.products[i]);
            }
        }
        $scope.filtered_produksi = fp;
    }

    $scope.onEditDetail = function(data){
        console.log(data)
        $scope.curDetail = data;
        $('#modalEditDetailProduksi').modal('toggle')
    }

    $scope.updateDetail = function(updatedDetail){
        var updt = updatedDetail;
        $http.post($scope.base_url+'produksi/update-detail.php',
            {
                "no_detail_produksi": updatedDetail.no_detail_produksi,
                "sample": updatedDetail.sample,
                "jumlah_defect": updatedDetail.jumlah_defect,
                "kode_ket_defect": updatedDetail.kode_ket_defect,
                "action_inspector": updatedDetail.action_inspector
            }).then(function(res){
            if(res.data.success){
                swal('Sukses', 'Data Telah di Update!', 'info');
                $scope.getProduksi()
                $('#modalEditDetailProduksi').modal('hide');
            } else {
                swal('Oopss..!', 'Gagal Mengupdate Data! Terjadi Error Di Server', 'warning')
            }
        })
    }

    $scope.onUpdateProduksi = function(updatedProduksi){
        $http.post($scope.base_url+'produksi/update.php',
            {
                "no_produksi": updatedProduksi.no_produksi,
                "kode_produk": updatedProduksi.kode_produk,
                "tanggal_produksi": updatedProduksi.tanggal_produksi
            }).then(function(res){
            if(res.data.success){
                swal('Sukses', 'Data Telah di Update!', 'info');
                $scope.getProduksi()
                $('#formEditProduksi').modal('hide');
            } else {
                swal('Oopss..!', 'Gagal Mengupdate Data! Terjadi Error Di Server', 'warning')
            }
        })
    }


    $scope.onHapusProduksi = function(data){
        swal({
            title: "Kamu Yakin Ingin Menghapus?",
            text: "Data "+ data.nama_material+ "(NO: " + data.no_produksi + ")" +" Akan Dihapus, Lanjutkan ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Lanjutkan!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(){
            setTimeout(function(){
                $http.post($scope.base_url+'produksi/delete.php',
                    {"no_produksi" : data.no_produksi }).then(function(res){
                    if(res.data.success){
                        $http.post($scope.base_url+'produksi/delete-detail.php',
                            {"no_produksi" : data.no_produksi }).then(function(res){
                            if(res.data.success){
                                swal('Sukses', 'Berhasil Menghapus Data', 'success')
                                $scope.getProduksi();
                            } else {
                                swal('Ooopss.!!', 'Gagal Menghapus Data, Ada Masalah Di Server', 'warning')
                            }
                        })
                        $http.post($scope.base_url+'produksi/delete-ket-defect.php',
                            {"kode_ket_defect" : data.kode_ket_defect }).then(function(res){
                            if(res.data.success){
                                swal('Sukses', 'Berhasil Menghapus Data', 'success')
                                $scope.getProduksi();
                            } else {
                                swal('Ooopss.!!', 'Gagal Menghapus Data, Ada Masalah Di Server', 'warning')
                            }
                        })
                        $scope.getProduksi();
                    } else {
                        swal('Ooopss.!!', 'Gagal Menghapus Data, Ada Masalah Di Server', 'warning')
                    }
                })
            }, 1100)
        })
    }

})