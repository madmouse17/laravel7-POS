$("#product_select")
    .select2({
        placeholder: "Search product...",
        theme: "bootstrap",
        allowClear: true,
        ajax: {
            url: searchProductRoute,
            dataType: "json",
            delay: 250,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return {
                    results: data.map(item => {
                        return {
                            text: item.product_format,
                            id: item.id,
                            item: item
                        };
                    })
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        },
        minimumInputLength: 1
    })
    .on("select2:select", e => {
        var data = e.params.data;
        var item = data.item;
        var products = MY.VM.products();
        var is_new = true;
        if (products.length > 0) {
            products.map(row => {
                if (row.product_id() == item.id) {
                    row.qty(parseFloat(row.qty()) + 1);
                    is_new = false;
                }
            });
        }
        if (is_new) {
            MY.VM.products.push(
                new addProduct(
                    item.id,
                    item.barcode,
                    item.name,
                    item.stock,
                    item.sell,
                    1
                )
            );
        }
        $("#product_select")
            .val(null)
            .trigger("change");
    });
