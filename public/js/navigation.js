$(function(){
  getActiveMenu();
});

function getActiveMenu(){
  var add = window.location.href;

  if (add.search('dashboard') > 0) {
    $('#dashboard').addClass('active');
  }else if (add.search('admin/packages') > 0) {
    $('#a-packages').addClass('active');
  }else if (add.search('admin/users') > 0) {
    $('#a-users').addClass('active');
  }else if (add.search('admin/payments') > 0) {
    $('#a-payments').addClass('active');
  }

}
