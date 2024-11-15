$(document).ready(function () {
    let $templateRow = $('.product-template-row');
    let $addButton = $('button.add-product');

    $addButton.on('click', function () {
        addProductRow();
    });

    function addProductRow() {
        let rowId = getNewRowId();
        let newRowHtml = $templateRow.clone().wrapAll('<div>').parent().html();
        newRowHtml = newRowHtml.replaceAll('ARRAY_KEY', rowId);

        let $newRow = $(newRowHtml);
        $newRow.removeClass('product-template-row');
        $newRow.addClass('product-row');
        $newRow.attr('id', 'product-' + rowId)
        $newRow.insertBefore($addButton.parent());
    }

    function getNewRowId() {
        let lastId = $('.product-row').last().attr('id');
        lastId = lastId.replace('product-', '');
        lastId++;

        return lastId;
    }
})
