var myApp = angular.module('myApp');

myApp.controller('PKVController', function($scope, $http){
    $scope.base_url = 'http://localhost/spk_pk/server/api/';
    $scope.produk = []
    $scope.list_produksi = []
    $scope.xbar = [];
    $scope.rataXbar = 0;
    $scope.rataRbar = 0;
    $scope.TotalXbar = 0;
    $scope.TotalRbar = 0;

    $scope.batas = [];

    $scope.loadedDPV = false;

    $scope.loadMaterial = function(){
        $http.get($scope.base_url+'produk/data.php').then(function(res){
            if(res.data.success){
                $scope.produk = res.data.products;
            } else {
                $scope.produk = []
            }
        })
    }

    $scope.getAllNP = function(){
        var lppp = $scope.list_produksi;
        var names = new Array($scope.list_produksi.length+1);
        for(var i = 0; i < lppp.length;i++){
            names[i] = lppp[i].no_produksi;
        }
        return names;
    }

    $scope.cekKendali = function(peta){
        var CL = 0;
        var LCL = 0;
        var UCL = 0;
        var D3 = 0.136;
        var D4 = 1.864;
        var BP = [];
        var sd = new Date(peta.sd);
        var ed = new Date(peta.ed);
        var names = [];
        $http.post($scope.base_url+'produksi-variable/data-kendali.php', {
            start_date: peta.sd,
            end_date: peta.ed,
            kode_produk: peta.material
        }).then(function(res){
            if(res.data.success && res.data.pk.length > 0){
                $scope.list_produksi = res.data.pk;
                $scope.loadedDPV = true;
                setTimeout(function(){
                    names = $scope.getAllNP();
                    CL = parseFloat($scope.rataRbar);
                    var nLCL = D3 * CL;
                    var nUCL = D4 * CL;
                    BP.push(CL);
                    BP.push(nLCL);
                    BP.push(nUCL);
                    $scope.batas = BP;
                    Highcharts.chart('chartVariable', {
                        chart: {
                            type: 'line'
                        },
                        title: { text: 'Lapoaran Kendali Produksi Variable'},
                        subtitle:{
                            text: '(Per) ' + sd.getDate() + '/' + (sd.getMonth() + 1) + '/' + sd.getFullYear() + ' - ' + ed.getDate() + '/' + (ed.getMonth() + 1) + '/' + ed.getFullYear()
                        },
                        xAxis:{
                            title:{
                                text: 'Index Produksi'
                            },
                            categories: {
                                
                            }
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
                                "name": "Data R Bar",
                                "data": $scope.myRb
                            },
                            {
                                name: "Batas Pengendali (BPA, Garis Tengah, BPB)",
                                data: $scope.batas,
                                dashStyle: 'longdash',
                                color: '#BF0B23'
                            }
                        ]
                    })
                    Highcharts.chart('chartXbar', {
                        chart: {
                            type: 'bar'
                        },
                        title: {text: "Xbar"},
                        subtitle: { text: 'Peta Kendali Xbar'},
                        yAxis: {
                            title: {
                                text: 'Nilai'
                            }
                        },
                        legend: {
                            layout: 'horizontal',
                            align: 'bottom',
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
                                "name": "A2",
                                "data": [0.373]
                            }
                        ]
                    })
                }, 1000)
            } else if(res.data.success && res.data.pk.length == 0){
                swal("Data Gak Ada Gan!");
            } else {
                swal("Ooppss..!!", res.data.msg + '\n' +res.data.err, "error");
            }
        })
    }

    $scope.hitungXbar = function(lp){
        var myx = [
                    lp.x1, 
                    lp.x2,
                    lp.x3,
                    lp.x4,
                    lp.x5,
                    lp.x6,
                    lp.x7,
                    lp.x8
                ]
        var nilai = 0;
        for(var i = 0; i < myx.length;i++){
            nilai += parseFloat(myx[i]);
        }
        var n = nilai/myx.length;
        return parseFloat(n).toFixed(2)
    }

    $scope.getXbar = function(){
        var lp = $scope.list_produksi;
        var myx = [];
        var nilai = 0;
        var n = 0;
        $scope.xbar = new Array($scope.list_produksi.length)
        for(var i = 0; i < lp.length;i++){
            $scope.xbar[i] = $scope.hitungXbar(lp[i]);
            nilai += parseFloat($scope.hitungXbar(lp[i]));
        }
        n = nilai / lp.length;
        $scope.rataXbar = parseFloat(n).toFixed(2);
        $scope.TotalXbar = parseFloat(nilai).toFixed(2);
    }

    $scope.max = function(lp){
        var myx = [
            lp.x1, 
            lp.x2,
            lp.x3,
            lp.x4,
            lp.x5,
            lp.x6,
            lp.x7,
            lp.x8
        ]
        var temp = 0;
        for(var i = 0; i < myx.length;i++){
            if(i == 0){
                temp = parseFloat(myx[i])
            } else {
                if(parseFloat(myx[i]) > temp){
                    temp = parseFloat(myx[i]);
                }
            }
        }
        return temp;
    }

    $scope.min = function(lp){
        var myx = [
            lp.x1, 
            lp.x2,
            lp.x3,
            lp.x4,
            lp.x5,
            lp.x6,
            lp.x7,
            lp.x8
        ]
        var temp = 0;
        for(var i = 0; i < myx.length;i++){
            if(i == 0){
                temp = parseFloat(myx[i])
            } else {
                if(parseFloat(myx[i]) < temp){
                    temp = parseFloat(myx[i]);
                }
            }
        }
        return temp;
    }

    $scope.Rbar = function(max, min){
        var val = max - min;
        return Math.round10(val, -3)
    }

    $scope.getRbar = function(){
        var lpp = $scope.list_produksi;
        var nilai = 0;
        var n = 0;
        $scope.myRb = new Array($scope.list_produksi.length);
        for(var i = 0; i < lpp.length;i++){
            $scope.myRb[i] = $scope.Rbar($scope.max(lpp[i]), $scope.min(lpp[i]));
            nilai += parseFloat($scope.Rbar($scope.max(lpp[i]), $scope.min(lpp[i])));
        }
        n = nilai / lpp.length;
        $scope.rataRbar = parseFloat(n).toFixed(2);
        $scope.TotalRbar = parseFloat(nilai).toFixed(2);
    }
})