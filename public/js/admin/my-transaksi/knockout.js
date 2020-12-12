function addProduct(product_id, product_barcode, product_name, price, qty) {
    var self = this;

    self.product_id = ko.observable(product_id);
    self.product_barcode = ko.observable(product_barcode);
    self.product_name = ko.observable(product_name);
    self.product = ko.computed(() => {
        return self.product_barcode() + " - " + self.product_name();
    });
    self.price = ko.observable(price);
    self.qty = ko.observable(qty);
    self.total = ko.computed(() => {
        var price = self.price();
        var qty = self.qty();
        var total = parseFloat(price) * parseFloat(qty);

        return total;
    });
}

function viewModel() {
    var self = this;

    self.id = ko.observable(null);
    self.invoice_id = ko.observable(null);

    // Save products in this computed variable
    self.products = ko.observableArray();

    // Calculation
    self.subtotal = ko.computed(() => {
        var total = 0;
        if (self.products().length > 0) {
            self.products().map(item => {
                total = parseFloat(total) + parseFloat(item.total());
            });
        }
        return total;
    });
    self.discount = ko.observable(0);
    self.total = ko.computed(() => {
        var subtotal = self.subtotal();
        var discount = self.discount();
        var total = parseFloat(subtotal) - parseFloat(discount);
        return total;
    });
    self.grandtotal = ko.computed(() => {
        var total = self.total();
        return total;
    });
    self.payment = ko.observable(0);
    self.change = ko.computed(() => {
        var total = 0;
        var grandtotal = self.grandtotal();
        var payment = self.payment();
        if (payment > 0) {
            total = parseFloat(grandtotal) - parseFloat(payment);
        }
        return total;
    });

    // Remove product
    self.removeProduct = item => {
        self.products.remove(item);
    };
}

var MY = { VM: new viewModel() };

ko.applyBindings(MY.VM);
