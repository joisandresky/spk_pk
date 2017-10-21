var myApp = angular.module('myApp');

myApp.controller('THController', function($scope, $http){
    $scope.base_url = 'http://localhost/spk_pk/server/api/';
    $scope.data_th = [];
    $scope.store = {
        produksi: [],
        peta_kendali: {},
        produk: []
    }
    $scope.dtcc = [];
    $scope.pbcc = [];
    $scope.loadedData = false;
    $scope.tengah = 0;
    $scope.jc_selected = false;
    $scope.pb_selected = false;
    $scope.tindakan = null;
    $scope.fmea = {
      s: 0,
      o: 0,
      d: 0,
      rpn: 0
    }

    $scope.onJcChange = function(){
      $scope.jc_selected = true;
      if($scope.jc_selected){
        $scope.onGetPb($scope.jenis_cacat);
      }
    }

    $scope.onPbChange = function(){
      $scope.pb_selected = true;
    }

    $scope.onGetCCT = function(){
      $http.get($scope.base_url+'master-cacat/data.php').then(function(res){
        $scope.dtcc = res.data;
      })
    }

    $scope.onGetPb = function(kd){
      $http.post($scope.base_url+'master-cacat/data-pb.php', {
        kode_defect: kd
      }).then(function(res){
        $scope.pbcc = res.data;
        $scope.tindakan = res.data.tindakan;
      })
    }

    $scope.close = function(){
      $scope.jc_selected= false;
      $scope.pb_selected = false;
      $scope.jenis_cacat = "";
      $scope.penyebab = "";
    }

    $scope.hitungRpn = function(){
      if($scope.fmea.s === 0 && $scope.fmea.o === 0 && $scope.fmea.d === 0){
        return;
      } else {
        var rpn = $scope.fmea.s * $scope.fmea.o * $scope.fmea.d;
        $scope.fmea.rpn = rpn;
      }
    }

    $scope.simpanFmea = function(){
      if($scope.fmea.s === "" && $scope.fmea.o === "" && $scope.fmea.d === ""){
        return;
      } else {
        var jc = $('#jenis_cacat option:selected').text();
        var pb = $('#penyebab').val();
        var data = {
          jenis_cacat: jc,
          penyebab: pb,
          s: $scope.fmea.s,
          o: $scope.fmea.o,
          d: $scope.fmea.d,
          rpn: $scope.fmea.rpn,
          tindakan: $scope.tindakan
        }
        $http.post($scope.base_url+'master-cacat/insert-fmea.php', data).then(function(res){
          if(res.data.success){
            swal('Saved', res.data.msg, 'success');
            $('#formTambah').modal('hide');
            console.log(res)
          } else {
            swal('Saved', res.data.msg, 'error');
            console.log(res)
          }
        })
      }
    }

    $scope.loadProduk = function(){
        $http.get($scope.base_url+'produk/data.php').then(function(res){
            $scope.store.produk = res.data;
            console.log(res.data)
        })
    }

    $scope.hitungCL = function(CL, total_sample, jenis){
      var nilai = 0;
      if(jenis === "UCL"){
        nilai = CL + (3*Math.sqrt(CL*(1-CL)/total_sample));
      } else {
        nilai = CL - (3*Math.sqrt(CL*(1-CL)/total_sample));
      }
      return nilai;
    }

    $scope.cekPetaKendali = function(data){
        var currentData = data;
        if(currentData.startDate > currentData.endDate){
            swal('Oopss..!', 'Tanggal Awal Lebih Besar dari Tanggal Akhir !!!', 'warning')
        } else {
            $http.post($scope.base_url+'produksi/cek-kendali.php', {
                'start_date': currentData.startDate,
                'end_date': currentData.endDate,
                'kode_produk': currentData.kode_produk
            }).then(function(res){
                if(res.data.success){
                    $scope.store.produksi = res.data;
                    $scope.loadedData = true;
                } else {
                    swal('Oopss..!', 'Terjadi Masalah Ketika Menghubungkan Ke Server!', 'warning')
                    console.log(res)
                }
            })

            setTimeout(function(){
                var ts = [];
                var prd = [];
                var kd = [];
                for(var i = 0; i < $scope.store.produksi.produksi.length;i++){
                    ts.push(($scope.store.produksi.produksi[i].totalDefect / $scope.store.produksi.produksi[i].totalSample));
                    prd.push({
                        no_produksi: $scope.store.produksi.produksi[i].no_produksi,
                        tanggal_produksi: $scope.store.produksi.produksi[i].tanggal_produksi,
                        totalDefect: $scope.store.produksi.produksi[i].totalDefect,
                        totalSample:$scope.store.produksi.produksi[i].totalSample,
                        proporsi_cacat: ($scope.store.produksi.produksi[i].totalDefect / $scope.store.produksi.produksi[i].totalSample),
                        presentase: (($scope.store.produksi.produksi[i].totalDefect / $scope.store.produksi.produksi[i].totalSample) * 100)
                    })
                    kd.push($scope.store.produksi.produksi[i].no_produksi)

                }
                var totalPC = 0;
                for(var j = 0; j < ts.length; j++){
                    totalPC += ts[j];
                }

                var p = 0;
                var CL = 0;
                p = totalPC/ts.length;

                CL = p;
                var UCL = p + (3*(Math.sqrt((p*(1-p))/32)));
                var LCL = CL - (3*(Math.sqrt((CL*(1-CL))/32)));
                $scope.tengah = CL;
                $scope.store.peta_kendali = {
                    prd: prd,
                    P: p,
                    CL:CL,
                    LCL:LCL,
                    UCL: UCL
                }
                var names = [];
                var prods = [];
                // var BPA = [];
                // var BPB = [];
                // var GC = [];
                var BP = [];
                BP.push($scope.store.peta_kendali.UCL)
                BP.push($scope.store.peta_kendali.CL)
                BP.push($scope.store.peta_kendali.LCL)
                var tmpDate;
                for(var i = 0; i < $scope.store.peta_kendali.prd.length;i++){
                    prods.push($scope.store.peta_kendali.prd[i].proporsi_cacat);
                    names.push($scope.store.peta_kendali.prd[i].tanggal_produksi)
                }

                var sd = new Date($scope.cari.startDate);
                var ed = new Date($scope.cari.endDate);
                        Highcharts.chart('myChart', {
                            chart: {
                                type: 'line'
                            },
                            title: { text: 'Lapoaran Kendali Kualitas Produksi'},
                            subtitle:{
                                text: '(Per) ' + sd.getDate() + '/' + (sd.getMonth() + 1) + '/' + sd.getFullYear() + ' - ' + ed.getDate() + '/' + (ed.getMonth() + 1) + '/' + ed.getFullYear()
                            },
                            xAxis:{
                                title:{
                                    text: 'Index Produksi'
                                },
                                categories: names
                            },
                            yAxis: {
                                title: {
                                    text: 'Nilai'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                borderWidth: 0
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true
                                }
                            },
                            series:[
                                {
                                    "name": "Proporsi Cacat",
                                    "data": prods
                                },
                                {
                                    "name":"Batas Pengendali (BPA, Garis Tengah, BPB)",
                                    data: BP,
                                    dashStyle: 'longdash',
                                    color: '#BF0B23'
                                }
                            ]
                        })

                        // Highcharts.chart('container', {
                        //     chart: {
                        //         type: 'line'
                        //     },
                        //     title: { text: 'Peta Kendali Kualitas Produksi'},
                        //     xAxis:{
                        //         title:{
                        //             text: 'Data'
                        //         },
                        //         categories: ['Batas Kendali']
                        //     },
                        //     yAxis: {
                        //         title: {
                        //             text: 'Nilai'
                        //         }
                        //     },
                        //     legend: {
                        //         layout: 'vertical',
                        //         align: 'right',
                        //         verticalAlign: 'bottom',
                        //         borderWidth: 0
                        //     },
                        //     series:[

                                // {
                                //     "name":"BPB",
                                //     "data":BP[]
                                // },
                                // {
                                //     "name":"Garis Central",
                                //     "data":BP[]
                                // }
                        //     ]
                        // })

            }, 200)
        }
    }
})
