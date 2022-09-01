function demoNotifications(notification,title,msg,$toastr_options) {

  var $toast = toastr[notification](msg, title);
  
  toastr.options = {
    "closeButton"     : $toastr_options['closeButton'],
    "debug"           : $toastr_options['debug'],
    "positionClass"   : $toastr_options['positionClass'],
    "onclick"         : $toastr_options['onclick'],
    "showDuration"    : $toastr_options['showDuration'],
    "hideDuration"    : $toastr_options['hideDuration'],
    "timeOut"         : $toastr_options['timeOut'],
    "extendedTimeOut" : $toastr_options['extendedTimeOut'],
    "showEasing"      : $toastr_options['showEasing'],
    "hideEasing"      : $toastr_options['hideEasing'],
    "showMethod"      : $toastr_options['showMethod'],
    "hideMethod"      : $toastr_options['hideMethod']
  }
}
