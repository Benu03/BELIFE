const flashData = $('.flash-data').data('flashdata');
if(flashData){
Swal({

    title: 'Data Berhasil ' + flashData,
    text: 'Password Anda Salah',
    type: 'error'

});
}