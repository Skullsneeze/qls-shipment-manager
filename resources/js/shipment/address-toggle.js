$(document).ready(function () {
    let $sameAddressCheckbox = $('input#shipping_is_billing');
    let $billingAddressContainer = $('#billing-address');

    $sameAddressCheckbox.on('change', function () {
        toggleDisabled($(this).is(':checked'));
    });

    /**
     * @param {boolean} shouldDisable
     */
    function toggleDisabled(shouldDisable) {
        $billingAddressContainer.find('input, select').each(function () {
            let $input = $(this);
            if ($input.attr('id') !== 'shipping-is-billing') {
                $input.prop('disabled', shouldDisable);

                if (shouldDisable) {
                    $input.addClass('disabled');
                } else {
                    $input.removeClass('disabled');
                }
            }
        });
    }
})
