function addToCart(id, name, price, qty) {
    // save to local storage
    let cart = localStorage.getItem('cart');
    if (cart == null) {
        // no cart yet
        let products = [
            {
                productId: id,
                productName: name,
                productPrice: price,
                totalPrice: price,
                qty: qty,
            },
        ];
        localStorage.setItem('cart', JSON.stringify(products));
        console.log('Product is added for the first time');
    } else {
        // cart is already present
        let pCart = JSON.parse(cart);
        let oldProduct = pCart.find((item) => item.productId == id);
        if (oldProduct) {
            // we have to increase the quantity
            oldProduct.qty = oldProduct.qty + 1;
            pCart.map((item) => {
                if (item.productId == oldProduct.productId) {
                    item.qty = oldProduct.qty;
                    item.totalPrice = item.qty * item.totalPrice;
                }
            });
            localStorage.setItem('cart', JSON.stringify(pCart));
            console.log('Product quantity is increased');
        } else {
            // we have to add the product
            pCart.push({
                productId: id,
                productName: name,
                productPrice: price,
                totalPrice: price,
                qty: qty,
            });
            localStorage.setItem('cart', JSON.stringify(pCart));
            console.log('Product is added');
        }
    }

    // reload browser
    window.location.reload();
}

function decreaseQty(id) {
    let cart = localStorage.getItem('cart');
    let pCart = JSON.parse(cart);
    let oldProduct = pCart.find((item) => item.productId == id);
    if (oldProduct.qty == 1) {
        pCart = pCart.filter((item) => item.productId != id);
        localStorage.setItem('cart', JSON.stringify(pCart));
        window.location.reload();
    } else {
        pCart.map((item) => {
            if (item.productId == oldProduct.productId) {
                item.qty = item.qty - 1;
                item.totalPrice = item.qty * item.productPrice;
            }
        });
        localStorage.setItem('cart', JSON.stringify(pCart));
        window.location.reload();
    }
}

function increaseQty(id) {
    let cart = localStorage.getItem('cart');
    let pCart = JSON.parse(cart);
    let oldProduct = pCart.find((item) => item.productId == id);
    pCart.map((item) => {
        if (item.productId == oldProduct.productId) {
            item.qty = item.qty + 1;
            item.totalPrice = item.qty * item.productPrice;
        }
    });
    localStorage.setItem('cart', JSON.stringify(pCart));
    window.location.reload();
}

function totalItem() {
    let cart = localStorage.getItem('cart');
    let pCart = JSON.parse(cart);
    let total = 0;
    if (pCart) {
        pCart.map((item) => {
            total += item.qty;
        });
    }
    return total;
}

function totalPrice() {
    let cart = localStorage.getItem('cart');
    let pCart = JSON.parse(cart);
    let total = 0;
    if (pCart) {
        pCart.map((item) => {
            total += item.totalPrice;
        });
    }
    return total;
}
