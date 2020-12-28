(function (global, factory) {
  var mod = {
    exports: {}
  };
  factory(global.jQuery, global.Site);
})(this, function (_jquery, _Site) {
  'use strict';

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  (0, _jquery2.default)(document).ready(function () {
    (0, _Site.run)();
  });
});
/**********Select2 ***************/
$('.select-all').click(function () {
	let $select2 = $(this).parent().siblings('.select2')
	$select2.find('option').prop('selected', 'selected')
	$select2.trigger('change')
})
$('.deselect-all').click(function () {
	let $select2 = $(this).parent().siblings('.select2')
	$select2.find('option').prop('selected', '')
	$select2.trigger('change')
});
/********** END Select2 ***************/
var toastr_opt={
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
function toastrSuccess(msg,title){
  toastr.success(msg,title,toastr_opt);
}
function toastrErrors(msg,title){
  toastr.error(msg,title,toastr_opt);
}
function toastrError(msg,title){
  toastr.error(msg,title,toastr_opt);
}