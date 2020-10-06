(function($) {
  $(document).ready(function() {
    $('#membership').appendTo($('.crm-contribution-main-form-block'));
    $('.payment_options-group').appendTo($('.crm-contribution-main-form-block'));
    $('#billing-payment-block').appendTo($('.crm-contribution-main-form-block'));
    $('#crm-submit-buttons').appendTo($('.crm-contribution-main-form-block'));
    if ($('#discountcode').length > 0 && $('#discountcode').val() !== '') {
      $('#membership')[0].scrollIntoView(true);
    }
  });
})(CRM.$);
