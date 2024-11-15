$(document).ready(function () {
    let $stepsWrapper = $('#steps-wrapper');
    let $stepContainers = $stepsWrapper.find('.step');
    let $stepForms = $stepContainers.find('form');

    const finalStep = getTotalStepCount();
    let activeStep = 1;

    populateShippingMethods();

    $stepForms.on('submit', function (event) {
        let $form = $(this);
        let $submitButton = $form.find('button[type="submit"]');
        event.preventDefault();

        hideErrors($form);
        activateLoader();

        let formAction = $form.prop('action');
        $.ajax({
            url: formAction,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                removeLoader();
                activateNextStep();
                $submitButton.addClass('btn-disabled');
                $submitButton.prop('disabled', true);

                let createdOrderId = response.order_id;
                if (createdOrderId) {
                    $stepForms.find('input.order_id_input').val(createdOrderId);
                }

                let redirectUri = response.redirect_uri;
                if (redirectUri) {
                    window.location.replace(redirectUri);
                }
            },
            error: function(response) {
                console.error('Error while processing step:', response.responseJSON.errors);
                removeLoader();
                showErrors($form, response.responseJSON.errors);
            }
        });
    })

    /**
     * @param {object} $form
     * @param {object} errors
     */
    function showErrors($form, errors) {
        for (const [field, fieldErrors] of Object.entries(errors)) {
            let $field = $form.find('input[name="' + field + '"], select[name="' + field + '"]');
            let $fieldErrorContainer = $field.parent().find('.form-input-error');

            $field.addClass('has-error');
            $fieldErrorContainer.append(fieldErrors.join(', '));
            $fieldErrorContainer.removeClass('hidden');
        }
    }

    /**
     * @param {object} $form
     */
    function hideErrors($form) {
        let $field = $form.find('input, select');
        let $fieldErrorContainer = $field.parent().find('.form-input-error');

        $field.removeClass('has-error');
        $fieldErrorContainer.addClass('hidden');
        $fieldErrorContainer.html('');
    }

    /**
     * @return {number}
     */
    function getTotalStepCount() {
        return $stepContainers.length;
    }

    function activateLoader() {
        $('body').prepend('<div class="load-mask"><div class="loader"></div></div>');
    }

    function removeLoader() {
        $('body').find('.load-mask').remove();
    }

    function populateShippingMethods() {
        let $createShipmentForm = $('form#create-shipment');
        let requestUrl = $createShipmentForm.data('shipment-method-getter');
        let shippingSelectElement = document.getElementById('shipping_method');
        let shippingOptionSelectElement = document.getElementById('shipping_method_option');
        let shippingOptions = {};

        $.ajax({
            url: requestUrl,
            method: 'GET',
            dataType: 'JSON',
            cache: false,
            processData: false,
            success:function(response)
            {
                addShippingMethods(shippingSelectElement, response.shipping_methods);
                shippingOptions = getShippingMethodOptions(response.shipping_method_options)
            },
            error: function(response) {
                console.error('Error while retrieving shipping methods:', response);
            }
        });

        $(shippingSelectElement).on('change', function () {
            let selectedMethodId = $(this).val();
            let availableOptions = shippingOptions[selectedMethodId];
            if (availableOptions && availableOptions.length > 1) {
                showMethodOptions(shippingOptions[selectedMethodId], shippingOptionSelectElement);
            } else {shippingOptionSelectElement
                hideMethodOptions(shippingOptionSelectElement);
            }
        })

    }

    /**
     * @param {node} selectElement
     * @param {object} shippingMethodsData
     */
    function addShippingMethods(selectElement, shippingMethodsData) {
        $(selectElement).html('');
        let optGroups = [];
        for (const [groupLabel, shippingMethods] of Object.entries(shippingMethodsData)) {
            let optGroup = document.createElement('optgroup')
            optGroup.setAttribute('label', groupLabel);
            shippingMethods.forEach((shippingMethod) => {
                let option = new Option(
                    shippingMethod.label,
                    shippingMethod.value
                );
                optGroup.append(option);
            })
            optGroups.push(optGroup)
        }

        optGroups.forEach((optGroup) => selectElement.append(optGroup));
    }

    /**
     * @param {object} shippingMethodOptions
     * @return {object}
     */
    function getShippingMethodOptions(shippingMethodOptions) {
        let mappedMethodOptions = {};
        for (const [methodId, shippingOptions] of Object.entries(shippingMethodOptions)) {
            let options = [];
            shippingOptions.forEach((shippingOption) => {
                let option = new Option(
                    shippingOption.label,
                    shippingOption.value
                );
                options.push(option);
            })

            mappedMethodOptions[methodId] = options;
        }

        return mappedMethodOptions;
    }

    /**
     * @param {array} options
     * @param {node} selectElement
     */
    function showMethodOptions(options, selectElement) {
        hideMethodOptions(selectElement);
        options.forEach((option) => selectElement.append(option));
        $(selectElement).parent().parent().removeClass('hidden');
    }


    /**
     * @param {node} selectElement
     */
    function hideMethodOptions(selectElement) {
        let $selectElement = $(selectElement);
        $selectElement.parent().parent().addClass('hidden');
        $selectElement.html('');
        $selectElement.val(0);
    }

    /**
     * @return {number}
     */
    function activateNextStep() {
        let nextStep = activeStep + 1;

        $stepContainers.each(function () {
            let containerStep = Number($(this).data('step'));
            if (containerStep === nextStep) {
                $(this).find('div.step-mask').remove();
                $(this).removeClass('has-mask');
                $(this).get(0).scrollIntoView({behavior: 'smooth'});
            }
        });

        activeStep = nextStep;
    }
})
