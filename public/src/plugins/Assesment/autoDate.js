// Auto tanggal dan jam

$(document).ready(function () {
  var now = new Date();
  var jamNow = new Date().toLocaleTimeString();
  var month = (now.getMonth() + 1);
  var day = now.getDate();
  var jamSlice = jamNow.slice(0,8);
  var jamArr = jamSlice.split(/[^0-9]/);
  var jam = jamArr['0'];
  var detik = jamArr['2'].slice(0,2);
  var ampm =jamNow.split(' ');
    // console.log(ampm)
    if (ampm['1'] == "PM") {
      if (jam == "12"){
        jam = "12";
      } else {
        jam = parseInt(jam) + 12;
      }
    } else if(ampm['1'] == "AM"){
      if (jam =="12"){
        jam = "0"
      }
    } else {
      jam;
    }
    
    if (jam < 10){
      var jamOK = "0" + jam +':'+ jamArr['1']+':'+detik;
    } else { 
      var jamOK = jam +':'+ jamArr['1']+':'+detik;      
    }

    if (month < 10)
      month = "0" + month;
    if (day < 10)
      day = "0" + day;
    
    var hariNow = now.getDay();
    var hariOK;
    if (hariNow == "0"){
      hariOK ="Minggu";
    } else if (hariNow == "1"){
      hariOK ="Senin";
    } else if (hariNow == "2"){
      hariOK ="Selasa"; 
    } else if (hariNow == "3"){
      hariOK ="Rabu";
    } else if (hariNow == "4"){
      hariOK ="Kamis"; 
    } else if (hariNow == "5"){
      hariOK ="Jum'at";
    } else {
      hariOK ="Sabtu";
    }
    var tglNow = now.getFullYear() + '-' + month + '-' + day;
    var tahun=now.getFullYear();
    // console.log(tglNow);
    // console.log(jamOKSplit);
    var date_now= tglNow+" "+jamOK;
    $('.tgl_now').val(tglNow);
    $('.jam_now').val(jamOK);
    $('.hari_now').val(hariOK)
    $('.tahun_now').val(tahun)
    $('.date_now').val(date_now);
    // $("input[type='date']").val(tglNow);
    // $("input[type='time']").val(jamOK);
  });