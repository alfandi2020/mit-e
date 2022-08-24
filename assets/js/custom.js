
$(function() {
    $('a').filter(function() {
        return this.href == location.href
    }).parent().addClass('active').siblings().removeClass('active')
})

// for sidebar menu entirely but not cover treeview
$('ul.navigation .nav-item a').filter(function() {
    return this.href == location.href
}).parent().addClass('active');

// for treeview
$('ul.nav-collapse li a').filter(function() {
    return this.href == location.href
}).parentsUntil(".nav > .nav.nav-collapse li a").addClass('active');

$('div.collapse li a').filter(function() {
    return this.href == location.href
}).parentsUntil(".nav > collapse li a").addClass('show');


$(document).ready( function () {
    $('#upload').attr('hidden',true);
    // $("#file").change(function(){
    //     const fileupload = $('#file').prop('files')[0];
    //     if (fileupload!="") {
    //         let formData = new FormData();
    //         formData.append('file', fileupload);
    //         // formData.append('nama_file', nama_file);
    //         // console.log(basepath)
    //         $.ajax({
    //             type: 'POST',
    //             url: "upload_file",
    //             data: formData,
    //             dataType: "json",
    //             contentType: false,
    //             processData: false,
    //             async: true,
    //             success: function (data) {
    //                 console.log(Object.keys(data).length)
    //                     $.ajax({
    //                         type: 'POST',
    //                         url: "submit_upload",
    //                         data : data,
    //                         dataType: 'json',
    //                         async: true,
    //                         success: function(res){
    //                             console.log(res)
    //                             const x = Object.keys(data).length;
    //                             var element = '';
    //                             const element2 = 
    //                             '<tr>'+
    //                             '<th>' + data[1].A + '  <th>'+
    //                             '<th>' + data[1].B + '<th>'+
    //                             '<th>' + data[1].C + '<th>'+
    //                             '<th>' + data[1].D + '<th>'+
    //                             '<th>' + data[1].E + '<th>'+
    //                             '<th>' + data[1].F + '<th>'+
    //                             '<th>' + data[1].G + '<th>'+
    //                             '<th>' + data[1].H + '<th>'+
    //                             '<th>' + data[1].I + '<th>'+
    //                             '<th>' + data[1].J + '<th>'+
    //                             '<th>' + data[1].K + '<th>'+
    //                             '<th>' + data[1].L + '<th>'+
    //                             '<th>' + data[1].M + '<th>'+
    //                             '<th>' + data[1].N + '<th>'+
    //                             '<th>' + data[1].O + '<th>'+
    //                             '<th>' + data[1].P + '<th>'+
    //                             '<th>' + data[1].Q + '<th>'+
    //                             '<th>' + data[1].R + '<th>'+
    //                             '<th>' + data[1].S + '<th>'+
    //                             '<th>' + data[1].T + '<th>'+
    //                             '<th>' + data[1].U + '<th>'+
    //                             '<th>' + data[1].V + '<th>'+
    //                             '<th>' + data[1].W + '<th>'+
    //                             '<th>' + data[1].X + '<th>'+
    //                             '<th>' + data[1].Y + '<th>'+
    //                             '<th>' + data[1].Z + '<th>'+
    //                             '<th>Saldo Akhir<th>'+
    //                             '</tr>';
    //                             for (let k = 2; k < Object.keys(data).length+1; k++) {
    //                                 var saldo_x = data[k].U;
    //                                 // if (Object.keys(data).length > 2) {
    //                                 element += 
    //                                 '<tr>' + 
    //                                 '<td>' + data[k].A + '<td>'+
    //                                 '<td>' + data[k].B + '<td>'+
    //                                 '<td>' + data[k].C + '<td>'+
    //                                 '<td>' + data[k].D + '<td>'+
    //                                 '<td>' + data[k].E + '<td>'+
    //                                 '<td>' + data[k].F + '<td>'+
    //                                 '<td>' + data[k].G + '<td>'+
    //                                 '<td>' + data[k].H + '<td>'+
    //                                 '<td>' + data[k].I + '<td>'+
    //                                 '<td>' + data[k].J + '<td>'+
    //                                 '<td>' + data[k].K + '<td>'+
    //                                 '<td>' + data[k].L + '<td>'+
    //                                 '<td>' + data[k].M + '<td>'+
    //                                 '<td>' + data[k].N + '<td>'+
    //                                 '<td>' + data[k].O + '<td>'+
    //                                 '<td>' + data[k].P + '<td>'+
    //                                 '<td>' + data[k].Q + '<td>'+
    //                                 '<td>' + data[k].R + '<td>'+
    //                                 '<td>' + data[k].S + '<td>'+
    //                                 '<td>' + data[k].T + '<td>'+
    //                                 '<td>' + data[k].U + '<td>'+
    //                                 '<td>' + data[k].V + '<td>'+
    //                                 '<td>' + data[k].W + '<td>'+
    //                                 '<td>' + data[k].X + '<td>'+
    //                                 '<td>' + data[k].Y + '<td>'+
    //                                 '<td>' + data[k].Z + '<td>'+
    //                                 '<td>' + res[k-1] + '<td>'+
    //                                '</tr>';
    //                               }
    //                             $('#head2').html(element2)
    //                             $('#body2').html(element)
    //                             $('.zero-configuration2').DataTable({
    //                                 stateSave: true,
    //                                 "bDestroy": true,
    //                                 order: [[1, 'asc']]
    //                             });
    //                         // }

    //                         },
    //                         error: function (error) {
    //                             alert("Data gagal tampil");
    //                             console.log(error)
    //                         }
    //                     })
                        
    //                     // if (x > 1) {
    //                     //     $('#upload').attr('hidden',false);
    //                     // }

    //             },
    //             error: function (error) {
    //                 alert("Data Gagal Diupload");
    //                 console.log(error)
    //             }
    //         });
    //     }
    // });
    $('#preview_submit').click(function(){
        // e.preventDefault();
        const fileupload = $('#filex').prop('files')[0];
        if (fileupload!="") {
            let formData = new FormData();
            formData.append('filex', fileupload);
            // formData.append('nama_file', nama_file);
            // console.log(basepath)
            $.ajax({
                type: 'POST',
                url: "upload_file",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                async: true,
                success: function (data) {
                    const x = Object.keys(data).length;
                                var element = '';
                                const element2 = 
                                '<tr>'+
                                '<th>' + data[1].A + '  <th>'+
                                '<th>' + data[1].B + '<th>'+
                                '<th>' + data[1].C + '<th>'+
                                '<th>' + data[1].D + '<th>'+
                                '<th>' + data[1].E + '<th>'+
                                '<th>' + data[1].F + '<th>'+
                                '<th>' + data[1].G + '<th>'+
                                '<th>' + data[1].H + '<th>'+
                                '<th>' + data[1].I + '<th>'+
                                '<th>' + data[1].J + '<th>'+
                                '<th>' + data[1].K + '<th>'+
                                '<th>' + data[1].L + '<th>'+
                                '<th>' + data[1].M + '<th>'+
                                '<th>' + data[1].N + '<th>'+
                                '<th>' + data[1].O + '<th>'+
                                '<th>' + data[1].P + '<th>'+
                                '<th>' + data[1].Q + '<th>'+
                                '<th>' + data[1].R + '<th>'+
                                '<th>' + data[1].S + '<th>'+
                                '<th>' + data[1].T + '<th>'+
                                '<th>' + data[1].U + '<th>'+
                                '<th>' + data[1].V + '<th>'+
                                '<th>' + data[1].W + '<th>'+
                                '<th>' + data[1].X + '<th>'+
                                '<th>' + data[1].Y + '<th>'+
                                '<th>' + data[1].Z + '<th>'+
                                '<th>Saldo Akhir<th>'+
                                '</tr>';
                                for (let k = 2; k < Object.keys(data).length+1; k++) {
                                    var saldo_x = data[k].U;
                                    // if (Object.keys(data).length > 2) {
                                    element += 
                                    '<tr>' + 
                                    '<td>' + data[k].A + '<td>'+
                                    '<td>' + data[k].B + '<td>'+
                                    '<td>' + data[k].C + '<td>'+
                                    '<td>' + data[k].D + '<td>'+
                                    '<td>' + data[k].E + '<td>'+
                                    '<td>' + data[k].F + '<td>'+
                                    '<td>' + data[k].G + '<td>'+
                                    '<td>' + data[k].H + '<td>'+
                                    '<td>' + data[k].I + '<td>'+
                                    '<td>' + data[k].J + '<td>'+
                                    '<td>' + data[k].K + '<td>'+
                                    '<td>' + data[k].L + '<td>'+
                                    '<td>' + data[k].M + '<td>'+
                                    '<td>' + data[k].N + '<td>'+
                                    '<td>' + data[k].O + '<td>'+
                                    '<td>' + data[k].P + '<td>'+
                                    '<td>' + data[k].Q + '<td>'+
                                    '<td>' + data[k].R + '<td>'+
                                    '<td>' + data[k].S + '<td>'+
                                    '<td>' + data[k].T + '<td>'+
                                    '<td>' + data[k].U + '<td>'+
                                    '<td>' + data[k].V + '<td>'+
                                    '<td>' + data[k].W + '<td>'+
                                    '<td>' + data[k].X + '<td>'+
                                    '<td>' + data[k].Y + '<td>'+
                                    '<td>' + data[k].Z + '<td>'+
                                    // '<td>' + res[k-1] + '<td>'+
                                    '<td>' + 22 + '<td>'+
                                   '</tr>';
                                  }
                                $('#head2').html(element2)
                                $('#body2').html(element)
                                $('.zero-configuration2').DataTable({
                                    stateSave: true,
                                    "bDestroy": true,
                                    order: [[1, 'asc']]
                                });
                        // $.ajax({
                        //     type: 'POST',
                        //     url: "submit_upload",
                        //     data : data,
                        //     dataType: 'json',
                        //     async: true,
                        //     success: function(res){
                        //         console.log(res)
                        //         // const x = Object.keys(data).length;
                        //         // var element = '';
                        //         // const element2 = 
                        //         // '<tr>'+
                        //         // '<th>' + data[1].A + '  <th>'+
                        //         // '<th>' + data[1].B + '<th>'+
                        //         // '<th>' + data[1].C + '<th>'+
                        //         // '<th>' + data[1].D + '<th>'+
                        //         // '<th>' + data[1].E + '<th>'+
                        //         // '<th>' + data[1].F + '<th>'+
                        //         // '<th>' + data[1].G + '<th>'+
                        //         // '<th>' + data[1].H + '<th>'+
                        //         // '<th>' + data[1].I + '<th>'+
                        //         // '<th>' + data[1].J + '<th>'+
                        //         // '<th>' + data[1].K + '<th>'+
                        //         // '<th>' + data[1].L + '<th>'+
                        //         // '<th>' + data[1].M + '<th>'+
                        //         // '<th>' + data[1].N + '<th>'+
                        //         // '<th>' + data[1].O + '<th>'+
                        //         // '<th>' + data[1].P + '<th>'+
                        //         // '<th>' + data[1].Q + '<th>'+
                        //         // '<th>' + data[1].R + '<th>'+
                        //         // '<th>' + data[1].S + '<th>'+
                        //         // '<th>' + data[1].T + '<th>'+
                        //         // '<th>' + data[1].U + '<th>'+
                        //         // '<th>' + data[1].V + '<th>'+
                        //         // '<th>' + data[1].W + '<th>'+
                        //         // '<th>' + data[1].X + '<th>'+
                        //         // '<th>' + data[1].Y + '<th>'+
                        //         // '<th>' + data[1].Z + '<th>'+
                        //         // '<th>Saldo Akhir<th>'+
                        //         // '</tr>';
                        //         // for (let k = 2; k < Object.keys(data).length+1; k++) {
                        //         //     var saldo_x = data[k].U;
                        //         //     // if (Object.keys(data).length > 2) {
                        //         //     element += 
                        //         //     '<tr>' + 
                        //         //     '<td>' + data[k].A + '<td>'+
                        //         //     '<td>' + data[k].B + '<td>'+
                        //         //     '<td>' + data[k].C + '<td>'+
                        //         //     '<td>' + data[k].D + '<td>'+
                        //         //     '<td>' + data[k].E + '<td>'+
                        //         //     '<td>' + data[k].F + '<td>'+
                        //         //     '<td>' + data[k].G + '<td>'+
                        //         //     '<td>' + data[k].H + '<td>'+
                        //         //     '<td>' + data[k].I + '<td>'+
                        //         //     '<td>' + data[k].J + '<td>'+
                        //         //     '<td>' + data[k].K + '<td>'+
                        //         //     '<td>' + data[k].L + '<td>'+
                        //         //     '<td>' + data[k].M + '<td>'+
                        //         //     '<td>' + data[k].N + '<td>'+
                        //         //     '<td>' + data[k].O + '<td>'+
                        //         //     '<td>' + data[k].P + '<td>'+
                        //         //     '<td>' + data[k].Q + '<td>'+
                        //         //     '<td>' + data[k].R + '<td>'+
                        //         //     '<td>' + data[k].S + '<td>'+
                        //         //     '<td>' + data[k].T + '<td>'+
                        //         //     '<td>' + data[k].U + '<td>'+
                        //         //     '<td>' + data[k].V + '<td>'+
                        //         //     '<td>' + data[k].W + '<td>'+
                        //         //     '<td>' + data[k].X + '<td>'+
                        //         //     '<td>' + data[k].Y + '<td>'+
                        //         //     '<td>' + data[k].Z + '<td>'+
                        //         //     '<td>' + res[k-1] + '<td>'+
                        //         //    '</tr>';
                        //         //   }
                        //         // $('#head2').html(element2)
                        //         // $('#body2').html(element)
                        //         // $('.zero-configuration2').DataTable({
                        //         //     stateSave: true,
                        //         //     "bDestroy": true,
                        //         //     order: [[1, 'asc']]
                        //         // });
                        //     // }

                        //     },
                        //     error: function (error) {
                        //         alert("Data gagal tampil");
                        //         console.log(error)
                        //     }
                        // })
                        
                        // if (x > 1) {
                        //     $('#upload').attr('hidden',false);
                        // }

                },
                error: function (error) {
                    alert("Data Gagal Diupload");
                    console.log(error)
                }
            });
        }
    })
    $('#upload_submit').click(function(){
        // e.preventDefault();
        const fileupload = $('#filex').prop('files')[0];
        if (fileupload!="") {
            let formData = new FormData();
            formData.append('filex', fileupload);
            // formData.append('nama_file', nama_file);
            // console.log(basepath)
            $.ajax({
                type: 'POST',
                url: "upload_file",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                async: true,
                success: function (data) {
                    console.log(Object.keys(data).length)
                        $.ajax({
                            type: 'POST',
                            url: "submit_upload",
                            data : data,
                            dataType: 'json',
                            async: true,
                            success: function(res){
                                console.log(res)
                                const x = Object.keys(data).length;
                                var element = '';
                                const element2 = 
                                '<tr>'+
                                '<th>' + data[1].A + '  <th>'+
                                '<th>' + data[1].B + '<th>'+
                                '<th>' + data[1].C + '<th>'+
                                '<th>' + data[1].D + '<th>'+
                                '<th>' + data[1].E + '<th>'+
                                '<th>' + data[1].F + '<th>'+
                                '<th>' + data[1].G + '<th>'+
                                '<th>' + data[1].H + '<th>'+
                                '<th>' + data[1].I + '<th>'+
                                '<th>' + data[1].J + '<th>'+
                                '<th>' + data[1].K + '<th>'+
                                '<th>' + data[1].L + '<th>'+
                                '<th>' + data[1].M + '<th>'+
                                '<th>' + data[1].N + '<th>'+
                                '<th>' + data[1].O + '<th>'+
                                '<th>' + data[1].P + '<th>'+
                                '<th>' + data[1].Q + '<th>'+
                                '<th>' + data[1].R + '<th>'+
                                '<th>' + data[1].S + '<th>'+
                                '<th>' + data[1].T + '<th>'+
                                '<th>' + data[1].U + '<th>'+
                                '<th>' + data[1].V + '<th>'+
                                '<th>' + data[1].W + '<th>'+
                                '<th>' + data[1].X + '<th>'+
                                '<th>' + data[1].Y + '<th>'+
                                '<th>' + data[1].Z + '<th>'+
                                '<th>Saldo Akhir<th>'+
                                '</tr>';
                                for (let k = 2; k < Object.keys(data).length+1; k++) {
                                    var saldo_x = data[k].U;
                                    // if (Object.keys(data).length > 2) {
                                    element += 
                                    '<tr>' + 
                                    '<td>' + data[k].A + '<td>'+
                                    '<td>' + data[k].B + '<td>'+
                                    '<td>' + data[k].C + '<td>'+
                                    '<td>' + data[k].D + '<td>'+
                                    '<td>' + data[k].E + '<td>'+
                                    '<td>' + data[k].F + '<td>'+
                                    '<td>' + data[k].G + '<td>'+
                                    '<td>' + data[k].H + '<td>'+
                                    '<td>' + data[k].I + '<td>'+
                                    '<td>' + data[k].J + '<td>'+
                                    '<td>' + data[k].K + '<td>'+
                                    '<td>' + data[k].L + '<td>'+
                                    '<td>' + data[k].M + '<td>'+
                                    '<td>' + data[k].N + '<td>'+
                                    '<td>' + data[k].O + '<td>'+
                                    '<td>' + data[k].P + '<td>'+
                                    '<td>' + data[k].Q + '<td>'+
                                    '<td>' + data[k].R + '<td>'+
                                    '<td>' + data[k].S + '<td>'+
                                    '<td>' + data[k].T + '<td>'+
                                    '<td>' + data[k].U + '<td>'+
                                    '<td>' + data[k].V + '<td>'+
                                    '<td>' + data[k].W + '<td>'+
                                    '<td>' + data[k].X + '<td>'+
                                    '<td>' + data[k].Y + '<td>'+
                                    '<td>' + data[k].Z + '<td>'+
                                    '<td>' + res[k-1] + '<td>'+
                                   '</tr>';
                                  }
                                $('#head2').html(element2)
                                $('#body2').html(element)
                                $('.zero-configuration2').DataTable({
                                    stateSave: true,
                                    "bDestroy": true,
                                    order: [[1, 'asc']]
                                });
                            // }

                            },
                            error: function (error) {
                                alert("Data gagal tampil");
                                console.log(error)
                            }
                        })
                        
                        // if (x > 1) {
                        //     $('#upload').attr('hidden',false);
                        // }

                },
                error: function (error) {
                    alert("Data Gagal Diupload");
                    console.log(error)
                }
            });
        }
    })
});

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    
    const href = $(this).attr('href');
    Swal.fire({
    title: 'Yakin Hapus Data?',
    text: "Data Akan di delete !",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-danger ml-1',
    confirmButtonText: 'Ya, Hapus Data'
    }).then((result) => {
       
    if (result.value) {
        Swal.fire(
            {
              type: "success",
              title: 'Deleted!',
              text: 'Data berhasil didelete',
              confirmButtonClass: 'btn btn-success',
            }
          )
        setTimeout(() => {
            document.location.href = href;
        }, 2000);
    }else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cencel',
          text: 'Data cancel delete',
          type: 'error',
          confirmButtonClass: 'btn btn-success',
        })
      }
    })
});
// $('input[name="identitas"]').change(function(f) {
//     let selectedValA = $(this).val();
//     let isAChecked = $(this).prop("checked");
//     console.log(selectedValA)
//     $(`.ktp_simChange[value=${selectedValA}]`).prop("checked", isAChecked);
// });
function salindata(f) {
    //kiri data clone
    if (f.salin_to.checked == true) {
        f.t_nama.value = f.nama.value;
        f.t_nomor.value = f.nomor.value;
        f.t_npwp.value = f.npwp.value;
        f.t_telp.value = f.telp.value;
        f.t_email.value = f.email.value;
    } else {
        f.t_nama.value = "";
        f.t_nomor.value = "";
        f.t_telp.value = "";
        f.t_npwp.value = "";
        f.t_email.value = "";
    }
}
var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah2(this.value, 'Rp. ');
});

function formatRupiah2(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}




function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
}
