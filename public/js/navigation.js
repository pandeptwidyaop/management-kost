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
  }else if (add.search('house-room') > 0) {
    $('#k-house').addClass('active');
  }else if (add.search('members') > 0) {
    $('#k-members').addClass('active');
  }else if (add.search('bills') > 0) {
    $('#k-bill').addClass('active');
  }else if (add.search('packages') > 0) {
    $('#k-packages').addClass('active');
  }else if (add.search('reports') > 0) {
    $('#k-report').addClass('active');
  }

}
